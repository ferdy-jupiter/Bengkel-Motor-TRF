<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::latest()->get();
        return view('spareparts.index', compact('spareparts'));
    }

    public function create()
    {
        return view('spareparts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:spareparts'],
            'nama' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);

        Sparepart::create($validated);

        return redirect()->route('admin.spareparts.index')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    public function edit(Sparepart $sparepart)
    {
        return view('spareparts.edit', compact('sparepart'));
    }

    public function update(Request $request, Sparepart $sparepart)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:spareparts,kode,' . $sparepart->id],
            'nama' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'harga' => ['required', 'numeric', 'min:0'],
        ]);

        $sparepart->update($validated);

        return redirect()->route('admin.spareparts.index')->with('success', 'Data sparepart berhasil diperbarui.');
    }

    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('admin.spareparts.index')->with('success', 'Sparepart berhasil dihapus.');
    }
}
