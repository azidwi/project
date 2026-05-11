<?php

namespace App\Http\Controllers;

use App\Models\Pensil;
use Illuminate\Http\Request;

class PensilController extends Controller
{
    public function index()
{
    $pensils = Pensil::all();
    return view('pensil.index', compact('pensils'));
}

    public function create()
    {
    return view('pensil.create');
    }

    public function store(Request $request)
{
    Pensil::create([
        'nama' => $request->nama,
        'warna' => $request->warna,
        'stok' => $request->stok,
    ]);

    return redirect()->route('pensil.index');
}

    public function edit($id)
    {
        $pensils = Pensil::findOrFail($id);
        return view('pensil.edit', compact('pensil'));
    }

    public function update(Request $request, $id)
    {
        $pensils = Pensil::findOrFail($id);
        $pensils->update($request->all());
        return redirect()->route('pensil.index');
    }

    public function destroy($id)
    {
        Pensil::destroy($id);
        return redirect()->route('pensil.index');
    }

    

}
