<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\CheckIn;
use App\Models\Destination;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Kuliner;
use App\Models\Menu;
use App\Models\Penginapan;
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


    public function destination()
    {
        $data['destination'] = Destination::all();
        return view('pages.destination.index', $data);
    }

    public function berita()
    {
        $data['berita'] = Berita::all();
        return view('pages.berita.index', $data);
    }

    public function penginapan()
    {
        $data['penginapan'] = Penginapan::all();
        return view('pages.penginapan.index', $data);
    }


    public function kamar()
    {
        $data['kamar'] = Kamar::all();
        return view('pages.kamar.index', $data);
    }

    public function checkIn($idKamar = null)
    {
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

    public function profileUser()
    {
        $data['user'] = User::all();
        $data['profile'] = $this->profileUserModel->getProfileUser();
        return view('pages.rekaptulasi_data.index', $data);
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

    // CRUD CEK IN

    public function createCheckIn(Request $request)
    {
        CheckIn::create([
            'id_kamar' => $request->id_kamar,
            'tgl_check_in' => Carbon::now(),
            'jam_check_in' => Carbon::now(),
            'nama_tamu' => $request->nama_tamu
        ]);

        Kamar::where('id_kamar', $request->id_kamar)->update([
            'status' => '0'
        ]);

        return redirect('/admin/check_in')->with('message', 'data terimpan');
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
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di update');
    }

    public function deletePengguna(Request $request)
    {
        User::destroy($request->post('user_id'));
        return 1;
    }
}
