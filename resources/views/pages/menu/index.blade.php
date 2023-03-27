@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex  justify-content-between">
                        <h4>Data menu</h4>
                        @if ($edit)
                            <a class="btn bg-main text-white" href="{{ URL::to('admin/menu') }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ $edit ? URL::to('/admin/ubah_menu') : URL::to('/admin/tambah_menu') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="id_kategori" id="kategori" class="form-control">
                                    @foreach ($kategori as $row)
                                        <option value="{{ $row->id_kategori }}">{{ $row->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_menu">Nama menu</label>
                                <input type="hidden" value="{{ $edit ? $edit->id_menu : '' }}" name="id_menu">
                                <input value="{{ $edit ? $edit->nama_menu : '' }}" required type="text"
                                    class="form-control" name="nama_menu" id="nama_menu">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input {{ $edit ? '' : 'required' }} type="file" class="form-control" name="gambar"
                                    id="gambar">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input value="{{ $edit ? $edit->deskripsi : '' }}" required type="text"
                                    class="form-control" name="deskripsi" id="deskripsi">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input value="{{ $edit ? $edit->harga : '' }}" required type="text" class="form-control"
                                    name="harga" id="harga">
                            </div>
                            <div class="form-group">
                                <button class="btn bg-main text-white">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 d-flex justify-content-between">
                <h4>menu</h4>
                <div class="search-element">
                    <input class="form-control main-radius border-0" type="search" placeholder="Search" aria-label="Search"
                        data-width="250">
                    <i class="text-secondary fas fa-search"></i>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($menu as $row)
                <div class="col-sm-4">
                    <div class="card p-3">
                        <div class="menu-wrapper d-flex ">
                            <div class="img-wrapper main-radius">
                                <img src="{{ asset('data/gambar_menu/' . $row->gambar) }} " alt="gambar menu">
                            </div>
                            <div class="detail-wrapper ml-4">
                                <h5>{{ $row->nama_menu }}</h5>
                                <small class="text-second">{{ $row->deskripsi }}</small>
                                <h6 class="mt-2">Rp. {{ number_format($row->harga) }}</h6>
                            </div>
                        </div>
                        <a href="{{ URL::to('admin/hapus_menu/' . $row->id_menu) }}" onclick="return confirm('yakin ? ')"
                            class="mt-4 second-radius btn btn-danger text-white">Hapus</a>
                        <a href="{{ URL::to('admin/menu/' . $row->id_menu) }}"
                            class="mt-4 second-radius btn btn-info text-white">edit</a>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {



        });
        $('#limenu').addClass('active');
    </script>
@endsection
