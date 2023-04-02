@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kamar terisi</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (count($kamar) < 1)
                <div class="col-sm-12">
                    <div class="card p-5 d-flex align-items-center">
                        <img src="{{ asset('img/svg/ilustration/contact.svg') }}" alt="food" width="300">
                        <p class="mt-4">Semua kamar kosong</p>
                    </div>
                </div>
            @endif
            @foreach ($kamar as $row)
                <div class="col-lg-3">
                    <a onclick="return confirm('yakin ? ')" href="{{ URL::to('/admin/check_out/' . $row->id_kamar) }}">
                        <div class="card my-card pt-5 pb-3 text-center">
                            <i class="text-dark fa-regular fa-building  room-icon"></i>
                            <h5 class="text-dark mt-4">{{ $row->nama_kamar }}</h5>
                            <p class="text-secondary">Rp. {{ number_format($row->harga_kamar) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Tamu check out</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <td>Nama Tamu</td>
                                    <td>Kamar</td>
                                    <td>Tgl check in</td>
                                    <td>Jam check in</td>
                                    <td>tgl check out</td>
                                    <td>jam check out</td>
                                    <td>Lama menginap</td>
                                    <td>Tagihan</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tamu as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->checkIn->tamu->nama_tamu }}</td>
                                        <td>{{ $row->checkIn->kamar->nama_kamar }}</td>
                                        <td>{{ $row->checkIn->tgl_check_in }}</td>
                                        <td>{{ $row->checkIn->jam_check_in }}</td>
                                        <td>{{ $row->tgl_check_out }}</td>
                                        <td>{{ $row->jam_check_out }}</td>
                                        <td>
                                            {{ hitungDurasiMalam($row->checkIn->tgl_check_in, $row->tgl_check_out) }} Hari
                                        </td>
                                        <td>
                                            Rp.
                                            {{ number_format(hitungDurasiMalam($row->checkIn->tgl_check_in, $row->tgl_check_out) * $row->checkIn->kamar->harga_kamar) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('#liCheckOut').addClass('active');
    </script>
@endsection
