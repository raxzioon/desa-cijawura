<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramDesa;
use Illuminate\Http\Request;

class ProgramDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programDesa = ProgramDesa::ordered()->get();
        return view('admin.program_desa.index', compact('programDesa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program_desa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'urutan' => 'required|integer|min:0'
        ]);

        ProgramDesa::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.program-desa.index')
            ->with('success', 'Data statistik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramDesa $programDesa)
    {
        return view('admin.program_desa.show', compact('programDesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramDesa $programDesa)
    {
        return view('admin.program_desa.edit', compact('programDesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramDesa $programDesa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'urutan' => 'required|integer|min:0'
        ]);

        $programDesa->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.program-desa.index')
            ->with('success', 'Program Desa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramDesa $programDesa)
    {
        $programDesa->delete();

        return redirect()->route('admin.program-desa.index')
            ->with('success', 'Program Desa berhasil dihapus.');
    }
}
