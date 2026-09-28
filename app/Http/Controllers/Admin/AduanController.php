<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FileUploadHelper;

class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Aduan::latest();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan jenis aduan
        if ($request->has('jenis_aduan') && $request->jenis_aduan != '') {
            $query->where('jenis_aduan', $request->jenis_aduan);
        }

        // Search berdasarkan nama atau NIK dengan parameter binding yang aman
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Sanitize search term - prevent SQL injection
            $searchTerm = htmlspecialchars(strip_tags($searchTerm), ENT_QUOTES, 'UTF-8');
            $searchTerm = trim($searchTerm);
            
            if (strlen($searchTerm) > 0 && strlen($searchTerm) <= 255) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('nama', 'like', '%' . $searchTerm . '%')
                      ->orWhere('nik', 'like', '%' . $searchTerm . '%');
                });
            }
        }

        $aduan = $query->paginate(15);

        return view('admin.aduan.index', compact('aduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.aduan.create');
    }

    /**
     * Store a newly created resource in storage.
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
            'lokasi_kejadian' => 'string',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
            'lampiran_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nomor_aduan' => 'nullable|string|max:255',
        ]);

        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jenis_aduan' => $request->jenis_aduan,
            'isi_aduan' => $request->isi_aduan,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'nomor_aduan' => $request->nomor_aduan,
        ];

        // Handle secure file upload
        if ($request->hasFile('lampiran_pendukung')) {
            $allowedMimes = [
                'application/pdf',
                'image/jpeg',
                'image/jpg',
                'image/png',
            ];
            
            if (FileUploadHelper::validateFile($request->file('lampiran_pendukung'), $allowedMimes)) {
                $data['lampiran_pendukung'] = FileUploadHelper::secureUpload(
                    $request->file('lampiran_pendukung'), 
                    'lampiran_pendukung'
                );
            }
        }

        // Set tanggal selesai jika status selesai
        if ($request->status == 'selesai') {
            $data['tanggal_selesai'] = now();
        }

        Aduan::create($data);

        return redirect()->route('admin.aduan.index')
            ->with('success', 'aduan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aduan $aduan)
    {
        return view('admin.aduan.show', compact('aduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aduan $aduan)
    {
        return view('admin.aduan.edit', compact('aduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aduan $aduan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'required|string',
            'jenis_aduan' => 'required|string',
            'isi_aduan' => 'required|string',
            'lokasi_kejadian' => 'string',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
            'lampiran_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nomor_aduan' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Handle secure file upload
        if ($request->hasFile('lampiran_pendukung')) {
            // Delete old file securely
            FileUploadHelper::secureDelete($aduan->lampiran_pendukung);
            
            $allowedMimes = [
                'application/pdf',
                'image/jpeg',
                'image/jpg',
                'image/png',
            ];
            
            if (FileUploadHelper::validateFile($request->file('lampiran_pendukung'), $allowedMimes)) {
                $data['lampiran_pendukung'] = FileUploadHelper::secureUpload(
                    $request->file('lampiran_pendukung'), 
                    'lampiran_pendukung'
                );
            }
        }

        // Set tanggal selesai jika status berubah ke selesai
        if ($request->status == 'selesai' && $aduan->status != 'selesai') {
            $data['tanggal_selesai'] = now();
        }

        // Reset tanggal selesai jika status bukan selesai
        if ($request->status != 'selesai') {
            $data['tanggal_selesai'] = null;
        }

        $aduan->update($data);

        return redirect()->route('admin.aduan.index')
            ->with('success', 'aduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aduan $aduan)
    {
        // Delete file securely
        FileUploadHelper::secureDelete($aduan->lampiran_pendukung);

        $aduan->delete();

        return redirect()->route('admin.aduan.index')
            ->with('success', 'aduan berhasil dihapus.');
    }

    /**
     * Update status aduan
     */
    public function updateStatus(Request $request, Aduan $aduan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
            'nomor_aduan' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['status', 'catatan_admin', 'nomor_aduan']);

        // Set tanggal selesai jika status berubah ke selesai
        if ($request->status == 'selesai' && $aduan->status != 'selesai') {
            $data['tanggal_selesai'] = now();
        }

        // Reset tanggal selesai jika status bukan selesai
        if ($request->status != 'selesai') {
            $data['tanggal_selesai'] = null;
        }

        $aduan->update($data);

        return redirect()->back()->with('success', 'Status aduan berhasil diperbarui.');
    }
}
