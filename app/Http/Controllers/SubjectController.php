<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Show all subjects
    public function index()
    {
        $subjects = Subject::latest()->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    // Store new subject
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        Subject::create($request->only('name', 'code', 'description'));
        return redirect()->back()->with('success', 'Subject added successfully.');
    }

    // Update subject
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        $subject->update($request->only('name', 'code', 'description'));
        return redirect()->back()->with('success', 'Subject updated successfully.');
    }

    // Delete subject
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully.');
    }
}

