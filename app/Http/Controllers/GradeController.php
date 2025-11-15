<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of grades.
     */
    public function index()
    {
        // Get all grades with pagination
        $grades = Grade::latest()->paginate(10);

        // Return single CRUD view for all actions
        return view('admin.grades.index', compact('grades'));
    }

    /**
     * Store a newly created grade.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:grades,name',
            'description' => 'nullable|string|max:255',
        ]);

        Grade::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('grades.index')->with('success', 'Grade added successfully.');
    }

    /**
     * Update the specified grade.
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:grades,name,' . $grade->id,
            'description' => 'nullable|string|max:255',
        ]);

        $grade->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified grade.
     */
    public function destroy(Grade $grade)
    {
        if ($grade->students()->exists()) {
            return redirect()->route('grades.index')
                ->with('success', 'Cannot delete grade because students are assigned to it.');
        }
        
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
}
