<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    // ============================
    // Show All Students
    // ============================
    public function index()
    {
        $grades   = Grade::all();
        $schoolId = Auth::user()->id;
        $students = Student::with(['grade'])
            ->where('school_id', $schoolId)
            ->latest()
            ->paginate(10); // Pagination for performance

        return view('students.index', compact('students', 'grades'));
    }

    // ============================
    // Show Create Form
    // ============================
    public function create()
    {
        $grades = Grade::all();
        return view('students.create', compact('grades'));
    }

    // ============================
    // Store Student Record
    // ============================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'                => 'required|string|max:255',
            'father_name'              => 'nullable|string|max:255',
            'gender'                   => 'nullable|in:male,female,other',
            'date_of_birth'            => 'nullable|date',
            'birth_certificate_number' => 'nullable|string|max:255',
            'current_address'          => 'nullable|string',
            'permanent_address'        => 'nullable|string',
            'phone_number'             => 'nullable|string|max:20',
            'emergency_contact'        => 'nullable|string|max:20',
            'grade_id'                 => 'required|exists:grades,id',
            'section'                  => 'nullable|string|max:255',
            'status'                   => 'nullable|in:active,inactive,graduated,transferred',
        ]);

        $validated['school_id'] = Auth::user()->id;

        Student::create($validated);

        return redirect()->route('school.students.index')->with('success', 'Student added successfully.');
    }

    // ============================
    // Show Student Details
    // ============================
    public function show($id)
    {
        $student = Student::with(['grade'])
            ->where('school_id', Auth::user()->id)
            ->findOrFail($id);

        return view('students.show', compact('student'));
    }

    // ============================
    // Show Edit Form
    // ============================
    public function edit($id)
    {
        $student = Student::where('school_id', Auth::user()->id)->findOrFail($id);
        $grades  = Grade::all();
        return view('students.edit', compact('student', 'grades'));
    }

    // ============================
    // Update Student Record
    // ============================
    public function update(Request $request, $id)
    {
        $student = Student::where('school_id', Auth::user()->id)->findOrFail($id);

        $validated = $request->validate([
            'full_name'                => 'required|string|max:255',
            'father_name'              => 'nullable|string|max:255',
            'gender'                   => 'nullable|in:male,female,other',
            'date_of_birth'            => 'nullable|date',
            'birth_certificate_number' => 'nullable|string|max:255',
            'current_address'          => 'nullable|string',
            'permanent_address'        => 'nullable|string',
            'phone_number'             => 'nullable|string|max:20',
            'emergency_contact'        => 'nullable|string|max:20',
            'grade_id'                 => 'required|exists:grades,id',
            'section'                  => 'nullable|string|max:255',
            'status'                   => 'nullable|in:active,inactive,graduated,transferred',
        ]);

        $student->update($validated);

        return redirect()->route('school.students.index')->with('success', 'Student updated successfully.');
    }

    // ============================
    // Delete Student Record
    // ============================
    public function destroy($id)
    {
        $student = Student::where('school_id', Auth::user()->id)->findOrFail($id);
        $student->delete();

        return redirect()->route('school.students.index')->with('success', 'Student deleted successfully.');
    }


    // ============================
// Filter Students (AJAX)
// ============================
public function filter(Request $request)
{
    $schoolId = Auth::user()->id;

    // Fetch filters
    $gradeId = $request->input('grade_id');
    $search  = $request->input('search');

    // Build query dynamically
    $query = Student::with(['grade'])
        ->where('school_id', $schoolId);

    // Apply Grade Filter
    if (!empty($gradeId)) {
        $query->where('grade_id', $gradeId);
    }

    // Apply Name Search Filter
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('full_name', 'LIKE', "%{$search}%")
              ->orWhere('father_name', 'LIKE', "%{$search}%")
              ->orWhere('phone_number', 'LIKE', "%{$search}%");
        });
    }

    // Fetch Results (with pagination or limit for AJAX)
    $students = $query->latest()->paginate(10);

    // Return a partial view only for the table content
    return view('partials.students_table', compact('students'))->render();
}

    // ============================
    // Import Students from Excel
    // ============================
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new StudentsImport(Auth::user()->id), $request->file('file'));

        return redirect()->back()->with('success', 'Students imported successfully.');
    }
}
