<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::latest()->paginate(10);
        return view('admin.districts.index', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100|unique:districts,name']);
        District::create(['name' => $request->name]);
        return redirect()->route('districts.index')->with('success', 'District added successfully.');
    }

    public function update(Request $request, District $district)
    {
        $request->validate(['name' => 'required|string|max:100|unique:districts,name,' . $district->id]);
        $district->update(['name' => $request->name]);
        return redirect()->route('districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('districts.index')->with('success', 'District deleted successfully.');
    }
}
