<?php

namespace App\Http\Controllers;


use App\Models\Grade;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ViewResultController extends Controller
{
    /**
     * Show all grades with student counts (for the current school)
     */
    public function view()
    {
        $schoolId = Auth::guard('school')->id();

        $grades = Grade::withCount(['students' => function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        }])->get();

        return view('school.results.index', compact('grades'));
    }

    /**
     * Filter results by month, grade, and paper type
     */
  public function filter(Request $request)
{
    $request->validate([
        'month' => 'required|string',
        'grade_id' => 'required|integer',
        'type' => 'required|string|in:formative,semester',
    ]);

    $schoolId = Auth::guard('school')->id();

    // Get the selected grade
    $grade = Grade::find($request->grade_id);

    // Fetch results (grouped by student)
 $results = DB::table('results')
    ->join('generated_papers', 'results.paper_id', '=', 'generated_papers.id')
    ->join('students', 'results.student_id', '=', 'students.id')
    ->where('generated_papers.grade_id', $request->grade_id)
    ->where('generated_papers.month', $request->month)
    ->where('generated_papers.paper_type', $request->type)
    ->where('results.school_id', $schoolId)
    ->select(
        'results.student_id',
        'students.student_name',
        'students.roll_number',
        'generated_papers.month',
        'generated_papers.paper_type as type',
        DB::raw('SUM(results.total_obtained) as total_obtained'),
        DB::raw('SUM(results.total_marks) as total_marks')
    )
    ->groupBy(
        'results.student_id',
        'students.student_name',
        'students.roll_number',
        'generated_papers.month',
        'generated_papers.paper_type'
    )
    ->get();

    $grades = Grade::withCount('students')->get();

    return view('school.results.filtered-results', compact('results', 'grades', 'grade', 'request'));
}

    /**
     * Show all students and summarized results for a grade
     */
    public function studentsByGrade($gradeId)
    {
        $schoolId = Auth::guard('school')->id();

        $students = Student::where('school_id', $schoolId)
            ->where('grade_id', $gradeId)
            ->with('grade')
            ->get();

        // Get summarized marks (joined with paper type)
        $results = DB::table('results')
            ->join('generated_papers', 'results.paper_id', '=', 'generated_papers.id')
            ->where('results.school_id', $schoolId)
            ->select(
                'results.student_id',
                'results.total_obtained as total',
                'generated_papers.paper_type'
            )
            ->get()
            ->groupBy('student_id');

        return view('school.results.grade-students', compact('students', 'results'));
    }

    /**
     * Show detailed marks (DMC) for a student
     */
public function viewDMC(Request $request, $studentId)
{
    $school = Auth::guard('school')->user();
    $student = Student::with('grade')->findOrFail($studentId);

    // Get month and type from query or previous page
    $month = $request->get('month');
    $type = $request->get('type');

    $results = DB::table('results')
        ->join('generated_papers', 'results.paper_id', '=', 'generated_papers.id')
        ->join('subjects', 'generated_papers.subject_id', '=', 'subjects.id')
        ->select(
            'subjects.name as subject_name',
            'results.total_obtained',
            'results.total_marks',
            'results.remarks',
            'generated_papers.paper_type',
            'generated_papers.month',
            'generated_papers.academic_year'
        )
        ->where('results.student_id', $studentId)
        ->when($month, fn($q) => $q->where('generated_papers.month', $month))
        ->when($type, fn($q) => $q->where('generated_papers.paper_type', $type))
        ->orderBy('subjects.name')
        ->get();

   return view('school.results.dmc', compact('student', 'results', 'school', 'month', 'type'));
}



public function downloadDMC(Request $request, $studentId)
{
    $school = Auth::guard('school')->user();
    $student = Student::with('grade')->findOrFail($studentId);

    // Validate required query params (month, type)
    $request->validate([
        'month' => 'required|string',
        'type' => 'required|string|in:formative,semester',
    ]);

    // Fetch results only for the selected month and type
    $results = DB::table('results')
        ->join('generated_papers', 'results.paper_id', '=', 'generated_papers.id')
        ->join('subjects', 'generated_papers.subject_id', '=', 'subjects.id')
        ->select(
            'subjects.name as subject_name',
            'results.total_obtained',
            'results.total_marks',
            'results.remarks',
            'generated_papers.paper_type',
            'generated_papers.month',
            'generated_papers.academic_year'
        )
        ->where('results.student_id', $studentId)
        ->where('generated_papers.month', $request->month)
        ->where('generated_papers.paper_type', $request->type)
        ->orderBy('subjects.name')
        ->get();

    // If no results found
    if ($results->isEmpty()) {
        return back()->with('error', 'No results found for this student in the selected month and type.');
    }

    $pdf = Pdf::loadView('school.results.dmc-pdf', compact('student', 'results', 'school'));

    $fileName = 'DMC_' . Str::slug($student->student_name, '_') . '_' . $request->month . '_' . $request->type . '.pdf';

    return $pdf->download($fileName);
}


}
