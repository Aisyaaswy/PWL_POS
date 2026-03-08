<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    // Menampilkan halaman awal penjualan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Transaksi Penjualan',
            'list'  => ['Home', 'Penjualan'],
        ];

        $page = (object) [
            'title' => 'Daftar transaksi penjualan yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu,
        ]);
    }

    // Ambil data penjualan dalam bentuk JSON untuk DataTables (server-side)
    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select(
            'penjualan_id',
            'user_id',
            'penjualan_kode',
            'pembeli',
            'penjualan_tanggal'
        )->with('user');

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn  = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm"'
                    . ' onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan form tambah penjualan
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi Penjualan',
            'list'  => ['Home', 'Penjualan', 'Tambah'],
        ];

        $page = (object) [
            'title' => 'Tambah transaksi penjualan baru',
        ];

        $user       = UserModel::all();
        $barang     = BarangModel::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'user'       => $user,
            'barang'     => $barang,
            'activeMenu' => $activeMenu,
        ]);
    }

    // Menyimpan data penjualan + detail sekaligus
    public function store(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|integer',
            'penjualan_kode'    => 'required|string|max:20|unique:t_penjualan,penjualan_kode',
            'pembeli'           => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date',
            'barang_id'         => 'required|array|min:1',
            'barang_id.*'       => 'required|integer',
            'harga.*'           => 'required|integer|min:0',
            'jumlah.*'          => 'required|integer|min:1',
        ]);

        // Simpan header penjualan
        $penjualan = PenjualanModel::create([
            'user_id'           => $request->user_id,
            'penjualan_kode'    => $request->penjualan_kode,
            'pembeli'           => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        // Simpan detail penjualan (bisa lebih dari 1 item)
        foreach ($request->barang_id as $i => $barang_id) {
            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id'    => $barang_id,
                'harga'        => $request->harga[$i],
                'jumlah'       => $request->jumlah[$i],
            ]);
        }

        return redirect('/penjualan')->with('success', 'Transaksi penjualan berhasil disimpan');
    }

    // Menampilkan detail penjualan beserta item-itemnya
    public function show(string $id)
    {
        $penjualan = PenjualanModel::with(['user', 'detail.barang'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi Penjualan',
            'list'  => ['Home', 'Penjualan', 'Detail'],
        ];

        $page = (object) [
            'title' => 'Detail transaksi penjualan',
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'penjualan'  => $penjualan,
            'activeMenu' => $activeMenu,
        ]);
    }

    // Menampilkan form edit penjualan
    public function edit(string $id)
    {
        $penjualan  = PenjualanModel::with('detail.barang')->find($id);
        $user       = UserModel::all();
        $barang     = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Transaksi Penjualan',
            'list'  => ['Home', 'Penjualan', 'Edit'],
        ];

        $page = (object) [
            'title' => 'Edit transaksi penjualan',
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'penjualan'  => $penjualan,
            'user'       => $user,
            'barang'     => $barang,
            'activeMenu' => $activeMenu,
        ]);
    }

    // Menyimpan perubahan data penjualan
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'           => 'required|integer',
            'penjualan_kode'    => 'required|string|max:20|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
            'pembeli'           => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date',
            'barang_id'         => 'required|array|min:1',
            'barang_id.*'       => 'required|integer',
            'harga.*'           => 'required|integer|min:0',
            'jumlah.*'          => 'required|integer|min:1',
        ]);

        // Update header penjualan
        PenjualanModel::find($id)->update([
            'user_id'           => $request->user_id,
            'penjualan_kode'    => $request->penjualan_kode,
            'pembeli'           => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        // Hapus detail lama lalu insert ulang
        PenjualanDetailModel::where('penjualan_id', $id)->delete();

        foreach ($request->barang_id as $i => $barang_id) {
            PenjualanDetailModel::create([
                'penjualan_id' => $id,
                'barang_id'    => $barang_id,
                'harga'        => $request->harga[$i],
                'jumlah'       => $request->jumlah[$i],
            ]);
        }

        return redirect('/penjualan')->with('success', 'Transaksi penjualan berhasil diubah');
    }

    // Menghapus data penjualan beserta detailnya
    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            // Hapus detail terlebih dahulu karena ada foreign key
            PenjualanDetailModel::where('penjualan_id', $id)->delete();
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Transaksi penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Transaksi penjualan gagal dihapus');
        }
    }
}