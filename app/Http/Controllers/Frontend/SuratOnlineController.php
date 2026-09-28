<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SuratOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratOnlineController extends Controller
{
    /**
     * Display the surat online form
     */
    public function index()
    {
        return view('frontend.surat_online.index');
    }

    /**
     * Store a new surat online request
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'file_persyaratan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'g-recaptcha-response' => ['required', new \App\Rules\Recaptcha()],
        ]);

        $data = $request->all();
        $data['status'] = 'pending'; // Default status

        // Handle file upload
        if ($request->hasFile('file_persyaratan')) {
            $data['file_persyaratan'] = $request->file('file_persyaratan')->store('persyaratan_surat', 'public');
        }

        $suratOnline = SuratOnline::create($data);

        return redirect()->route('surat-online.status', $suratOnline->id)
                        ->with('success', 'Pengajuan surat berhasil dikirim. Anda akan menerima notifikasi melalui email/telepon ketika surat sudah diproses.');
    }

    /**
     * Show the status check form
     */
    public function checkStatus()
    {
        return view('frontend.surat_online.check_status');
    }

    /**
     * Search and show surat status
     */
    public function searchStatus(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
        ]);

        $suratList = SuratOnline::where('nik', $request->nik)
                                ->where('nama', 'like', '%' . $request->nama . '%')
                                ->latest()
                                ->get();

        if ($suratList->isEmpty()) {
            return back()->with('error', 'Tidak ada pengajuan surat ditemukan dengan NIK dan nama tersebut.');
        }

        return view('frontend.surat_online.status_result', compact('suratList'));
    }

    /**
     * Show specific surat status
     */
    public function showStatus($id)
    {
        $suratOnline = SuratOnline::findOrFail($id);
        
        return view('frontend.surat_online.show_status', compact('suratOnline'));
    }
}
