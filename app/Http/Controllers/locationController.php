<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class locationController extends Controller
{
    public function index()
    {
        $location = Lokasi::orderBy('id', 'ASC')->get();

        return response()->json(['data' => $location]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
            'id_area' => 'required',
        ]);


        Lokasi::create([
            'lokasi' => $request->lokasi,
            'id_area' => $request->id_area
        ]);

        return response()->json(['message' => 'berhasil']);
    }
}
