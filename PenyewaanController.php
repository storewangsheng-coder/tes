<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\TarifRental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaans = Penyewaan::with(['penyewa', 'motor'])->get();
        return view('penyewaan.index', compact('penyewaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyewaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_motor'    => 'required|exists:motors,id',
            'tanggal_mulai' => 'required|date',
            'jumlah'      => 'required|integer|min:1',
            'tipe_durasi' => 'required|in:harian,mingguan,bulanan',
        ]);

        $tarif = TarifRental::where('id_motor', $request->id_motor)->first();
        $tanggal_mulai = Carbon::parse($request->tanggal_mulai);
        $jumlah = $request->jumlah;

        if ($request->tipe_durasi == 'harian') {
            $tanggal_selesai = $tanggal_mulai->copy()->addDays($jumlah);
            $harga = $jumlah * $tarif->tarif_harian;

        } elseif ($request->tipe_durasi == 'mingguan') {
            $tanggal_selesai = $tanggal_mulai->copy()->addWeeks($jumlah);
            $harga = $jumlah * $tarif->tarif_mingguan;

        } elseif ($request->tipe_durasi == 'bulanan') {
            $tanggal_selesai = $tanggal_mulai->copy()->addMonths($jumlah);
            $harga = $jumlah * $tarif->tarif_bulanan;
        }

        Penyewaan::create([
            'id_penyewa'      => auth()->id(),
            'id_motor'        => $request->id_motor,
            'tanggal_mulai'   => $tanggal_mulai->timestamp,
            'tanggal_selesai' => $tanggal_selesai->timestamp,
            'tipe_durasi'     => $request->tipe_durasi,
            'harga'           => $harga,
            'status'          => 'menunggu_pembayaran',
        ]);

        return redirect()->back()->with('success', 'Penyewaan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyewaan $penyewaan)
    {
        return view('penyewaan.show', compact('penyewaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewaan $penyewaan)
    {
        return view('penyewaan.edit', compact('penyewaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewaan $penyewaan)
    {
        //
    }
}
