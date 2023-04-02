<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Berita;
use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\Destination;
use App\Models\Inventaris;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Kuliner;
use App\Models\Menu;
use App\Models\Penginapan;
use App\Models\Reservasi;
use App\Models\Satuan;
use App\Models\TagihanPos;
use App\Models\Tamu;
use App\Models\TransaksiPos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Admin extends Controller
{

    protected $userModel;
    protected $profileUserModel;
    protected $kritikSaranModel;
    protected $kuisionerModel;
    protected $penilaianModel;


    public function __construct()
    {
        $this->userModel = new User();
    }

    public function pengguna()
    {
        $data['pengguna'] = $this->userModel->getAllUser();
        return view('pages.pengguna.index', $data);
    }


    public function pemasukanVilla()
    {
        $data['check_in'] = CheckIn::all();
        return view('pages.pemasukan_villa.index', $data);
    }


    public function kamar()
    {
        $data['kamar'] = Kamar::all();
        return view('pages.kamar.index', $data);
    }

    public function checkOut()
    {
        $data['tamu'] = CheckOut::all();
        $data['kamar'] = Kamar::where('status', '0')->get();
        return view('pages.kamar.check_out', $data);
    }

    public function checkIn($idKamar = null)
    {
        $data['tamu'] = CheckIn::all();
        $today = \Carbon\Carbon::today();
        $data['history_reservasi'] = Reservasi::whereDate('tgl_check_in', '<=', $today)->get();
        $data['reservasi'] = Reservasi::whereDate('tgl_check_in', '>=', $today)->get();
        if ($idKamar) {
            $data['id_kamar'] = $idKamar;
            $data['kamar'] = Kamar::where('id_kamar', $idKamar)->first();
            if ($data['kamar']->status == '0') {
                return redirect('/admin/check_in');
            }
            return view('pages.kamar.proses_cek_in', $data);
        } else {
            $data['kamar'] = Kamar::where('status', '1')->get();
            return view('pages.kamar.check_in', $data);
        }
    }

    public function reservasi($idKamar = null)
    {
        $data['tamu'] = CheckIn::all();
        if ($idKamar) {
            $data['id_kamar'] = $idKamar;
            $data['kamar'] = Kamar::where('id_kamar', $idKamar)->first();
            if ($data['kamar']->status == '0') {
                return redirect('/admin/check_in');
            }
            return view('pages.kamar.proses_reservasi', $data);
        } else {
            $data['kamar'] = Kamar::where('status', '1')->get();
            return view('pages.kamar.check_in', $data);
        }
    }

    public function pos($kategori = null)
    {
        if (!$kategori) {
            $data['menu'] = Menu::all();
            $data['nama_kategori'] = null;
        } else {
            $namaKategori = lineToSpace($kategori);
            $_kategori = Kategori::where('nama_kategori', $namaKategori)->first();
            $idKategori = $_kategori->id_kategori;
            $data['nama_kategori'] = $namaKategori;
            $data['menu'] = Menu::where('id_kategori', $idKategori)->get();
        }
        $data['kategori'] = Kategori::all();
        return view('pages.pos.index', $data);
    }


    public function transaksiPos()
    {
        $data['transaksi'] = TransaksiPos::all();
        return view('pages.transaksi.pos', $data);
    }

    public function detailTransaksiPos($idTransaksiPos)
    {
        $data['transaksi'] = TagihanPos::where('id_transaksi_pos', $idTransaksiPos)->get();
        $data['id_transaksi_pos'] = $idTransaksiPos;
        return view('pages.transaksi.detail', $data);
    }

    public function cetakPos($idTransaksiPos = null)
    {
        if (!$idTransaksiPos) {
            $transaksiTerakhir = TransaksiPos::latest()->first();
            $data['pembayaran'] = $transaksiTerakhir->pembayaran;
            $data['tagihan'] = TagihanPos::where('id_transaksi_pos', $transaksiTerakhir->id_transaksi_pos)->get();
        } else {
            $transaksi = TransaksiPos::where('id_transaksi_pos', $idTransaksiPos)->first();
            $data['pembayaran'] = $transaksi->pembayaran;
            $data['tagihan'] = TagihanPos::where('id_transaksi_pos', $transaksi->id_transaksi_pos)->get();
        }
        return view('pages.pos.cetak', $data);
    }

    public function posKategori($kategori)
    {
        if ($kategori == "all") {
            $data['menu'] = Menu::all();
            $data['nama_kategori'] = '';
        } else {
            $namaKategori = lineToSpace($kategori);
            $_kategori = Kategori::where('nama_kategori', $namaKategori)->first();
            $idKategori = $_kategori->id_kategori;
            $data['nama_kategori'] = $namaKategori;
            $data['menu'] = Menu::where('id_kategori', $idKategori)->get();
        }
        $data['kategori'] = Kategori::all();
        $html = View::make('pages.pos.kategori', $data)->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function posCari(Request $request)
    {
        if ($request['query'] == null || !$request['query'] || empty($request['query'])) {
            $data['menu'] = Menu::all();
            $data['nama_kategori'] = '';
        } else {
            $data['menu'] = Menu::where('nama_menu', 'like', '%' . $request['query'] . '%')->get();
            $data['nama_kategori'] = '';
        }
        $html = View::make('pages.pos.kategori', $data)->render();
        return response()->json([
            'html' => $html,
        ]);
    }

    public function kategori($idKategori = null)
    {
        if ($idKategori) {
            $data['edit'] = Kategori::where('id_kategori', $idKategori)->first();
        } else {
            $data['edit'] = null;
        }
        $data['kategori'] = Kategori::all();
        return view('pages.kategori.index', $data);
    }

    public function menu($idMenu = null)
    {
        if ($idMenu) {
            $data['edit'] = Menu::where('id_menu', $idMenu)->first();
        } else {
            $data['edit'] = null;
        }
        $data['menu'] = Menu::all();
        $data['kategori'] = Kategori::all();
        return view('pages.menu.index', $data);
    }

    public function inventaris()
    {
        $data['kamar'] = Kamar::all();
        return view('pages.kamar.inventaris', $data);
    }

    public function profileUser()
    {
        $data['user'] = User::all();
        $data['profile'] = $this->profileUserModel->getProfileUser();
        return view('pages.rekaptulasi_data.index', $data);
    }


    public function createPos(Request $request)
    {
        $transaksi = TransaksiPos::create([
            'id_user' => auth()->user()->id,
            'tgl_transaksi' => Carbon::now(),
            'jam_transaksi' => getHour(),
            'pembayaran' => (float) str_replace(",", "", $request->pembayaran),
        ])->id;
        foreach ($request->pos as $row) {
            TagihanPos::create([
                'id_transaksi_pos' => $transaksi,
                'id_menu' => $row['id_menu'],
                'qty' => $row['qty']
            ]);
        }
        return 1;
    }

    // fetch data pembelian
    function fetchDataPembelian(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $data['pembelian'] = Barang::Where('nama_barang', 'like', '%' . $query . '%')
                ->orWhere('barcode', 'like', '%' . $query . '%')
                ->paginate(10);

            return view('pages.pembelian.data_pembelian', $data)->render();
        }
    }


    // fetch data user by admin
    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            if ($request->filter == "") {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            } else {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('role', '=', $request->filter)
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            }

            return view('pages.pengguna.users_data', $data)->render();
        }
    }

    // CEK OUT

    public function createCheckOut($id_check_in)
    {
        $checkIn = CheckIn::where('id_check_in', $id_check_in)->first();
        $idKamar = $checkIn ? $checkIn->id_kamar : 0;
        CheckOut::create([
            'id_check_in' => $id_check_in,
            'tgl_check_out' => Carbon::now(),
            'jam_check_out' => getHour(),
        ]);

        Kamar::where('id_kamar', $idKamar)->update([
            'status' => '1'
        ]);

        return redirect('/admin/check_out')->with('message', 'check out berhasil');
    }

    // CRUD CEK IN

    public function createCheckIn(Request $request)
    {
        $tamu = Tamu::create([
            'nama_tamu' => $request->nama_tamu,
            'nomor_identitas' => $request->nomor_identitas,
        ])->id;

        CheckIn::create([
            'id_kamar' => $request->id_kamar,
            'tgl_check_in' => Carbon::now(),
            'jam_check_in' => getHour(),
            'jumlah_tamu' => $request->jumlah_tamu,
            'id_tamu' => $tamu
        ]);

        Kamar::where('id_kamar', $request->id_kamar)->update([
            'status' => '0'
        ]);

        return redirect('/admin/check_in')->with('message', 'data terimpan');
    }

    public function createReservasi(Request $request)
    {
        $tamu = Tamu::create([
            'nama_tamu' => $request->nama_tamu,
            'nomor_identitas' => $request->nomor_identitas,
        ])->id;

        Reservasi::create([
            'id_kamar' => $request->id_kamar,
            'tgl_check_in' => $request->tgl_check_in,
            'jumlah_tamu' => $request->jumlah_tamu,
            'booking_fee' => removeComa($request->booking_fee),
            'id_tamu' => $tamu
        ]);

        return redirect('/admin/check_in')->with('message', 'data terimpan');
    }
    // CRUD INVENTARIS

    public function getInventarisKamar($idKamar)
    {
        return Inventaris::where('id_kamar', $idKamar)->get();
    }

    public function createInventaris(Request $request)
    {

        Inventaris::create([
            'id_kamar' => $request->id_kamar,
            'nama_inventaris' => $request->nama_inventaris,
        ]);

        $inventaris = Inventaris::latest()->first();

        return response()->json($inventaris);
    }

    public function updateInventaris(Request $request)
    {

        $inventaris = Inventaris::where('id_inventaris', $request->id_inventaris)->update([
            'id_kamar' => $request->id_kamar,
            'nama_inventaris' => $request->nama_inventaris,
        ]);

        return response()->json($inventaris);
    }

    public function deleteInventaris(Request $request)
    {
        $inventaris = Inventaris::where('id_inventaris', $request->id_inventaris)->delete();
        return 1;
    }


    // CRUD MENU
    public function tambahMenu(Request $request)
    {

        $image = $request->file('gambar');
        $imageName = uniqid() . '.' . '.jpg';
        $image->move(public_path('data/gambar_menu/'), $imageName);

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'id_kategori' => $request->id_kategori,
            'gambar' => $imageName,
        ]);
        return redirect()->back()->with('message', 'menu Berhasil di tambahkan');
    }

    public function ubahMenu(Request $request)
    {

        $image = $request->file('gambar');

        if ($image) {
            $imageName = uniqid() . '.' . '.jpg';
            $image->move(public_path('data/gambar_menu/'), $imageName);
            Menu::where('id_menu', $request->id_menu)->update([
                'nama_menu' => $request->nama_menu,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'id_kategori' => $request->id_kategori,
                'gambar' => $imageName,
            ]);
        } else {
            Menu::where('id_menu', $request->id_menu)->update([
                'nama_menu' => $request->nama_menu,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'id_kategori' => $request->id_kategori,
            ]);
        }

        return redirect()->back()->with('message', 'menu Berhasil di tambahkan');
    }

    public function hapusMenu($idMenu)
    {
        Menu::where([
            ['id_menu', '=', $idMenu]
        ])->delete();

        return redirect()->back()->with('message', 'menu Berhasil di hapus');
    }

    // CRUD KATEGORI
    public function tambahKategori(Request $request)
    {

        $image = $request->file('gambar');
        $imageName = uniqid() . '.' . '.jpg';
        $image->move(public_path('data/gambar_kategori/'), $imageName);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'gambar' => $imageName,
        ]);
        return redirect()->back()->with('message', 'kategori Berhasil di tambahkan');
    }

    public function ubahKategori(Request $request)
    {

        $image = $request->file('gambar');

        if ($image) {
            $imageName = uniqid() . '.' . '.jpg';
            $image->move(public_path('data/gambar_kategori/'), $imageName);
            Kategori::where('id_kategori', $request->id_kategori)->update([
                'nama_kategori' => $request->nama_kategori,
                'gambar' => $imageName,
            ]);
        } else {
            Kategori::where('id_kategori', $request->id_kategori)->update([
                'nama_kategori' => $request->nama_kategori,
            ]);
        }

        return redirect()->back()->with('message', 'kategori Berhasil di tambahkan');
    }

    public function hapusKategori($idKategori)
    {
        Kategori::where([
            ['id_kategori', '=', $idKategori]
        ])->delete();

        return redirect()->back()->with('message', 'kategori Berhasil di hapus');
    }

    // CRUD KULINER
    public function tambahKuliner(Request $request)
    {

        $image = $request->file('gambar_kuliner');
        $imageName = uniqid() . '.' . '.jpg';
        $image->move(public_path('data/gambar_kuliner/'), $imageName);

        Kuliner::create([
            'nama_kuliner' => $request->nama_kuliner,
            // 'harga' => $request->harga,
            'alamat' => $request->alamat,
            'link_website' => $request->link_website,
            'deskripsi_kuliner' => $request->deskripsi_kuliner,
            'gambar_kuliner' => $imageName,
        ]);
        return redirect()->back()->with('message', 'berita Berhasil di tambahkan');
    }

    public function ubahKuliner(Request $request)
    {

        $image = $request->file('gambar_kuliner');

        if ($image) {
            $imageName = uniqid() . '.' . '.jpg';
            $image->move(public_path('data/gambar_kuliner/'), $imageName);
            Kuliner::where('id_kuliner', $request->id)->update([
                'nama_kuliner' => $request->nama_kuliner,
                // 'harga' => $request->harga,
                'link_website' => $request->link_website,
                'alamat' => $request->alamat,
                'deskripsi_kuliner' => $request->deskripsi_kuliner,
                'gambar_kuliner' => $imageName,
            ]);
        } else {
            Kuliner::where('id_kuliner', $request->id)->update([
                'nama_kuliner' => $request->nama_kuliner,
                // 'harga' => $request->harga,
                'alamat' => $request->alamat,
                'link_website' => $request->link_website,
                'deskripsi_kuliner' => $request->deskripsi_kuliner,
            ]);
        }

        return redirect()->back()->with('message', 'berita Berhasil di tambahkan');
    }

    public function hapusKuliner(Request $request)
    {
        Kuliner::where([
            ['id_kuliner', '=', $request->id_kuliner]
        ])->delete();

        return 1;
    }

    // CRUD BERITA
    public function tambahBerita(Request $request)
    {

        $image = $request->file('gambar_berita');
        $imageName = uniqid() . '.' . '.jpg';
        $image->move(public_path('data/gambar_berita/'), $imageName);

        Berita::create([
            'judul_berita' => $request->judul_berita,
            'tgl_berita' => $request->tgl_berita,
            'isi_berita' => $request->isi_berita,
            'gambar_berita' => $imageName,
        ]);
        return redirect()->back()->with('message', 'berita Berhasil di tambahkan');
    }

    public function ubahBerita(Request $request)
    {

        $image = $request->file('gambar_berita');

        if ($image) {
            $imageName = uniqid() . '.' . '.jpg';
            $image->move(public_path('data/gambar_berita/'), $imageName);
            Berita::where('id_berita', $request->id)->update([
                'judul_berita' => $request->judul_berita,
                'tgl_berita' => $request->tgl_berita,
                'isi_berita' => $request->isi_berita,
                'gambar_berita' => $imageName,
            ]);
        } else {
            Berita::where('id_berita', $request->id)->update([
                'judul_berita' => $request->judul_berita,
                'tgl_berita' => $request->tgl_berita,
                'isi_berita' => $request->isi_berita,
            ]);
        }


        return redirect()->back()->with('message', 'berita Berhasil di tambahkan');
    }


    // CRUD KAMAR
    public function tambahKamar(Request $request)
    {


        Kamar::create([
            'nama_kamar' => $request->nama_kamar,
            'harga_kamar' => $request->harga_kamar,
        ]);
        return redirect()->back()->with('message', 'kamar Berhasil di tambahkan');
    }

    public function ubahKamar(Request $request)
    {


        Kamar::where('id_kamar', $request->id)->update([
            'nama_kamar' => $request->nama_kamar,
            'harga_kamar' => $request->harga_kamar,
            'status' => $request->status
        ]);


        return redirect()->back()->with('message', 'penginapan Berhasil di tambahkan');
    }

    public function hapusKamar(Request $request)
    {
        Kamar::where([
            ['id_kamar', '=', $request->id_kamar]
        ])->delete();

        return 1;
    }


    // CRUD PENGINAPAN
    public function tambahPenginapan(Request $request)
    {

        $image = $request->file('gambar_penginapan');
        $imageName = uniqid() . '.' . '.jpg';
        $image->move(public_path('data/gambar_penginapan/'), $imageName);

        Penginapan::create([
            'nama_penginapan' => $request->nama_penginapan,
            'harga_tiket' => $request->harga_tiket,
            'link_pemetaan' => $request->link_pemetaan,
            'ket_pemetaan' => $request->ket_pemetaan,
            'deskripsi_penginapan' => $request->deskripsi_penginapan,
            'gambar_penginapan' => $imageName,
        ]);
        return redirect()->back()->with('message', 'penginapan Berhasil di tambahkan');
    }

    public function ubahPenginapan(Request $request)
    {

        $image = $request->file('gambar_penginapan');

        if ($image) {
            $imageName = uniqid() . '.' . '.jpg';
            $image->move(public_path('data/gambar_penginapan/'), $imageName);
            Penginapan::where('id_penginapan', $request->id)->update([
                'nama_penginapan' => $request->nama_penginapan,
                'harga_tiket' => $request->harga_tiket,
                'link_pemetaan' => $request->link_pemetaan,
                'ket_pemetaan' => $request->ket_pemetaan,
                'deskripsi_penginapan' => $request->deskripsi_penginapan,
                'gambar_penginapan' => $imageName,
            ]);
        } else {
            Penginapan::where('id_penginapan', $request->id)->update([
                'nama_penginapan' => $request->nama_penginapan,
                'harga_tiket' => $request->harga_tiket,
                'link_pemetaan' => $request->link_pemetaan,
                'ket_pemetaan' => $request->ket_pemetaan,
                'deskripsi_penginapan' => $request->deskripsi_penginapan,
            ]);
        }


        return redirect()->back()->with('message', 'penginapan Berhasil di tambahkan');
    }

    public function hapusPenginapan(Request $request)
    {
        Destination::where([
            ['id_penginapan', '=', $request->id_penginapan]
        ])->delete();

        return 1;
    }

    // CRUD DESTINATION
    public function tambahDestination(Request $request)
    {

        $image = $request->file('gambar_destination');
        $imageName = uniqid() . '.' . '.jpg';
        $image->move(public_path('data/gambar_destination/'), $imageName);

        Destination::create([
            'nama_destination' => $request->nama_destination,
            'harga_tiket' => $request->harga_tiket,
            'link_pemetaan' => $request->link_pemetaan,
            'ket_pemetaan' => $request->ket_pemetaan,
            'deskripsi_destination' => $request->deskripsi_destination,
            'gambar_destination' => $imageName,
        ]);
        return redirect()->back()->with('message', 'Destinasi Berhasil di tambahkan');
    }

    public function ubahDestination(Request $request)
    {


        $image = $request->file('gambar_destination');
        if ($image) {
            $imageName = uniqid() . '.' . '.jpg';
            $image->move(public_path('data/gambar_destination/'), $imageName);
            Destination::where('id_destination', $request->id)->update([
                'nama_destination' => $request->nama_destination,
                'harga_tiket' => $request->harga_tiket,
                'link_pemetaan' => $request->link_pemetaan,
                'ket_pemetaan' => $request->ket_pemetaan,
                'deskripsi_destination' => $request->deskripsi_destination,
                'gambar_destination' => $imageName,
            ]);
        } else {
            Destination::where('id_destination', $request->id)->update([
                'nama_destination' => $request->nama_destination,
                'harga_tiket' => $request->harga_tiket,
                'link_pemetaan' => $request->link_pemetaan,
                'ket_pemetaan' => $request->ket_pemetaan,
                'deskripsi_destination' => $request->deskripsi_destination,
            ]);
        }
        return redirect()->back()->with('message', 'Destinasi Berhasil di tambahkan');
    }

    public function hapusDestination(Request $request)
    {
        Destination::where([
            ['id_destination', '=', $request->id_destination]
        ])->delete();

        return 1;
    }


    // CRUD PENGGUNA

    public function createPengguna(Request $request)
    {
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'wa' => $request->wa,
            'password' => bcrypt($request->email),
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di tambahkan');
    }

    public function updatePengguna(Request $request)
    {
        $user = User::where([
            ['id', '=', $request->id]
        ])->first();
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'wa' => $request->wa,
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di update');
    }

    public function deletePengguna(Request $request)
    {
        User::destroy($request->post('user_id'));
        return 1;
    }

    // CRUD PEMBELIAN

    public function pembelian()
    {
        $data['satuan'] = Satuan::all();
        $data['pembelian'] = Barang::paginate(10);
        return view('pages.pembelian.index', $data);
    }

    public function createPembelian(Request $request)
    {
        $box = $request->all();
        $formData =  [];
        parse_str($box['formData'], $formData);
        $barang = Barang::where('kode_barang', $formData['kode_barang']);
        if (!$barang->first()) {
            Barang::create([
                'kode_barang' => $formData['kode_barang'],
                'kode_satuan' => $formData['satuan'],
                'tgl_masuk' => $formData['tgl_masuk'],
                'nama_barang' => $formData['nama_barang'],
                'barcode' => $formData['barcode'],
                'harga_beli' => $formData['harga_beli'],
                'harga_jual' => $formData['harga_jual'],
                'stok' => $formData['stok'],
            ]);
            return 1;
        } else {
            $barang->update([
                'kode_barang' => $formData['kode_barang'],
                'kode_satuan' => $formData['satuan'],
                'tgl_masuk' => $formData['tgl_masuk'],
                'nama_barang' => $formData['nama_barang'],
                'barcode' => $formData['barcode'],
                'harga_beli' => $formData['harga_beli'],
                'harga_jual' => $formData['harga_jual'],
                'stok' => $formData['stok'],
            ]);
            return 2;
        }
    }

    public function updatePembelian(Request $request)
    {
        $user = Satuan::where([
            ['kode_satuan', '=', $request->id]
        ])->update([
            'kode_satuan' => $request->kode_satuan,
            'nama_satuan' => $request->nama_satuan,
        ]);
        return redirect()->back()->with('message', 'pelanggan Berhasil di update');
    }

    public function deletePembelian(Request $request)
    {
        Barang::where([
            ['kode_barang', '=', $request->kode_barang]
        ])->delete();
        return 1;
    }


    // CRUD SATUAN

    public function satuan()
    {
        $data['satuan'] = Satuan::all();
        return view('pages.satuan.index', $data);
    }

    public function createSatuan(Request $request)
    {
        Satuan::create([
            'kode_satuan' => $request->kode_satuan,
            'nama_satuan' => $request->nama_satuan,
        ]);
        return redirect()->back()->with('message', 'pelanggan Berhasil di tambahkan');
    }

    public function updateSatuan(Request $request)
    {
        $user = Satuan::where([
            ['kode_satuan', '=', $request->id]
        ])->update([
            'kode_satuan' => $request->kode_satuan,
            'nama_satuan' => $request->nama_satuan,
        ]);
        return redirect()->back()->with('message', 'pelanggan Berhasil di update');
    }

    public function deleteSatuan(Request $request)
    {
        Satuan::where([
            ['kode_satuan', '=', $request->kode_satuan]
        ])->delete();
        return 1;
    }
}
