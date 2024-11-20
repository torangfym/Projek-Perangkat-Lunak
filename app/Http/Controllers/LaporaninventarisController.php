<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\laporaninventaris;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class LaporaninventarisController extends Controller
{

    public function role()
    {
        if (Auth::id()) {
            $role = Auth::user()->role;

            if ($role == 'staff') {
                return view('dashboard');
            } elseif ($role == 'kepalalab') {
                return view('kepalalab.dashboard.index');
            } elseif ($role == 'teknisi') {
                return view('teknisi.dashboard.index');
            } else {
                return redirect()->back();
            }
        }
    }


    public function index(Request $request)
    {

        // Lanjutkan dengan mengambil data kategori dan barang
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        // Combine kategorilist and baranglist into one collection
        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        // Ambil data peminjaman berdasarkan idpeminjam
        $data_teknisi = DB::table('laporaninventaris')
            ->join('kategori', 'kategori.idkategori', '=', 'laporaninventaris.idkategori')
            ->join('barang', 'barang.idbarang', '=', 'laporaninventaris.idbarang')
            ->join('users', 'users.id', '=', 'laporaninventaris.id')
            ->select(
                'laporaninventaris.idlaporaninventaris',
                'barang.idbarang',
                'kategori.idkategori',
                'users.id',
                'users.name',
                'kategori.namakategori as namakategori',
                'kategori.jenis as jenis',
                'kategori.merk as merk',
                'barang.kondisi',
                'barang.asal',
                'kategori.jenis',
                'barang.kodebarcode',
                'barang.gambar',
                'laporaninventaris.asalteknisi',
                'laporaninventaris.kondisiterbaru',
                'laporaninventaris.gambarterbaru',
                'laporaninventaris.detail',
                'laporaninventaris.created_at',
            )
            ->get();

        // Return the view with the data
        return view('teknisi.laporaninventaris.index', compact('data_teknisi', 'kategorilist', 'baranglist', 'kombinasilist'));
    }

    public function indexstaff(Request $request)
    {

        // Lanjutkan dengan mengambil data kategori dan barang
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        // Combine kategorilist and baranglist into one collection
        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        // Ambil data peminjaman berdasarkan idpeminjam
        $data_teknisi = DB::table('laporaninventaris')
            ->join('kategori', 'kategori.idkategori', '=', 'laporaninventaris.idkategori')
            ->join('barang', 'barang.idbarang', '=', 'laporaninventaris.idbarang')
            ->join('users', 'users.id', '=', 'laporaninventaris.id')
            ->select(
                'laporaninventaris.idlaporaninventaris',
                'barang.idbarang',
                'kategori.idkategori',
                'users.id',
                'users.name',
                'kategori.namakategori as namakategori',
                'kategori.jenis as jenis',
                'kategori.merk as merk',
                'barang.kondisi',
                'barang.asal',
                'kategori.jenis',
                'barang.kodebarcode',
                'barang.gambar',
                'laporaninventaris.asalteknisi',
                'laporaninventaris.kondisiterbaru',
                'laporaninventaris.gambarterbaru',
                'laporaninventaris.detail',
                'laporaninventaris.created_at',
            )
            ->get();

        // Return the view with the data
        return view('staff.laporaninventaris.index', compact('data_teknisi', 'kategorilist', 'baranglist', 'kombinasilist'));
    }



    public function post(Request $request)
{
    // DD($request->all());

    // Validasi formulir
    $request->validate([
        'idbarang' => 'required', // Aturan validasi untuk idbarang
        'asalteknisi' => 'required',
        'idkategori' => 'required',
        'detail' => 'required',
        'kondisiterbaru' => 'required',
        'created_at' => 'required|date',
        'gambarterbaru' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
    ]);

    $idkategori = $request->input('idkategori');

    // Debugging line, you may remove this once everything is working fine
    $kodeBarcode = $request->filled('kodebarcode') ? $request->kodebarcode : $request->idbarang;

    try {
        // Cari Barang berdasarkan kodebarcode
        $barang = Barang::where('kodebarcode', $kodeBarcode)->firstOrFail();

        // Buat instance model Laporaninventaris
        $laporan = new Laporaninventaris([
            'idbarang' => $barang->idbarang,
            'id' => Auth::id(),
            'idkategori' => $request->input('idkategori'),
            'asalteknisi' => $request->input('asalteknisi'),
            'detail' => $request->input('detail'),
            'kondisiterbaru' => $request->input('kondisiterbaru'),
            'created_at' => Carbon::parse($request->input('created_at'))->format('Y-m-d H:i:s'),
        ]);

        // Simpan model ke dalam database


        if ($request->hasFile('gambarterbaru')) {
            $gambarFile = $request->file('gambarterbaru');

            // Generate a unique file name
            $gambarFileName = date('YmdHis') . '_' . Str::random(5) . '.' . $gambarFile->getClientOriginalExtension();

            // Store the file in the 'public/gambar_barang' directory
            $gambarPath = $gambarFile->storeAs('public/gambar_barang', $gambarFileName);

            // Get the public URL of the stored file
            $gambarUrl = Storage::url($gambarPath);

            // Set the file URL in the Laporaninventaris model
            $laporan->gambarterbaru = $gambarUrl;
        }

        $laporan->save();

        // Redirect kembali atau ke rute tertentu
        return redirect()->back()->with('success', 'Laporan Inventaris berhasil disimpan');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Barang tidak ditemukan, handle sesuai kebutuhan
        return redirect()->back()->with('error', 'Barang tidak ditemukan');
    } catch (\Exception $e) {
        // Handle pengecualian lain jika diperlukan
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

public function poststaff(Request $request)
{
    // DD($request->all());

    // Validasi formulir
    $request->validate([
        'idbarang' => 'required', // Aturan validasi untuk idbarang
        'asalteknisi' => 'required',
        'idkategori' => 'required',
        'detail' => 'required',
        'kondisiterbaru' => 'required',
        'created_at' => 'required|date',
        'gambarterbaru' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
    ]);

    $idkategori = $request->input('idkategori');

    // Debugging line, you may remove this once everything is working fine
    $kodeBarcode = $request->filled('kodebarcode') ? $request->kodebarcode : $request->idbarang;

    try {
        // Cari Barang berdasarkan kodebarcode
        $barang = Barang::where('kodebarcode', $kodeBarcode)->firstOrFail();

        // Buat instance model Laporaninventaris
        $laporan = new Laporaninventaris([
            'idbarang' => $barang->idbarang,
            'id' => Auth::id(),
            'idkategori' => $request->input('idkategori'),
            'asalteknisi' => $request->input('asalteknisi'),
            'detail' => $request->input('detail'),
            'kondisiterbaru' => $request->input('kondisiterbaru'),
            'created_at' => Carbon::parse($request->input('created_at'))->format('Y-m-d H:i:s'),
        ]);

        // Simpan model ke dalam database


        if ($request->hasFile('gambarterbaru')) {
            $gambarFile = $request->file('gambarterbaru');

            // Generate a unique file name
            $gambarFileName = date('YmdHis') . '_' . Str::random(5) . '.' . $gambarFile->getClientOriginalExtension();

            // Store the file in the 'public/gambar_barang' directory
            $gambarPath = $gambarFile->storeAs('public/gambar_barang', $gambarFileName);

            // Get the public URL of the stored file
            $gambarUrl = Storage::url($gambarPath);

            // Set the file URL in the Laporaninventaris model
            $laporan->gambarterbaru = $gambarUrl;
        }

        $laporan->save();

        // Redirect kembali atau ke rute tertentu
        return redirect()->route('laporaninventaris.staff')->with('success', 'Laporan Inventaris berhasil disimpan');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Barang tidak ditemukan, handle sesuai kebutuhan
        return redirect()->route('laporaninventaris.staff')->with('error', 'Barang tidak ditemukan');
    } catch (\Exception $e) {
        // Handle pengecualian lain jika diperlukan
        return redirect()->route('laporaninventaris.staff')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}



    public function update(Request $request, $idlaporaninventaris)
    {

        $request->validate([
            'idbarang' => 'required|exists:barang,idbarang',
            'idkategori' => 'required|exists:kategori,idkategori',
            'asalteknisi' => 'required',
            'detail' => 'required',
            'kondisiterbaru' => 'required|in:baik,rusak',
            'created_at' => 'required|date_format:Y-m-d\TH:i',
            'gambarterbaru' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Use the Eloquent model to update the record
            $laporaninventaris = Laporaninventaris::findOrFail($idlaporaninventaris);

            // Assign values to attributes
            $laporaninventaris->id = Auth::id();
            $laporaninventaris->idbarang = $request->input('idbarang');
            $laporaninventaris->idkategori = $request->input('idkategori');
            $laporaninventaris->asalteknisi = $request->input('asalteknisi'); // Corrected typo
            $laporaninventaris->detail = $request->input('detail');
            $laporaninventaris->kondisiterbaru = $request->input('kondisiterbaru'); // Corrected typo
            $laporaninventaris->created_at = Carbon::parse($request->input('created_at'));

            // Handle image upload
            if ($request->hasFile('gambarterbaru')) {
                $gambarFile = $request->file('gambarterbaru');

                $gambarFileName = date('YmdHis') . '_' . Str::random(5) . '.' . $gambarFile->getClientOriginalExtension();

                $gambarPath = $gambarFile->storeAs('public/gambar_barang', $gambarFileName);
                $gambarUrl = Storage::url($gambarPath);

                $laporaninventaris->gambarterbaru = $gambarUrl;
            }

            $laporaninventaris->save();

            return redirect()->route('laporaninventaris.teknisi')->with('success', 'Data Laporan inventaris berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating Laporan inventaris: ' . $e->getMessage());
        }
    }

    public function updatestaff(Request $request, $idlaporaninventaris)
    {

        $request->validate([
            'idbarang' => 'required|exists:barang,idbarang',
            'idkategori' => 'required|exists:kategori,idkategori',
            'asalteknisi' => 'required',
            'detail' => 'required',
            'kondisiterbaru' => 'required|in:baik,rusak',
            'created_at' => 'required|date_format:Y-m-d\TH:i',
            'gambarterbaru' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Use the Eloquent model to update the record
            $laporaninventaris = Laporaninventaris::findOrFail($idlaporaninventaris);

            // Assign values to attributes
            $laporaninventaris->id = Auth::id();
            $laporaninventaris->idbarang = $request->input('idbarang');
            $laporaninventaris->idkategori = $request->input('idkategori');
            $laporaninventaris->asalteknisi = $request->input('asalteknisi'); // Corrected typo
            $laporaninventaris->detail = $request->input('detail');
            $laporaninventaris->kondisiterbaru = $request->input('kondisiterbaru'); // Corrected typo
            $laporaninventaris->created_at = Carbon::parse($request->input('created_at'));

            // Handle image upload
            if ($request->hasFile('gambarterbaru')) {
                $gambarFile = $request->file('gambarterbaru');

                $gambarFileName = date('YmdHis') . '_' . Str::random(5) . '.' . $gambarFile->getClientOriginalExtension();

                $gambarPath = $gambarFile->storeAs('public/gambar_barang', $gambarFileName);
                $gambarUrl = Storage::url($gambarPath);

                $laporaninventaris->gambarterbaru = $gambarUrl;
            }

            $laporaninventaris->save();

            return redirect()->route('laporaninventaris.staff')->with('success', 'Data Laporan inventaris berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating Laporan inventaris: ' . $e->getMessage());
        }
    }

    public function hapus($idlaporaninventaris)
    {
        try {
            // Use the Eloquent model to find the record
            $laporaninventaris = Laporaninventaris::findOrFail($idlaporaninventaris);

            // Handle deleting associated image (if any)
            if ($laporaninventaris->gambarterbaru) {
                Storage::delete('public/gambar_barang/' . basename($laporaninventaris->gambarterbaru));
            }

            // Use the DB facade to delete the record
            DB::table('laporaninventaris')->where('idlaporaninventaris', $idlaporaninventaris)->delete();

            return redirect()->back()->with('success', 'Data Laporan inventaris berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting Laporan inventaris: ' . $e->getMessage());
        }
    }

    public function hapusstaff($idlaporaninventaris)
    {
        try {
            // Use the Eloquent model to find the record
            $laporaninventaris = Laporaninventaris::findOrFail($idlaporaninventaris);

            // Handle deleting associated image (if any)
            if ($laporaninventaris->gambarterbaru) {
                Storage::delete('public/gambar_barang/' . basename($laporaninventaris->gambarterbaru));
            }

            // Use the DB facade to delete the record
            DB::table('laporaninventaris')->where('idlaporaninventaris', $idlaporaninventaris)->delete();

            return redirect()->route('laporaninventaris.staff')->with('success', 'Data Laporan inventaris berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting Laporan inventaris: ' . $e->getMessage());
        }
    }

    public function edit($idlaporaninventaris)
    {
        try {

            // Ambil data laporaninventaris berdasarkan ID
            $laporaninventaris = Laporaninventaris::findOrFail($idlaporaninventaris);
            $kategorilist = Kategori::all();
            $baranglist = Barang::all();

            // Ambil data untuk dropdown pilihan barang
            $kombinasilist = Barang::all();
            $data_teknisi = DB::table('laporaninventaris')
            ->join('kategori', 'kategori.idkategori', '=', 'laporaninventaris.idkategori')
            ->join('barang', 'barang.idbarang', '=', 'laporaninventaris.idbarang')
            ->join('users', 'users.id', '=', 'laporaninventaris.id')
            ->select(
                'laporaninventaris.idlaporaninventaris',
                'barang.idbarang',
                'kategori.idkategori',
                'users.id',
                'users.name',
                'kategori.namakategori as namakategori',
                'kategori.jenis as jenis',
                'kategori.merk as merk',
                'barang.kondisi',
                'barang.asal',
                'kategori.jenis',
                'barang.kodebarcode',
                'barang.gambar',
                'laporaninventaris.asalteknisi',
                'laporaninventaris.kondisiterbaru',
                'laporaninventaris.gambarterbaru',
                'laporaninventaris.detail',
                'laporaninventaris.created_at',
            )
            ->get(); // Replace this with your actual logic to get the data

            return view('teknisi.laporaninventaris.edit', compact('data_teknisi', 'kategorilist', 'baranglist', 'kombinasilist','laporaninventaris'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error retrieving data: ' . $e->getMessage());
        }
    }

    public function editstaff($idlaporaninventaris)
    {
        try {

            // Ambil data laporaninventaris berdasarkan ID
            $laporaninventaris = Laporaninventaris::findOrFail($idlaporaninventaris);
            $kategorilist = Kategori::all();
            $baranglist = Barang::all();

            // Ambil data untuk dropdown pilihan barang
            $kombinasilist = Barang::all();
            $data_teknisi = DB::table('laporaninventaris')
            ->join('kategori', 'kategori.idkategori', '=', 'laporaninventaris.idkategori')
            ->join('barang', 'barang.idbarang', '=', 'laporaninventaris.idbarang')
            ->join('users', 'users.id', '=', 'laporaninventaris.id')
            ->select(
                'laporaninventaris.idlaporaninventaris',
                'barang.idbarang',
                'kategori.idkategori',
                'users.id',
                'users.name',
                'kategori.namakategori as namakategori',
                'kategori.jenis as jenis',
                'kategori.merk as merk',
                'barang.kondisi',
                'barang.asal',
                'kategori.jenis',
                'barang.kodebarcode',
                'barang.gambar',
                'laporaninventaris.asalteknisi',
                'laporaninventaris.kondisiterbaru',
                'laporaninventaris.gambarterbaru',
                'laporaninventaris.detail',
                'laporaninventaris.created_at',
            )
            ->get(); // Replace this with your actual logic to get the data

            return view('staff.laporaninventaris.edit', compact('data_teknisi', 'kategorilist', 'baranglist', 'kombinasilist','laporaninventaris'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error retrieving data: ' . $e->getMessage());
        }
    }

    public function getLaporanData()
    {

        $countData = Laporaninventaris::count();
        dd($countData); // Debugging line

        // Pass the count data to the view
        return view('kepalalab.laporaninventaris.index', ['countData' => $countData]);
    }
    public function indexkepalalab(Request $request)
    {

        // Lanjutkan dengan mengambil data kategori dan barang
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();
        $countData = Laporaninventaris::count();

        // Combine kategorilist and baranglist into one collection
        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        // Ambil data peminjaman berdasarkan idpeminjam
        $data_teknisi = DB::table('laporaninventaris')
            ->join('kategori', 'kategori.idkategori', '=', 'laporaninventaris.idkategori')
            ->join('barang', 'barang.idbarang', '=', 'laporaninventaris.idbarang')
            ->join('users', 'users.id', '=', 'laporaninventaris.id')
            ->select(
                'laporaninventaris.idlaporaninventaris',
                'barang.idbarang',
                'kategori.idkategori',
                'users.id',
                'users.name',
                'kategori.namakategori as namakategori',
                'kategori.jenis as jenis',
                'kategori.merk as merk',
                'barang.kondisi',
                'barang.asal',
                'kategori.jenis',
                'barang.kodebarcode',
                'barang.gambar',
                'laporaninventaris.asalteknisi',
                'laporaninventaris.kondisiterbaru',
                'laporaninventaris.gambarterbaru',
                'laporaninventaris.detail',
                'laporaninventaris.created_at',

            )
            ->get();


        // Return the view with the data
        return view('kepalalab.laporaninventaris.index', compact('data_teknisi','countData', 'kategorilist', 'baranglist', 'kombinasilist'));
    }

    public function detail(Request $request)
    {

        // Lanjutkan dengan mengambil data kategori dan barang
        $kategorilist = Kategori::all();
        $baranglist = Barang::all();

        // Combine kategorilist and baranglist into one collection
        $kombinasilist = Barang::with('kategori')->orderBy('idbarang', 'ASC')->get();

        // Ambil data peminjaman berdasarkan idpeminjam
        $data_teknisi = DB::table('laporaninventaris')
            ->join('kategori', 'kategori.idkategori', '=', 'laporaninventaris.idkategori')
            ->join('barang', 'barang.idbarang', '=', 'laporaninventaris.idbarang')
            ->join('users', 'users.id', '=', 'laporaninventaris.id')
            ->select(
                'laporaninventaris.idlaporaninventaris',
                'barang.idbarang',
                'kategori.idkategori',
                'users.id',
                'users.name',
                'kategori.namakategori as namakategori',
                'kategori.jenis as jenis',
                'kategori.merk as merk',
                'barang.kondisi',
                'barang.asal',
                'kategori.jenis',
                'barang.kodebarcode',
                'barang.gambar',
                'laporaninventaris.asalteknisi',
                'laporaninventaris.kondisiterbaru',
                'laporaninventaris.gambarterbaru',
                'laporaninventaris.detail',
                'laporaninventaris.created_at',

            )
            ->get();


        // Return the view with the data
        return view('kepalalab.laporaninventaris.detail', compact('data_teknisi', 'kategorilist', 'baranglist', 'kombinasilist'));
    }







}
