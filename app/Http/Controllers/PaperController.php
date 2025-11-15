<?php
namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\ItemBank;
use App\Models\Subject;
use App\Services\PaperGeneratorService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PaperController extends Controller
{

    protected $paperService;

    public function __construct(PaperGeneratorService $paperService)
    {
        $this->paperService = $paperService;
    }
    /**
     * Show the Paper Generator Page
     */
    public function index()
    {
        $subjects = Subject::orderBy('name')->get(['id', 'name']);
        $grades   = Grade::orderBy('name')->get(['id', 'name']);
        $months   = [
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
            'December',
        ];

        return view('school.paper.index', compact('subjects', 'grades', 'months'));
    }

    /**
     * Generate Paper (Main Logic)
     */

    public function generate(Request $request)
    {
        $academicYear = date('Y');

        $validated = $request->validate([
            'paper_type' => 'required|in:formative,semester',
            'grade_id'   => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
            'month'      => 'nullable|string',
            'semester'   => 'nullable|string',
        ]);

        $school = auth('school')->user();
        if (! $school) {
            return response()->json(['error' => 'Unauthorized access.'], 401);
        }

        $result = $this->paperService->generate($validated, $school->district_id, $academicYear);

        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 404);
        }

        return response()->json($result);
    }

    /**
     * Download Paper as PDF
     */

    public function downloadPaper(Request $request)
    {
        $ids   = json_decode($request->input('ids', '[]'), true);
        $items = ItemBank::whereIn('id', $ids)->get();

        // Group by type in correct order
        $ordered = collect()
            ->merge($items->where('item_type', 'MCQ'))
            ->merge($items->where('item_type', 'FIB'))
            ->merge($items->where('item_type', 'RRQ'))
            ->merge($items->where('item_type', 'ERQ'));

        $pdf = Pdf::loadView('school.paper.pdf-paper', [
            'items'      => $ordered,
            'grade'      => $request->grade,
            'subject'    => $request->subject,
            'paper_type' => $request->paper_type,
            'month'      => $request->month,
            'semester'   => $request->semester,
        ]);

        $fileName = "{$request->subject}_{$request->grade}_{$request->month}.pdf";
        return $pdf->download($fileName);
    }

    /**
     * Download Answer Key as PDF
     */
    public function downloadAnswerKey(Request $request)
    {
        $ids   = json_decode($request->input('ids', '[]'), true);
        $items = ItemBank::whereIn('id', $ids)->get();

        $pdf = Pdf::loadView('school.paper.pdf-key', [
            'items'   => $items,
            'grade'   => $request->grade,
            'subject' => $request->subject,
            'month'   => $request->month,
            'type'    => $request->paper_type,
        ]);

        // Proper filename
        $fileName = "{$request->subject}_{$request->grade}_{$request->month}_Answer-Key.pdf";
        return $pdf->download($fileName);
    }
}
