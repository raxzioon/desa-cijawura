<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProfileContent; // Import model ProfileContent
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visionMission()
    {
        // Ambil konten Visi dari database
        $visi = ProfileContent::where('key', 'visi')->first();
        // Ambil konten Misi dari database
        $misi = ProfileContent::where('key', 'misi')->first();

        return view('frontend.profile.vision_mission', compact('visi', 'misi'));
    }

    public function history()
    {
        // Ambil konten Sejarah dari database
        $sejarah = ProfileContent::where('key', 'sejarah')->first();
        return view('frontend.profile.history', compact('sejarah'));
    }

    public function structure()
    {
        // Ambil konten Struktur Pemerintahan dari database
        $structure = ProfileContent::where('key', 'struktur_pemerintahan')->first();
        return view('frontend.profile.structure', compact('structure'));
    }

    public function geografis()
    {
        // Ambil konten Struktur Pemerintahan dari database
        $geografis = ProfileContent::where('key', 'geografis')->first();
        // --- PERBAIKAN DI SINI UNTUK GOOGLE MAPS ---
        // Ambil entri ProfileContent untuk latitude dan longitude secara terpisah
        $googleMapsLatitudeContent = ProfileContent::where('key', 'Maps_latitude')->first();
        $googleMapsLongitudeContent = ProfileContent::where('key', 'Maps_longitude')->first();

        $googleMapsEmbedUrl = null; // Default null
        // Bangun URL embed langsung di sini
        if (
            $googleMapsLatitudeContent && $googleMapsLatitudeContent->content &&
            $googleMapsLongitudeContent && $googleMapsLongitudeContent->content
        ) {

            $lat = $googleMapsLatitudeContent->content;
            $lon = $googleMapsLongitudeContent->content;
            $googleMapsEmbedUrl = "https://maps.google.com/maps?q=Pungsari,+Kec.+Plupuh,+Kabupaten+Sragen,+Jawa+Tengah&hl=en&z=14&output=embed";
        }
        // --- AKHIR PERBAIKAN GOOGLE MAPS ---

        return view('frontend.profile.geografis', compact('geografis', 'googleMapsEmbedUrl'));
    }
}
