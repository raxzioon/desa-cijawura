<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataStatistik;
use Illuminate\Http\Request;

class DataStatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataStatistik = DataStatistik::ordered()->get();
        return view('admin.data_statistik.index', compact('dataStatistik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_statistik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_statistik' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:255',
            'warna' => 'required|string|max:7',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        DataStatistik::create([
            'nama_statistik' => $request->nama_statistik,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon,
            'warna' => $request->warna,
            'urutan' => $request->urutan,
            'is_active' => $request->boolean('is_active', false),
        ]);

        return redirect()->route('admin.data-statistik.index')
            ->with('success', 'Data statistik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataStatistik $dataStatistik)
    {
        return view('admin.data_statistik.show', compact('dataStatistik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataStatistik $dataStatistik)
    {
        return view('admin.data_statistik.edit', compact('dataStatistik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataStatistik $dataStatistik)
    {
        $request->validate([
            'nama_statistik' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:255',
            'warna' => 'required|string|max:7',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $dataStatistik->update([
            'nama_statistik' => $request->nama_statistik,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'icon' => $request->icon,
            'warna' => $request->warna,
            'urutan' => $request->urutan,
            'is_active' => $request->boolean('is_active', false),
        ]);

        return redirect()->route('admin.data-statistik.index')
            ->with('success', 'Data statistik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataStatistik $dataStatistik)
    {
        $dataStatistik->delete();

        return redirect()->route('admin.data-statistik.index')
            ->with('success', 'Data statistik berhasil dihapus.');
    }
}
