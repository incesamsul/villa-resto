@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex  justify-content-between">
                        <h4>Pembelian</h4>
                        <div class="table-tools d-flex justify-content-around ">
                            <input type="text" class="form-control card-form-header mr-3"
                                placeholder="Cari Data Pengguna ..." id="searchbox">
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" id="addUserBtn"
                                data-target="#modalLayanan"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="card-body ">
                        <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                            <thead>
                                <tr>
                                    <td>Kode barang</td>
                                    <td>Nama barang</td>
                                    <td>barcode</td>
                                    <td>satuan </td>
                                    <td>Stok </td>
                                    <td>Harga beli </td>
                                    <td>Harga jual</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @include('pages.pembelian.data_pembelian')
                            </tbody>
                        </table>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    {{-- MODAL TAMBAH PENGGUNA --}}
    <div class="modal fade" id="modalLayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}


                {{-- MODAL BODY UNTUK TAMBAH USER DAN EDIT USER --}}
                <div class="modal-body" id="main-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- MultiStep Form -->
                    <div class="row justify-content-center mt-0">
                        <div class="col-lg-12 text-center p-0 mt-3 mb-2">
                            <div class="card shadow-none px-0 pt-4 pb-0 mt-3 mb-3">
                                <h2><strong>Tambah data barang</strong></h2>
                                <p>lengkapi data sebelum lanjutkan kehalaman berikutnya</p>
                                <div class="row">
                                    <div class="col-md-12 mx-0">
                                        <form id="msform">
                                            <!-- progressbar -->
                                            <ul id="progressbar" class="d-flex justify-content-center align-items-center">
                                                <li class="active" id="barang"><strong>Barang</strong></li>
                                                <li id="stok"><strong>Stok</strong></li>
                                                <li id="harga"><strong>Harga</strong></li>
                                                <li id="confirm"><strong>Finish</strong></li>
                                            </ul>
                                            <!-- fieldsets -->
                                            <fieldset>
                                                <div class="form-card p-0 shadow-none">
                                                    <h2 class="fs-title">Informasi Barang</h2>
                                                    <div class="form-group">
                                                        <label for="kode_barang">kode_barang</label>
                                                        <input type="text" class="form-control" name="kode_barang"
                                                            id="kode_barang" value="{{ bin2hex(random_bytes(5)) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_barang">nama_barang</label>
                                                        <input type="text" class="form-control" name="nama_barang"
                                                            id="nama_barang">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tgl_masuk">tgl_masuk</label>
                                                        <input type="date" class="form-control" name="tgl_masuk"
                                                            id="tgl_masuk" value="{{ Date('Y-m-d') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="barcode">barcode</label>
                                                        <input type="text" class="form-control" name="barcode"
                                                            id="barcode">
                                                    </div>
                                                </div>
                                                <input type="button" name="next" class="next action-button"
                                                    value="Lanjut" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card shadow-none p-0">
                                                    <h2 class="fs-title">Informasi stok barang</h2>
                                                    <div class="form-group">
                                                        <label for="satuan">satuan</label>
                                                        <select name="satuan" id="satuan" class="form-control select2">
                                                            @foreach ($satuan as $row)
                                                                <option value="{{ $row->kode_satuan }}">
                                                                    {{ $row->nama_satuan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stok">Stok</label>
                                                        <input type="text" class="form-control" name="stok"
                                                            id="stok_barang">
                                                    </div>
                                                </div>
                                                <input type="button" name="previous"
                                                    class="previous action-button-previous" value="kembali" />
                                                <input type="button" name="next" class="next action-button"
                                                    value="Lanjut" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card p-0 shadow-none">
                                                    <h2 class="fs-title">Detail harga</h2>
                                                    <div class="form-group">
                                                        <label for="harga_beli">harga_beli</label>
                                                        <input type="text" class="form-control" name="harga_beli"
                                                            id="harga_beli">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga_jual">harga_jual</label>
                                                        <input type="text" class="form-control" name="harga_jual"
                                                            id="harga_jual">
                                                    </div>
                                                </div>
                                                <input type="button" name="previous"
                                                    class="previous action-button-previous" value="kembali" />
                                                <input type="button" name="make_payment" class="next action-button"
                                                    value="Confirm" id="btn-confirm" />
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card shadow-none p-0">
                                                    <h2 class="fs-title text-center">Success !</h2>
                                                    <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-3">
                                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png"
                                                                class="fit-image">
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="row justify-content-center">
                                                        <div class="col-7 text-center">
                                                            <h5>Data telah berhasil disimpan !</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="modalBtn">Tambah</button>
            </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            function clear_icon() {
                $('#id_icon').html('');
                $('#post_title_icon').html('');
            }

            function fetch_data(page, query) {
                $.ajax({
                    url: "/admin/fetch_data_pembelian?page=" + page + "&query=" + query,
                    success: function(data) {
                        console.log(data)
                        // $('tbody').html('');
                        $('tbody').html(data);
                    },
                    beforeSend: function() {
                        showLoading('tbody', 150, true);
                    },
                    complete: function() {
                        $('.loading').remove();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }

            $(document).on('keyup', '#searchbox', function() {
                var query = $('#searchbox').val();
                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);

                var query = $('#searchbox').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });


            $('#btn-confirm').on('click', function() {
                let formData = $('#msform').serialize();
                console.log(formData);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/admin/create_pembelian',
                    method: 'post'
                        // , dataType: 'json'
                        ,
                    data: {
                        formData: formData
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            Swal.fire('Berhasil', 'Data berhasil di tambah', 'success').then((
                                result) => {
                                location.reload();
                            });
                        } else if (data == 2) {
                            Swal.fire('Berhasil', 'Data berhasil di update', 'success').then((
                                result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            })




            // TOMBOL EDIT USER
            $('.table-user tbody').on('click', 'tr td a.edit', function() {
                let barang = $(this).data('barang');
                console.log(barang.tgl_masuk);
                $('#barang').addClass('active');
                $('#kode_barang').val(barang.kode_barang);
                $('#nama_barang').val(barang.nama_barang);
                $('#barcode').val(barang.barcode);
                $('#tgl_masuk').val(barang.tgl_masuk);
                $('#satuan').val(barang.kode_satuan).change();
                $('#stok_barang').val(barang.stok);
                $('#harga_beli').val(barang.harga_beli);
                $('#harga_jual').val(barang.harga_jual);
                $('#msform').attr('action', '/admin/update_pembelian');
            })

            // TOMBOL TAMBAH USER
            $('#addUserBtn').on('click', function() {
                $('#msform').attr('action', '/admin/create_pembelian');
            });


            // TOMBOL HAPUS USER
            $('.table-user tbody').on('click', 'tr td a.hapus', function() {
                let kodeBarang = $(this).data('kode_barang');
                Swal.fire({
                    title: 'Apakah yakin?',
                    text: "Data tidak bisa kembali lagi!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Konfirmasi'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/admin/delete_pembelian',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                kode_barang: kodeBarang
                            },
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire('Berhasil', 'Data telah terhapus',
                                        'success').then((result) => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                })
            });





        });

        $('#liPembelian').addClass('active');
        $('#liDataBarang').addClass('active');
    </script>
@endsection
