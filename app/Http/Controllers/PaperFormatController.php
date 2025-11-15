<?php

namespace App\Http\Controllers;

use App\Models\PaperFormat;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;

class PaperFormatController extends Controller
{
    /**
     * Show list (paginated, newest first)
     */
    public function index()
    {
        $formats = PaperFormat::latest('created_at')->paginate(10);

        return view('admin.paper-formats.index', compact('formats'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.paper-formats.create');
    }

    /**
     * Store new format
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paper_type' => 'required|in:formative,semester',
        ]);

        // Auto version logic (works on the query builder)
        $last = PaperFormat::where('paper_type', $request->paper_type)
            ->latest('version')
            ->first();

        $nextVersion = $last ? ($last->version + 1) : 1;

        PaperFormat::create([
            'paper_type' => $request->paper_type,
            'version' => $nextVersion,

            // MCQ
            'mcq_easy' => $request->mcq_easy ?? 0,
            'mcq_medium' => $request->mcq_medium ?? 0,
            'mcq_hard' => $request->mcq_hard ?? 0,

            // Fill in the blanks
            'fib_easy' => $request->fib_easy ?? 0,
            'fib_medium' => $request->fib_medium ?? 0,
            'fib_hard' => $request->fib_hard ?? 0,

            // RRQ
            'rrq_easy' => $request->rrq_easy ?? 0,
            'rrq_medium' => $request->rrq_medium ?? 0,
            'rrq_hard' => $request->rrq_hard ?? 0,

            // ERQ
            'erq_easy' => $request->erq_easy ?? 0,
            'erq_medium' => $request->erq_medium ?? 0,
            'erq_hard' => $request->erq_hard ?? 0,
        ]);

        return redirect()->back()->with('success', 'Paper format saved successfully with version ' . $nextVersion);
    }

    /**
     * Edit form (we keep same behavior)
     */
    public function edit(PaperFormat $paper_format)
    {
        $grades = Grade::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('admin.paper-formats.edit', compact('paper_format', 'grades', 'subjects'));
    }

    /**
     * Update
     */

    public function update(Request $request, PaperFormat $paper_format)
    {
        $validated = $request->validate([
            'paper_type' => 'required|in:formative,semester',
            'version' => 'nullable|integer',
        ]);

        // ensure numeric ints for counts
        foreach ([
            'mcq_easy','mcq_medium','mcq_hard',
            'fib_easy','fib_medium','fib_hard',
            'rrq_easy','rrq_medium','rrq_hard',
            'erq_easy','erq_medium','erq_hard'
        ] as $field) {
            $validated[$field] = (int) $request->input($field, 0);
        }

        $paper_format->update($validated);

        return redirect()->route('paper-formats.index')->with('success', 'Paper format updated successfully.');
    }

    /**
     * Destroy
     */
    public function destroy(PaperFormat $paper_format)
    {
        $paper_format->delete();
        return redirect()->route('paper-formats.index')->with('success', 'Deleted successfully.');
    }
}
