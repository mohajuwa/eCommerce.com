<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }
    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        Color::create($validatedData);

        return redirect('admin/colors')->with('message', 'Color created successfully');
    }

    public function edit(Color $color)
    {

        return view('admin.colors.edit', compact('color'));
    }




    public function update(ColorFormRequest $request, $color_id)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';

        Color::find($color_id)->update($validatedData);

        return redirect('admin/colors')->with('message', 'Color updated successfully');
    }
    public function destroy($color_id)
    {
        $color = Color::findOrFail($color_id);
        $color->delete();
        return redirect('admin/colors')->with('message', 'Color deleted successfully');
    }
}
