<?php
namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Grade;
use App\Models\ItemBank;
use App\Models\School;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Tehsil;

class AdminController extends Controller
{
    // =======================
    // Dashboard
    // =======================
    public function dashboard()
    {
        $totalSchools   = School::count();
        $totalStudents  = Student::count();
        $totalDistricts = District::count();
        $totalTehsils   = Tehsil::count();
        $totalGrades    = Grade::count();
        $totalSubjects  = Subject::count();
        $totalQuestions = ItemBank::count();

        return view('admin.dashboard', compact(
            'totalSchools',
            'totalStudents',
            'totalDistricts',
            'totalGrades',
            'totalTehsils',
            'totalSubjects',
            'totalQuestions'
        ));
    }

    // =======================
    // List All Students
    // =======================
    public function studentslist()
    {
        // Get all students (latest first) with pagination
        $students = Student::with(['school', 'grade'])
            ->latest()
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    // =======================
    // Edit Student
    // =======================
    public function edit($id)
    {
        $student = Student::with('school')->findOrFail($id);
        $grades  = Grade::all();

        return view('students.edit', compact('student', 'grades'));
    }

    // =======================
    // Show Student Details
    // =======================
    public function show($id)
    {
        $student = Student::with(['grade', 'school'])->findOrFail($id);

        return view('students.show', compact('student'));
    }

    // =======================
    // Delete Student
    // =======================
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
