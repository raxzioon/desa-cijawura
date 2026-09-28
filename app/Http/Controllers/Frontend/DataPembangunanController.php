<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DataPembangunan;

class DataPembangunanController extends Controller
{
    /**
     * Display a listing of data_pembangunan.
     */
    public function index()
    {
        $data_pembangunan = DataPembangunan::orderBy('created_at', 'desc')
            ->paginate(6);

        return view('frontend.data_pembangunan.index', compact('data_pembangunan'));
    }


    /**
     * Display a specific data_pembangunan.
     */
    public function show(string $slug)
    {
        $data_pembangunan = DataPembangunan::where('slug', $slug)
            ->firstOrFail();

        return view('frontend.data_pembangunan.show', compact('data_pembangunan'));
    }
}
