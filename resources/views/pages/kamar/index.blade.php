@extends('layouts.v_template')

@section('content')
    <section class="section">
        @if (auth()->user()->role != 'owner')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex  justify-content-between">
                            <h4>Data Kamar</h4>
                            <div class="table-tools d-flex justify-content-around ">
                                <button type="button" class="btn bg-main text-white float-right" data-toggle="modal"
                                    id="addUserBtn" data-target="#modalkamar"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                                <thead>
                                    <tr>
                                        <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id"
                                            style="cursor: pointer">ID <span id="id_icon"></span></th>
                                        <td>Nama kamar</td>
                                        <td>Harga kamar/malam</td>
                                        <td>Status</td>
                                        {{-- <td>Detail</td> --}}
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kamar as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama_kamar }}</td>
                                            <td>RP. {{ number_format($row->harga_kamar) }}</td>
                                            <td>
                                                @if ($row->status == '0')
                                                    <span class="badge badge-danger">unavailable</span>
                                                @else
                                                    <span class="badge badge-success">available</span>
                                                @endif
                                            </td>
                                            <td class="option">
                                                <div class="btn-group dropleft btn-option">
                                                    <i type="button" class="dropdown-toggle" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </i>
                                                    <div class="dropdown-menu">
                                                        <a data-toggle="modal" data-target="#modalkamar"
                                                            data-edit='@json($row)'
                                                            class="dropdown-item edit" href="#"><i class="fas fa-pen">
                                                                Edit</i></a>
                                                        <a data-id_kamar="{{ $row->id_kamar }}" class="dropdown-item hapus"
                                                            href="#"><i class="fas fa-trash">
                                                                Hapus</i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Daftar kamar</h4>
                        <div class="ket">
                            <span class="badge badge-danger">unavailable</span>
                            <span class="badge badge-success">available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if (count($kamar) < 1)
                <div class="col-sm-12">
                    <div class="card p-5 d-flex align-items-center">
                        <img src="{{ asset('img/svg/ilustration/contact.svg') }}" alt="food" width="300">
                        <p class="mt-4">Semua kamar terisi</p>
                    </div>
                </div>
            @endif
            @foreach ($kamar as $row)
                <div class="col-lg-3">
                    <div class="card my-card pt-5 pb-3 text-center">
                        <i
                            class="{{ $row->status == '0' ? 'text-danger' : 'text-success' }} fa-regular fa-building  room-icon"></i>
                        <h5 class="text-dark mt-4">{{ $row->nama_kamar }}</h5>
                        <p class="text-secondary">Rp. {{ number_format($row->harga_kamar) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- Modal -->
    {{-- MODAL TAMBAH kamar --}}
    <div class="modal fade" id="modalkamar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Tambah kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="main-body">

                    <form id="formkamar" action="{{ URL::to('/admin/tambah_kamar') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kamar">nama kamar</label>
                            <input type="hidden" class="form-control" name="id" id="id">
                            <input type="text" class="form-control" name="nama_kamar" required id="nama_kamar">
                        </div>
                        <div class="form-group">
                            <label for="harga_kamar">harga kamar/malam</label>
                            <input type="text" class="form-control" name="harga_kamar" required id="harga_kamar">
                        </div>
                        <div class="form-group">
                            <label for="status">status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">available</option>
                                <option value="0">unavailable</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-main text-white" id="modalBtn">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {



            $('#btn-tambah').on('click', function() {
                $('#formkamar').attr('action', '/admin/tambah_kamar');
                $('#gambar_kamar').prop('required', true);
            })

            $('.table-user tbody').on('click', 'tr td a.edit', function() {
                let dataEdit = $(this).data('edit');
                console.log(dataEdit);
                $('#id').val(dataEdit.id_kamar);
                $('#nama_kamar').val(dataEdit.nama_kamar);
                $('#harga_kamar').val(dataEdit.harga_kamar);
                $('#status').val(dataEdit.status);
                $('#formkamar').attr('action', '/admin/ubah_kamar');
            });


            // TOMBOL HAPUS USER
            $('.table-user tbody').on('click', 'tr td a.hapus', function() {
                let idkamar = $(this).data('id_kamar');
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
                            url: '/admin/hapus_kamar',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                id_kamar: idkamar
                            },
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire('Berhasil', 'Data telah terhapus',
                                        'success').then((result) => {
                                        location.reload();
                                    });
                                }
                            }
                        })
                    }
                })
            });





        });

        $('#liKamar').addClass('active');
    </script>
@endsection
