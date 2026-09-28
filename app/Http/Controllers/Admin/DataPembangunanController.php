<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPembangunan; // Import model DataPembangunan
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk kelola gambar

class DataPembangunanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_pembangunan = DataPembangunan::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.data_pembangunan.index', compact('data_pembangunan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_pembangunan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:data_pembangunan,title',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Batas 2MB
            'date_at' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('data_pembangunan_images', 'public');
        }

        DataPembangunan::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'lokasi' => $request->lokasi,
            'date_at' => $request->date_at ?? now()
        ]);

        return redirect()->route('admin.data-pembangunan.index')->with('success', 'Data Pembangunan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPembangunan $data_pembangunan)
    {
        return view('admin.data_pembangunan.edit', compact('data_pembangunan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataPembangunan $data_pembangunan)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:data_pembangunan,title,' . $data_pembangunan->id, // Unique kecuali ID sendiri
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date_at' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255'
        ]);

        $imagePath = $data_pembangunan->image; // Pertahankan gambar lama secara default
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($data_pembangunan->image && Storage::disk('public')->exists($data_pembangunan->image)) {
                Storage::disk('public')->delete($data_pembangunan->image);
            }
            $imagePath = $request->file('image')->store('data_pembangunan_images', 'public');
        }

        $data_pembangunan->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title), // Slug otomatis diperbarui oleh model
            'content' => $request->content,
            'image' => $imagePath,
            'lokasi' => $request->lokasi,
            'date_at' => $request->date_at ?? now()
        ]);

        return redirect()->route('admin.data-pembangunan.index')->with('success', 'Data Pembangunan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPembangunan $data_pembangunan)
    {
        // Boot method di model DataPembangunan akan menghapus gambar terkait
        $data_pembangunan->delete();
        return redirect()->route('admin.data-pembangunan.index')->with('success', 'Data Pembangunan berhasil dihapus.');
    }
}
