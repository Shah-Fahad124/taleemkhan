<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Grade;
use App\Models\School;
use App\Models\Tehsil;
use App\Models\Student;
use App\Models\District;
use App\Models\FeeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SchoolController extends Controller
{
    /**
     * Display a listing of schools.
     */
    public function index()
    {
        $districts = District::orderBy('name')->get();
        $schools   = School::with(['district', 'tehsil'])
            ->withCount('students')
            ->latest()
            ->paginate(10);

        return view('admin.schools.index', compact('schools', 'districts'));
    }

    /**
     * AJAX filter and search for schools.
     */
    public function filter(Request $request)
    {
        $query = School::with(['district', 'tehsil'])->withCount('students');

        if ($request->district_id) {
            $query->where('district_id', $request->district_id);
        }

        if ($request->school_name) {
            $query->where('school_name', 'like', '%' . $request->school_name . '%');
        }

        $schools = $query->latest()->paginate(10);

        return view('partials.school_table', compact('schools'))->render();
    }

    /**
     * Show form for creating a new school.
     */
    public function create()
    {
        $districts = District::orderBy('name')->get();
        $tehsils   = Tehsil::orderBy('name')->get();

        return view('admin.schools.create', compact('districts', 'tehsils'));
    }

    /**
     * Store a newly created school.
     */
    public function store(Request $request)
    {
        $request->validate([
            'emis_code'          => 'required|string|max:50|unique:schools,emis_code',
            'school_name'        => 'required|string|max:255',
            'school_level'       => 'required|in:Primary,Middle,High',
            'district_id'        => 'required|exists:districts,id',
            'tehsil_id'          => 'required|exists:tehsils,id',
            'zone'               => 'required|in:Summer Zone,Winter Zone',
            'head_teacher_name'  => 'required|string|max:255',
            'head_teacher_phone' => 'required|string|max:20',
            'number_of_teachers' => 'required|integer|min:0',
            'email'              => 'nullable|email|max:255',
            'password'           => 'required|string|min:6',
        ]);

        School::create([
            'emis_code'          => $request->emis_code,
            'school_name'        => $request->school_name,
            'school_level'       => $request->school_level,
            'district_id'        => $request->district_id,
            'tehsil_id'          => $request->tehsil_id,
            'zone'               => $request->zone,
            'head_teacher_name'  => $request->head_teacher_name,
            'head_teacher_phone' => $request->head_teacher_phone,
            'number_of_teachers' => $request->number_of_teachers,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'is_active'          => true,
        ]);

        return redirect()->route('schools.index')->with('success', 'School added successfully.');
    }

    /**
     * Show the form for editing a school.
     */
    public function edit(School $school)
    {
        $districts = District::orderBy('name')->get();
        $tehsils   = Tehsil::orderBy('name')->get();

        return view('admin.schools.edit', compact('school', 'districts', 'tehsils'));
    }

    /**
     * Update an existing school.
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'emis_code'          => 'required|string|max:50|unique:schools,emis_code,' . $school->id,
            'school_name'        => 'required|string|max:255',
            'school_level'       => 'required|in:Primary,Middle,High',
            'district_id'        => 'required|exists:districts,id',
            'tehsil_id'          => 'required|exists:tehsils,id',
            'zone'               => 'required|in:Summer Zone,Winter Zone',
            'head_teacher_name'  => 'required|string|max:255',
            'head_teacher_phone' => 'required|string|max:20',
            'number_of_teachers' => 'required|integer|min:0',
            'email'              => 'nullable|email|max:255',
            'password'           => 'nullable|string|min:6',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $school->update($data);

        return redirect()->route('schools.index')->with('info', 'School updated successfully.');
    }

    /**
     * Show single school details.
     */
    public function show($id)
    {
        $school = School::with(['district', 'tehsil'])
            ->withCount('students')
            ->findOrFail($id);

        return view('admin.schools.show', compact('school'));
    }

    /**
     * Delete a school.
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('warning', 'School deleted successfully.');
    }

/**
 * School Dashboard for logged-in school.
 */
public function dashboard(Request $request)
{
    $school = auth('school')->user();

    // Get selected month from request or default to current month
    $selectedMonth = $request->get('month', Carbon::now()->format('F'));
    $currentYear = Carbon::now()->year;

    $grades = Grade::all();
    $gradeStats = [];
    $overall = ['paid' => 0, 'partial' => 0, 'unpaid' => 0];

    // Calculate total students count for the school
    $totalSchoolStudents = Student::where('school_id', $school->id)->count();

    foreach ($grades as $grade) {
        // 1. All students of this grade
        $totalStudents = $grade->students()
            ->where('school_id', $school->id)
            ->count();

        // 2. Paid students (from fee_records)
        $paidStudents = FeeRecord::where('school_id', $school->id)
            ->where('class_id', $grade->id)
            ->where('month', $selectedMonth)
            ->where('year', $currentYear)
            ->where('status', 'Paid')
            ->distinct('student_id')
            ->count('student_id');

        // 3. Partial students
        $partialStudents = FeeRecord::where('school_id', $school->id)
            ->where('class_id', $grade->id)
            ->where('month', $selectedMonth)
            ->where('year', $currentYear)
            ->where('status', 'Partial')
            ->distinct('student_id')
            ->count('student_id');

        // 4. Unpaid students: total students minus (paid + partial)
        $unpaidStudents = $totalStudents - ($paidStudents + $partialStudents);

        $gradeStats[] = [
            'id' => $grade->id,
            'grade' => $grade->name,
            'total_students' => $totalStudents,
            'paid' => $paidStudents,
            'partial' => $partialStudents,
            'unpaid' => $unpaidStudents,
        ];

        $overall['paid'] += $paidStudents;
        $overall['partial'] += $partialStudents;
        $overall['unpaid'] += $unpaidStudents;
    }

    // Top 5 defaulters
    $topDefaulters = FeeRecord::with(['student', 'class'])
        ->where('school_id', $school->id)
        ->where('month', $selectedMonth)
        ->where('year', $currentYear)
        ->where('status', 'Unpaid')
        ->orderByDesc('due_amount')
        ->take(5)
        ->get();

    // Recent payments
    $recentPayments = FeeRecord::with(['student', 'class'])
        ->where('school_id', $school->id)
        ->where('month', $selectedMonth)
        ->where('year', $currentYear)
        ->where('status', 'Paid')
        ->orderByDesc('payment_date')
        ->take(5)
        ->get();

    // If AJAX request, return JSON
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'data' => [
                'gradeStats' => $gradeStats,
                'overall' => $overall,
                'topDefaulters' => $topDefaulters,
                'recentPayments' => $recentPayments,
                'totalSchoolStudents' => $totalSchoolStudents,
                'selectedMonth' => $selectedMonth
            ]
        ]);
    }

    return view('school.dashboard', compact(
        'school',
        'gradeStats',
        'overall',
        'selectedMonth',
        'topDefaulters',
        'recentPayments',
        'totalSchoolStudents'
    ));
}
}
