<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function showSubmissionPage()
    {
        $pendingCount = Pengajuan::where('id_status', 5)->count();

        return view('layout.navbar', compact('pendingCount'));
    }
}
