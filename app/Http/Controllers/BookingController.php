<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Layanan;
use App\Models\Mekanik;
use App\Models\Motor;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    // Customer: lihat semua booking miliknya
    public function index()
    {
        $bookings = Booking::with(['motor', 'layanan', 'mekanik'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    // Customer: form booking baru
    public function create()
    {
        $motors = Motor::where('user_id', Auth::id())->get();
        $layanans = Layanan::all();

        return view('bookings.create', compact('motors', 'layanans'));
    }

    // Customer: simpan booking baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'motor_id' => ['required', 'exists:motors,id'],
            'layanan_id' => ['required', 'exists:layanans,id'],
            'tanggal_servis' => ['required', 'date', 'after_or_equal:today'],
            'jam_servis' => ['required'],
            'catatan' => ['nullable', 'string'],
        ]);

        $motor = Motor::findOrFail($validated['motor_id']);
        abort_unless($motor->user_id === Auth::id(), 403);

        Booking::create([
            'user_id' => Auth::id(),
            'motor_id' => $validated['motor_id'],
            'layanan_id' => $validated['layanan_id'],
            'tanggal_servis' => $validated['tanggal_servis'],
            'jam_servis' => $validated['jam_servis'],
            'catatan' => $validated['catatan'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking servis berhasil dibuat.');
    }

    // Customer: detail booking miliknya
    public function show(Booking $booking)
    {
        if (!Auth::user()->isAdmin()) {
            abort_unless($booking->user_id === Auth::id(), 403);
        }

        $booking->load(['motor', 'layanan', 'mekanik', 'user', 'spareparts']);

        return view('bookings.show', compact('booking'));
    }
    // Cetak nota servis (PDF) - bisa diakses customer pemilik booking atau admin
    public function invoice(Booking $booking)
    {
        if (!Auth::user()->isAdmin()) {
            abort_unless($booking->user_id === Auth::id(), 403);
        }

        $booking->load(['motor', 'layanan', 'mekanik', 'user', 'spareparts']);

        $pdf = Pdf::loadView('bookings.invoice', compact('booking'))->setPaper('a4', 'portrait');

        return $pdf->download('Nota-Servis-' . $booking->id . '.pdf');
    }

    // Admin: lihat & kelola semua booking
    public function adminIndex(Request $request)
    {
        $query = Booking::with(['user', 'motor', 'layanan', 'mekanik']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->get();

        return view('bookings.admin_index', compact('bookings'));
    }

    // Admin: form kelola satu booking (assign mekanik, ubah status, tambah sparepart)
    public function adminEdit(Booking $booking)
    {
        $booking->load(['motor', 'layanan', 'mekanik', 'user', 'spareparts']);
        $mekaniks = Mekanik::where('aktif', true)->get();
        $spareparts = Sparepart::where('stok', '>', 0)->get();

        return view('bookings.admin_edit', compact('booking', 'mekaniks', 'spareparts'));
    }

    // Admin: update mekanik & status
    public function adminUpdate(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'mekanik_id' => ['nullable', 'exists:mekaniks,id'],
            'status' => ['required', 'in:pending,dikonfirmasi,dikerjakan,selesai,dibatalkan'],
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.edit', $booking)->with('success', 'Booking berhasil diperbarui.');
    }

    // Admin: tambah pemakaian sparepart ke booking (stok otomatis berkurang)
    public function addSparepart(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'sparepart_id' => ['required', 'exists:spareparts,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $sparepart = Sparepart::findOrFail($validated['sparepart_id']);

        if ($sparepart->stok < $validated['qty']) {
            return back()->withErrors(['qty' => 'Stok sparepart tidak mencukupi. Sisa stok: ' . $sparepart->stok]);
        }

        DB::transaction(function () use ($booking, $sparepart, $validated) {
            $booking->spareparts()->attach($sparepart->id, [
                'qty' => $validated['qty'],
                'harga_saat_itu' => $sparepart->harga,
            ]);

            $sparepart->decrement('stok', $validated['qty']);
        });

        return redirect()->route('admin.bookings.edit', $booking)->with('success', 'Sparepart berhasil ditambahkan ke booking.');
    }

    // Admin: hapus pemakaian sparepart dari booking (stok dikembalikan)
    public function removeSparepart(Booking $booking, Sparepart $sparepart)
    {
        $pivot = $booking->spareparts()->where('sparepart_id', $sparepart->id)->first();

        if ($pivot) {
            DB::transaction(function () use ($booking, $sparepart, $pivot) {
                $sparepart->increment('stok', $pivot->pivot->qty);
                $booking->spareparts()->detach($sparepart->id);
            });
        }

        return redirect()->route('admin.bookings.edit', $booking)->with('success', 'Sparepart berhasil dihapus dari booking.');
    }
}
