<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //
    public function index()
    {
        $types = PropertyType::all();
        return view("admin.types.index", compact("types"));
    }
    public function create()
    {

        return view("admin.types.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        PropertyType::create($request->all());
        return redirect()->route('admin.property-types.index', ['locale' => app()->getLocale()])->with('success', 'Type Created Successfully!');
    }

    public function edit($locale,$id)
    {
        $type = PropertyType::find($id);
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, $locale, $id)
    {
        $type = PropertyType::find($id);
        $type->update($request->all());
        return redirect()->route('admin.property-types.index', ['locale' => app()->getLocale()])->with('success', 'Type Updated Successfully!');
    }

    public function destroy(Request $request,$locale, $id)
    {
        $type = PropertyType::find($id);
        $type->delete();
        return redirect()->route("admin.property-types.index", ['locale' => app()->getLocale()])->with("success", "Type Deleted Successfuly!");
    }
}
