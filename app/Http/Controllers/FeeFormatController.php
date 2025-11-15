<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeFormat;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class FeeFormatController extends Controller
{
    // ============================
    // Show List and Add Form
    // ============================
    public function index()
    {
        $schoolId = Auth::user()->id;

        // Grades are global but Fee Formats are school-specific
        $classes = Grade::all();

        $feeFormats = FeeFormat::with('class')
            ->where('school_id', $schoolId)
            ->get();

        return view('school.fees.fee_format', compact('classes', 'feeFormats'));
    }

    // ============================
    // Store New Fee Format
    // ============================
 public function store(Request $request)
{
    // Get logged-in school ID correctly
    $schoolId = Auth::user()->id;

    if (!$schoolId) {
        return back()->with('error', 'Authentication error: school not logged in.');
    }

    // Validate fields
    $data = $request->validate([
        'class_id'       => 'required|exists:grades,id',
        'monthly_fee'    => 'required|numeric|min:0',
        'transport_fee'  => 'nullable|numeric|min:0',
        'computer_fee'   => 'nullable|numeric|min:0',
        'total_fee'      => 'required|numeric|min:0',
    ]);

    // Check duplicate
    $existingFormat = FeeFormat::where('school_id', $schoolId)
        ->where('class_id', $data['class_id'])
        ->first();

    if ($existingFormat) {
        return back()
            ->with('error', 'Fee format for this class already exists. Please update it instead.')
            ->withInput();
    }

    // Create new record
    FeeFormat::create([
        'school_id'     => $schoolId,
        'class_id'      => $data['class_id'],
        'monthly_fee'   => $data['monthly_fee'],
        'transport_fee' => $data['transport_fee'] ?? 0,
        'computer_fee'  => $data['computer_fee'] ?? 0,
        'total_fee'     => $data['total_fee'],
    ]);

    return back()->with('success', 'Fee format added successfully.');
}


    // ============================
    // Edit Fee Format
    // ============================
    public function edit($id)
    {
        $schoolId = Auth::user()->id;

        $feeFormat = FeeFormat::where('school_id', $schoolId)
            ->findOrFail($id);

        $classes = Grade::all();

        return view('school.fees.edit_fee_format', compact('feeFormat', 'classes'));
    }

    // ============================
    // Update Fee Format
    // ============================
    public function update(Request $request, $id)
    {
        $schoolId = Auth::user()->id;

        $data = $request->validate([
            'class_id'       => 'required|exists:grades,id',
            'monthly_fee'    => 'required|numeric|min:0',
            'transport_fee'  => 'nullable|numeric|min:0',
            'computer_fee'   => 'nullable|numeric|min:0',
            'total_fee'      => 'required|numeric|min:0',
        ]);

        $feeFormat = FeeFormat::where('school_id', $schoolId)
            ->findOrFail($id);

        // Prevent duplicate for same school
        $duplicate = FeeFormat::where('school_id', $schoolId)
            ->where('class_id', $data['class_id'])
            ->where('id', '!=', $id)
            ->first();

        if ($duplicate) {
            return back()
                ->with('error', 'Another fee format already exists for this class. Please choose a different class.')
                ->withInput();
        }

        $feeFormat->update([
            'class_id'      => $data['class_id'],
            'monthly_fee'   => $data['monthly_fee'],
            'transport_fee' => $data['transport_fee'] ?? 0,
            'computer_fee'  => $data['computer_fee'] ?? 0,
            'total_fee'     => $data['total_fee'],
        ]);

        return redirect()
            ->route('fee-formats.index')
            ->with('success', 'Fee format updated successfully.');
    }

    // ============================
    // Delete Fee Format
    // ============================
    public function destroy($id)
    {
        $schoolId = Auth::user()->school_id;

        $feeFormat = FeeFormat::where('school_id', $schoolId)
            ->findOrFail($id);

        $feeFormat->delete();

        return back()->with('success', 'Fee format deleted successfully.');
    }
}
