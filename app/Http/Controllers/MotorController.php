<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MotorController extends Controller
{
    public function index()
    {
        $motors = Motor::where('user_id', Auth::id())->latest()->get();
        return view('motors.index', compact('motors'));
    }

    public function create()
    {
        return view('motors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'string', 'max:255'],
            'no_plat' => ['required', 'string', 'max:20', 'unique:motors'],
            'tahun' => ['nullable', 'digits:4', 'integer', 'min:1980', 'max:' . (date('Y') + 1)],
        ]);

        Auth::user()->motors()->create($validated);

        return redirect()->route('motors.index')->with('success', 'Motor berhasil ditambahkan.');
    }

    public function edit(Motor $motor)
    {
        $this->authorizeOwner($motor);
        return view('motors.edit', compact('motor'));
    }

    public function update(Request $request, Motor $motor)
    {
        $this->authorizeOwner($motor);

        $validated = $request->validate([
            'merk' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'string', 'max:255'],
            'no_plat' => ['required', 'string', 'max:20', 'unique:motors,no_plat,' . $motor->id],
            'tahun' => ['nullable', 'digits:4', 'integer', 'min:1980', 'max:' . (date('Y') + 1)],
        ]);

        $motor->update($validated);

        return redirect()->route('motors.index')->with('success', 'Data motor berhasil diperbarui.');
    }

    public function destroy(Motor $motor)
    {
        $this->authorizeOwner($motor);
        $motor->delete();

        return redirect()->route('motors.index')->with('success', 'Motor berhasil dihapus.');
    }

    private function authorizeOwner(Motor $motor): void
    {
        abort_unless($motor->user_id === Auth::id(), 403);
    }
}
