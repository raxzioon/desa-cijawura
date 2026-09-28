<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AduanController extends Controller
{
    /**
     * Display the aduan form
     */
    public function index()
    {
        return view('frontend.aduan.index');
    }

    /**
     * Store a new aduan request
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'jenis_aduan' => 'required|string',
            'isi_aduan' => 'required|string',
            'lokasi_kejadian' => 'nullable|string',
            'lampiran_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'g-recaptcha-response' => ['required', new \App\Rules\Recaptcha()],
        ]);

        $data = $request->all();
        $data['status'] = 'pending';  // Default status
        //no aduan
        $today = Carbon::now();
        $lastAduan = Aduan::whereDate('created_at', $today)->latest()->first();
        $nomorUrut = $lastAduan ? $lastAduan->nomor_aduan_int + 1 : 1; // Asumsi ada kolom nomor_aduan_int
        $data['nomor_aduan'] = 'ADU-' . $today->format('Ymd') . '-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

        // Handle file upload
        if ($request->hasFile('lampiran_pendukung')) {
            $data['lampiran_pendukung'] = $request->file('lampiran_pendukung')->store('lampiran_aduan', 'public');
        }

        $aduan = Aduan::create($data);

        return redirect()->route('aduan.status', $aduan->id)
            ->with('success', 'Aduan berhasil dikirim. Anda akan menerima notifikasi melalui email/telepon ketika aduan sudah diproses.');
    }

    /**
     * Show the status check form
     */
    public function checkStatus()
    {
        return view('frontend.aduan.check_status');
    }

    /**
     * Search and show aduan status
     */
    public function searchStatus(Request $request)
    {
        $request->validate([
            'nomor_aduan' => 'required|string|max:255',
        ]);

        $aduanList = Aduan::where('nomor_aduan', $request->nomor_aduan)
            ->latest()
            ->get();

        if ($aduanList->isEmpty()) {
            return back()->with('error', 'Tidak ada aduan ditemukan dengan Nomor tersebut.');
        }

        return view('frontend.aduan.status_result', compact('aduanList'));
    }

    /**
     * Show specific aduan status
     */
    public function showStatus($id)
    {
        $aduan = Aduan::findOrFail($id);

        return view('frontend.aduan.show_status', compact('aduan'));
    }
}
