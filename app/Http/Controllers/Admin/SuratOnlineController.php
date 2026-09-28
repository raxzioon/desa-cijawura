<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SuratOnline::latest();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan jenis surat
        if ($request->has('jenis_surat') && $request->jenis_surat != '') {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // Search berdasarkan nama atau NIK
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        $suratOnline = $query->paginate(15);

        return view('admin.surat_online.index', compact('suratOnline'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.surat_online.create');
    }

    /**
     * Store a newly created resource in storage.
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
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
            'file_persyaratan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nomor_surat' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file_persyaratan')) {
            $data['file_persyaratan'] = $request->file('file_persyaratan')->store('persyaratan_surat', 'public');
        }

        // Set tanggal selesai jika status selesai
        if ($request->status == 'selesai') {
            $data['tanggal_selesai'] = now();
        }

        SuratOnline::create($data);

        return redirect()->route('admin.surat-online.index')
                        ->with('success', 'Surat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratOnline $suratOnline)
    {
        return view('admin.surat_online.show', compact('suratOnline'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratOnline $suratOnline)
    {
        return view('admin.surat_online.edit', compact('suratOnline'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratOnline $suratOnline)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'jenis_surat' => 'required|string',
            'keperluan' => 'required|string',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
            'file_persyaratan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nomor_surat' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file_persyaratan')) {
            // Delete old file if exists
            if ($suratOnline->file_persyaratan && Storage::disk('public')->exists($suratOnline->file_persyaratan)) {
                Storage::disk('public')->delete($suratOnline->file_persyaratan);
            }
            $data['file_persyaratan'] = $request->file('file_persyaratan')->store('persyaratan_surat', 'public');
        }

        // Set tanggal selesai jika status berubah ke selesai
        if ($request->status == 'selesai' && $suratOnline->status != 'selesai') {
            $data['tanggal_selesai'] = now();
        }

        // Reset tanggal selesai jika status bukan selesai
        if ($request->status != 'selesai') {
            $data['tanggal_selesai'] = null;
        }

        $suratOnline->update($data);

        return redirect()->route('admin.surat-online.index')
                        ->with('success', 'Surat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratOnline $suratOnline)
    {
        // Delete file if exists
        if ($suratOnline->file_persyaratan && Storage::disk('public')->exists($suratOnline->file_persyaratan)) {
            Storage::disk('public')->delete($suratOnline->file_persyaratan);
        }

        $suratOnline->delete();

        return redirect()->route('admin.surat-online.index')
                        ->with('success', 'Surat berhasil dihapus.');
    }

    /**
     * Update status surat
     */
    public function updateStatus(Request $request, SuratOnline $suratOnline)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
            'nomor_surat' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['status', 'catatan_admin', 'nomor_surat']);

        // Set tanggal selesai jika status berubah ke selesai
        if ($request->status == 'selesai' && $suratOnline->status != 'selesai') {
            $data['tanggal_selesai'] = now();
        }

        // Reset tanggal selesai jika status bukan selesai
        if ($request->status != 'selesai') {
            $data['tanggal_selesai'] = null;
        }

        $suratOnline->update($data);

        return redirect()->back()->with('success', 'Status surat berhasil diperbarui.');
    }
}
