<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Laporaninventaris;
use App\Models\peminjam;
use App\Models\Riwayatpeminjam;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
{

    if (Auth::id()) {
        $role = Auth::user()->role;

        if ($role == 'staff') {
            // Assuming you want to pass data to the 'dashboard' view
            return view('dashboard', [
                'barangdata' => Barang::count(),
                'Riwayatdata' => Riwayatpeminjam::count(),
                'laporandata' => Laporaninventaris::count(),
                // Add other necessary data here
            ]);
        } elseif ($role == 'kepalalab') {
            return view('kepalalab.dashboard.index', [
                'barangdata' => Barang::count(),
                'peminjamdata' => peminjam::count(),
                'laporandata' => Laporaninventaris::count(),
                // Add other necessary data here
            ]);
        } elseif ($role == 'teknisi') {
            return view('teknisi.dashboard.index', [
                'laporandata' => Laporaninventaris::count(),
                // Add other necessary data here
            ]);
        } else {
            return redirect()->back();
        }
    }
}





}
