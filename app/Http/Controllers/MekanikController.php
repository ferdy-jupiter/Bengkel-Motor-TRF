<?php

namespace App\Http\Controllers;

use App\Models\Mekanik;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
    public function index()
    {
        $mekaniks = Mekanik::latest()->get();
        return view('mekaniks.index', compact('mekaniks'));
    }

    public function create()
    {
        return view('mekaniks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'spesialisasi' => ['nullable', 'string', 'max:255'],
            'aktif' => ['sometimes', 'boolean'],
        ]);
        $validated['aktif'] = $request->boolean('aktif');

        Mekanik::create($validated);

        return redirect()->route('admin.mekaniks.index')->with('success', 'Mekanik berhasil ditambahkan.');
    }

    public function edit(Mekanik $mekanik)
    {
        return view('mekaniks.edit', compact('mekanik'));
    }

    public function update(Request $request, Mekanik $mekanik)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'spesialisasi' => ['nullable', 'string', 'max:255'],
            'aktif' => ['sometimes', 'boolean'],
        ]);
        $validated['aktif'] = $request->boolean('aktif');

        $mekanik->update($validated);

        return redirect()->route('admin.mekaniks.index')->with('success', 'Data mekanik berhasil diperbarui.');
    }

    public function destroy(Mekanik $mekanik)
    {
        $mekanik->delete();
        return redirect()->route('admin.mekaniks.index')->with('success', 'Mekanik berhasil dihapus.');
    }
}
