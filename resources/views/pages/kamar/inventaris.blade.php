@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Inventaris kamar</h3>
                    </div>
                </div>
            </div>
        </div>
        @if (count($kamar) < 1)
            <div class="col-sm-12">
                <div class="card p-5 d-flex align-items-center">
                    <img src="{{ asset('img/svg/ilustration/contact.svg') }}" alt="food" width="300">
                    <p class="mt-4">Tidak ada data kamar</p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="accordion" id="accordionExample">
                    @foreach ($kamar as $row)
                        <div class="card">
                            <div class="card-header" id="heading{{ $loop->iteration }}">
                                <p><strong>{{ $row->nama_kamar }}</strong></p>
                                <h2 class="mb-0">
                                    <button data-id_kamar="{{ $row->id_kamar }}"
                                        class="btn-lihat-inventaris btn btn-link btn-block text-left collapsed"
                                        type="button" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}"
                                        aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                        inventaris
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse{{ $loop->iteration }}" class="collapse"
                                aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="d-flex flex-row ">
                                        <h6 class="mt-2">Data inventaris</h6>
                                        <button data-inventaris='@json($row)' type="button"
                                            class="btn-add-inventaris ml-3 btn btn-primary main-radius" data-toggle="modal"
                                            data-target="#inventaris">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <p># Nama Inventaris</p>
                                    <ol class="list-inventaris-{{ $row->id_kamar }}">
                                    </ol>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="inventaris" tabindex="-1" aria-labelledby="inventarisLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inventarisLabel">Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-inventaris" action="{{ URL::to('/admin/create_inventaris') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_inventaris">Nama Inventaris</label>
                            <input type="hidden" name="id_kamar" id="id_kamar">
                            <input type="hidden" name="id_inventaris" id="id_inventaris">
                            <input type="text" class="form-control" name="nama_inventaris" id="nama_inventaris">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-main text-white">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.btn-lihat-inventaris').on('click', function() {
            let idKamar = $(this).data('id_kamar');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/get_inventaris_kamar/' + idKamar,
                dataType: 'json',
                beforeSend: function() {
                    $('.list-inventaris-' + idKamar).html(
                        '<i class="text-lg text-second fas fa-circle-notch fa-spin"></i> ');
                },
                success: function(response) {
                    console.log(response)
                    if (response) {
                        let listHTHML = '';
                        for (i in response) {
                            listHTHML += '<li class="row-' + response[i].id_inventaris + '">' +
                                response[i]
                                .nama_inventaris + '</li>';
                            listHTHML +=
                                '<a data-inventaris="' + response[i].nama_inventaris +
                                '" data-id_kamar="' + response[i].id_kamar +
                                '" data-id_inventaris="' + response[i].id_inventaris +
                                '" data-nama_inventaris="' + response[i].nama_inventaris +
                                '" class="cursor-pointer text-white badge badge-info btn-edit-inventaris" data-toggle="modal" data-target="#inventaris">edit</a> ';
                            listHTHML +=
                                '<a data-id_inventaris="' + response[i].id_inventaris +
                                '" class="btn-hapus-inventaris cursor-pointer text-white badge badge-danger"  onclick="return confirm(\'Are you sure you want to delete this record?\')">hapus</a>';
                        }
                        $('.list-inventaris-' + idKamar).html(listHTHML);
                        // $('.btn-edit-inventaris').attr("data-inventaris", JSON
                        //     .stringify(response[i]));
                    }
                },
                error: function(err) {
                    console.log(err)
                }
            });
        })

        $('.btn-add-inventaris').on('click', function() {
            let inventaris = $(this).data('inventaris');
            let idKamar = inventaris.id_kamar;
            $('#id_kamar').val(idKamar);
            $('#form-inventaris').attr('action', '/admin/create_inventaris')
        })


        $(document).on('click', '.btn-edit-inventaris', function() {
            let idInventaris = $(this).data('id_inventaris');
            let namaInventaris = $(this).data('nama_inventaris');
            let idKamar = $(this).data('id_kamar');
            console.log(namaInventaris)
            $('#id_kamar').val(idKamar);
            $('#nama_inventaris').val(namaInventaris);
            $('#id_inventaris').val(idInventaris);
            $('#form-inventaris').attr('action', '/admin/update_inventaris')
        })

        $(document).on('click', '.btn-hapus-inventaris', function() {
            let idInventaris = $(this).data('id_inventaris');
            let parentEl = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/delete_inventaris',
                method: 'post',
                dataType: 'json',
                data: {
                    id_inventaris: idInventaris
                }, // serialize form data
                success: function(response) {
                    console.log(response)
                    if (response == 1) {
                        parentEl.prev().prev().remove();
                        parentEl.prev().remove();
                        parentEl.remove();
                    }
                },
                error: function(err) {
                    console.log(err)
                }
            });
        })

        $(document).on('submit', '#form-inventaris', function(e) {
            e.preventDefault(); // prevent default form submission

            let action = $(this).attr('action');
            let formDataArray = $(this).serializeArray();
            let formDataObj = $(this).serialize();
            let formData = {};
            $.each(formDataArray, function(index, field) {
                formData[field.name] = field.value;
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action,
                method: 'post',
                dataType: 'json',
                data: formDataObj, // serialize form data
                success: function(response) {
                    console.log(response)
                    if (response) {

                        // console.log(response);
                        Swal.fire('Berhasil', 'Inventory berhasil di tambahkan',
                            'success').then((result) => {
                            // Clear form fields
                            $("#nama_inventaris").val("");

                            listHTML = "<li class='row-" + response.id_inventaris + "'>" +
                                response.nama_inventaris + "</li> ";
                            listHTML += '<a data-inventaris="' + response.nama_inventaris +
                                '" data-id_kamar="' + response.id_kamar +
                                '" data-id_inventaris="' + response.id_inventaris +
                                '" data-nama_inventaris="' + response.nama_inventaris +
                                '" class="cursor-pointer text-white badge badge-info btn-edit-inventaris" data-toggle="modal" data-target="#inventaris">edit</a> ';
                            listHTML +=
                                '<a  data-id_inventaris="' + response.id_inventaris +
                                '" class="btn-hapus-inventaris cursor-pointer text-white badge badge-danger"  onclick="return confirm(\'Are you sure you want to delete this record?\')">hapus</a>';

                            // Add new data to table
                            $(".list-inventaris-" + response.id_kamar).append(
                                listHTML
                            );

                            if (action == '/admin/update_inventaris') {
                                $('.row-' + formData.id_inventaris).html(formData
                                    .nama_inventaris);
                            }
                        });

                    }
                },
                error: function(err) {
                    console.log(err)
                }
            });
        });

        $('#liInventaris').addClass('active');
    </script>
@endsection
