<?php

namespace App\Http\Controllers;

use App\Models\Tehsil;
use App\Models\District;
use Illuminate\Http\Request;

class TehsilController extends Controller
{
    public function index()
    {
        $tehsils = Tehsil::with('district')->latest()->paginate(10);
        $districts = District::orderBy('name')->get();
        return view('admin.tehsils.index', compact('tehsils', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:tehsils,name',
            'district_id' => 'required|exists:districts,id',
        ]);

        Tehsil::create([
            'name' => $request->name,
            'district_id' => $request->district_id,
        ]);

        return redirect()->route('tehsils.index')->with('success', 'Tehsil added successfully.');
    }

    public function update(Request $request, Tehsil $tehsil)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:tehsils,name,' . $tehsil->id,
            'district_id' => 'required|exists:districts,id',
        ]);

        $tehsil->update([
            'name' => $request->name,
            'district_id' => $request->district_id,
        ]);

        return redirect()->route('tehsils.index')->with('success', 'Tehsil updated successfully.');
    }

    public function destroy(Tehsil $tehsil)
    {
        $tehsil->delete();
        return redirect()->route('tehsils.index')->with('success', 'Tehsil deleted successfully.');
    }

 public function getByDistrict(Request $request)
{
    $districtId = $request->district_id;

    $tehsils =Tehsil::query()
        ->when($districtId, function ($query, $districtId) {
            // If district_id provided → filter by it
            $query->where('district_id', $districtId);
        })
        ->orderBy('name')
        ->get();

    return response()->json($tehsils);
}

}
