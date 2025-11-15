<?php

namespace App\Http\Controllers;

use App\Models\FeeFormat;
use App\Models\FeeRecord;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeRecordController extends Controller
{
    // ============================
    // Show All Fee Records with Filters
    // ============================
    public function index(Request $request)
    {
        $schoolId = auth('school')->id();

        $classes = Grade::all();

        $query = FeeRecord::with(['student', 'class'])
            ->whereHas('student', function ($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            });

        // Class filter
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        // Student name filter
        if ($request->filled('student_name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->student_name . '%');
            });
        }

        // Year filter
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Month filter
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $records = $query->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(25);

        // Distinct years
        $years = FeeRecord::select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        // Default selected year and month
        $currentYear = now()->year;
        $currentMonth = now()->format('F'); // Full month name

        $selectedYear = $request->filled('year') ? $request->year : $currentYear;

        // Months array
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        // Month list
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        // Get current month name
        $currentMonth = now()->format('F');

        // If no month in URL → use current month
        $selectedMonth = $request->filled('month') ? $request->month : $currentMonth;

        // Apply month filter
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        return view('school.fees.fees_record', compact(
            'records',
            'classes',
            'years',
            'months',
            'selectedYear',
            'selectedMonth'
        ));
    }



    // ============================
    // Show Add Fees Page
    // ============================
    public function create()
    {
        $classes = Grade::all();
        return view('school.fees.add_fees', compact('classes'));
    }

    // ============================
    // Fetch Students + Fee Format via AJAX
    // ============================
    public function fetchStudents(Request $request)
    {
        $schoolId = Auth::user()->id;
        $classId  = $request->class_id;
        $month    = $request->month;
        $year     = $request->year;

        //  Get Fee Format for this school & class
        $feeFormat = FeeFormat::where('class_id', $classId)
            ->where('school_id', $schoolId)
            ->first();

        // Fetch this school's students in selected class
        $students = Student::where('school_id', $schoolId)
            ->where('grade_id', $classId)
            ->select('id', 'full_name')
            ->get();

        // Existing fee records for this school, class, month, and year
        $existingFees = FeeRecord::where('class_id', $classId)
            ->where('month', $month)
            ->where('year', $year)
            ->whereHas('student', function ($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })
            ->get()
            ->keyBy('student_id');

        // Merge default fee format & existing fee data
        $students = $students->map(function ($student) use ($existingFees, $feeFormat) {
            $existing = $existingFees->get($student->id);

            $student->fee = [
                'total_fee'   => $existing->total_fee ?? ($feeFormat->total_fee ?? 0),
                'discount'    => $existing->discount ?? 0,
                'paid_amount' => $existing->paid_amount ?? 0,
                'due_amount'  => $existing->due_amount ?? ($feeFormat->total_fee ?? 0),
                'status'      => $existing->status ?? 'Unpaid',
                'remarks'     => $existing->remarks ?? '',
            ];

            return $student;
        });

        return response()->json([
            'students'   => $students,
            'fee_format' => $feeFormat,
        ]);
    }

    // ============================
    // Store Monthly Fee Records
    // ============================
    public function store(Request $request)
    {
        $schoolId = Auth::user()->id;
        $records  = $request->input('records', []);
        $month    = $request->month;
        $year     = $request->year;
        $classId  = $request->class_id;

        foreach ($records as $record) {
            $student = Student::where('id', $record['student_id'])
                ->where('school_id', $schoolId)
                ->first();

            if (!$student) {
                continue;
            }

            FeeRecord::updateOrCreate(
                [
                    'school_id'  => $schoolId,
                    'student_id' => $record['student_id'],
                    'class_id'   => $classId,
                    'month'      => $month,
                    'year'       => $year,
                ],
                [
                    'total_fee'    => $record['total_fee'] ?? 0,
                    'discount'     => $record['discount'] ?? 0,
                    'paid_amount'  => $record['paid_amount'] ?? 0,
                    'due_amount'   => $record['due_amount'] ?? 0,
                    'status'       => $record['status'] ?? 'Unpaid',
                    'remarks'      => $record['remarks'] ?? null,
                    'payment_date' => now(),
                ]
            );
        }

        return back()->with('success', 'Monthly fees recorded successfully.');
    }

    // ============================
    // Show Single Fee Record
    // ============================
    public function show($id)
    {
        $schoolId = Auth::user()->id;

        $record = FeeRecord::with(['student', 'class'])
            ->whereHas('student', function ($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })
            ->findOrFail($id);

        return view('school.fees.show_fee_record', compact('record'));
    }

    // ============================
    // Edit Fee Record
    // ============================
    public function edit($id)
    {
        $schoolId = Auth::user()->id;

        $record = FeeRecord::with(['student', 'class'])
            ->whereHas('student', function ($q) use ($schoolId) {
                $q->where('school_id', $schoolId);
            })
            ->findOrFail($id);

        $classes = Grade::all();

        return view('school.fees.edit_fee_record', compact('record', 'classes'));
    }

    // ============================
    // Update Fee Record
    // ============================
    public function update(Request $request, $id)
    {
        $schoolId = Auth::user()->id;

        $data = $request->validate([
            'class_id'     => 'required|exists:grades,id',
            'total_fee'    => 'required|numeric|min:0',
            'discount'     => 'nullable|numeric|min:0',
            'paid_amount'  => 'nullable|numeric|min:0',
            'due_amount'   => 'nullable|numeric|min:0',
            'status'       => 'required|string',
            'remarks'      => 'nullable|string|max:255',
            'payment_date' => 'nullable|date',
            'month'        => 'required|string',
            'year'         => 'required|numeric',
        ]);

        $record = FeeRecord::whereHas('student', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->findOrFail($id);

        $record->update($data);

        return redirect()->route('fees.index')->with('success', 'Fee record updated successfully.');
    }

    // ============================
    // Delete Fee Record
    // ============================
    public function destroy($id)
    {
        $schoolId = Auth::user()->id;

        $record = FeeRecord::whereHas('student', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->findOrFail($id);

        $record->delete();

        return back()->with('success', 'Fee record deleted successfully.');
    }
}
