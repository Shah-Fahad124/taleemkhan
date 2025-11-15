<?php
namespace App\Http\Controllers;

use App\Exports\ItemBankExport;
use App\Exports\ItemBankSampleExport;
use App\Imports\ItemBankImport;
use App\Models\Grade;
use App\Models\ItemBank;
use App\Models\Subject;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemBankController extends Controller
{
    /**
     * Display all items
     */
    public function index()
    {
        $items = ItemBank::with(['subject', 'grade'])->latest()->paginate(10);
        return view('admin.itembank.index', compact('items'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $subjects = Subject::orderBy('name')->get(['id', 'name']);
        $grades   = Grade::orderBy('name')->get(['id', 'name']);
        return view('admin.itembank.create', compact('subjects', 'grades'));
    }

    /**
     * Store a newly created item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id'       => 'required|exists:subjects,id',
            'grade_id'         => 'required|exists:grades,id',
            'slo'              => 'nullable|string',
            'slo_no'           => 'nullable|string',
            'skill'            => 'nullable|string',
            'semester'         => 'nullable|string',
            'month'            => 'nullable|string',
            'difficulty'       => 'nullable|string',
            'category'         => 'nullable|string',
            'item_type'        => 'required|in:MCQ,RRQ,ERQ',
            'item_description' => 'nullable|string',
            'stimulus'         => 'nullable|string',
            'total_marks'      => 'nullable|integer|min:0',
        ]);

        // Type-specific logic
        if ($request->item_type === 'MCQ') {
            $validated['option_a']       = $request->option_a;
            $validated['option_b']       = $request->option_b;
            $validated['option_c']       = $request->option_c;
            $validated['option_d']       = $request->option_d;
            $validated['correct_answer'] = $request->correct_answer;
        } elseif ($request->item_type === 'RRQ') {
            $validated['possible_answers'] = $request->possible_answers;
            $validated['marking_hints']    = $request->marking_hints;
        } elseif ($request->item_type === 'ERQ') {
            $validated['rubric'] = $request->rubric;
        }

        ItemBank::create($validated);

        return redirect()->route('item-bank.create')->with('success', 'Item added successfully.');
    }

    /**
     * Show the edit form for a specific item
     */
    public function edit(ItemBank $item_bank)
    {
        $subjects = Subject::orderBy('name')->get(['id', 'name']);
        $grades   = Grade::orderBy('name')->get(['id', 'name']);
        return view('admin.itembank.edit', [
            'item'     => $item_bank,
            'subjects' => $subjects,
            'grades'   => $grades,
        ]);
    }

    /**
     * Update an existing item
     */
    public function update(Request $request, ItemBank $item_bank)
    {
        $validated = $request->validate([
            'subject_id'       => 'required|exists:subjects,id',
            'grade_id'         => 'required|exists:grades,id',
            'slo'              => 'nullable|string',
            'slo_no'           => 'nullable|string',
            'skill'            => 'nullable|string',
            'semester'         => 'nullable|string',
            'month'            => 'nullable|string',
            'difficulty'       => 'nullable|string',
            'category'         => 'nullable|string',
            'item_type'        => 'required|in:MCQ,RRQ,ERQ',
            'item_description' => 'nullable|string',
            'stimulus'         => 'nullable|string',
            'total_marks'      => 'nullable|integer|min:0',
        ]);

        if ($request->item_type === 'MCQ') {
            $validated['option_a']       = $request->option_a;
            $validated['option_b']       = $request->option_b;
            $validated['option_c']       = $request->option_c;
            $validated['option_d']       = $request->option_d;
            $validated['correct_answer'] = $request->correct_answer;
        } elseif ($request->item_type === 'RRQ') {
            $validated['possible_answers'] = $request->possible_answers;
            $validated['marking_hints']    = $request->marking_hints;
        } elseif ($request->item_type === 'ERQ') {
            $validated['rubric'] = $request->rubric;
        }

        $item_bank->update($validated);

        return redirect()->route('item-bank.index')->with('success', 'Item updated successfully.');
    }

    // Show a specific item (view page)
    public function show(ItemBank $item_bank)
    {
        return view('admin.itembank.show', compact('item_bank'));
    }

    /**
     * Delete a specific item
     */
    public function destroy(ItemBank $item_bank)
    {
        $item_bank->delete();
        return redirect()->route('item-bank.index')->with('success', 'Item deleted successfully.');
    }

    // ====== SAMPLE EXPORT  ======

    public function sampleExport()
    {
        return Excel::download(new ItemBankSampleExport, 'item_bank_sample.xlsx');
    }

    // ====== EXPORT questions======
    public function export()
    {
        return Excel::download(new ItemBankExport, 'item_bank.xlsx');
    }

// ====== IMPORT ======
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ItemBankImport, $request->file('file'));

        return back()->with('success', 'Items imported successfully.');
    }

}
