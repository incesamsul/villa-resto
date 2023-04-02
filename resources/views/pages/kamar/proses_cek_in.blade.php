@extends('layouts.v_template')

@section('content')
    <section class="section">

        @php
            $reservasi = cekReservasiKamar($id_kamar, 2);
        @endphp
        @if ($reservasi)
            <div class="row">
                <div class="col-sm-12">
                    <div id="accordion">
                        <div class="card bg-warning">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0 text-white">
                                    Kamar ini telah di reservasi
                                    <button class="btn btn-light" data-toggle="collapse" data-target="#detail"
                                        aria-expanded="false" aria-controls="detail">
                                        Detail
                                    </button>
                                </h5>
                            </div>
                            <div id="detail" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <table style="width: 300px">
                                        <tr>
                                            <td>Nama tamu</td>
                                            <td>:</td>
                                            <td>{{ $reservasi->tamu->nama_tamu }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kamar</td>
                                            <td>:</td>
                                            <td>{{ $reservasi->kamar->nama_kamar }}</td>
                                        </tr>
                                        <tr>
                                            <td>Booking fee</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($reservasi->booking_fee) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sisa pembayaran</td>
                                            <td>:</td>
                                            <td>Rp.
                                                {{ number_format($reservasi->kamar->harga_kamar - $reservasi->booking_fee) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Check In</td>
                                            <td>:</td>
                                            <td>{{ $reservasi->tgl_check_in }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ceckin {{ $kamar ? $kamar->nama_kamar : '' }}</h4>
                        <a href="{{ URL::to('/admin/reservasi/' . $id_kamar) }}" class="btn btn-primary">Reservasi <i
                                class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-5">
                    <form action="{{ URL::to('/admin/create_check_in') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_tamu">Nama Tamu</label>
                            <input type="hidden" name="id_kamar" value="{{ $id_kamar }}">
                            <input required type="text" class="form-control" name="nama_tamu" id="nama_tamu">
                        </div>
                        <div class="form-group">
                            <label for="nomor_identitas">Nomor Identitas <small>(KTP, SIM)</small></label>
                            <input required type="text" class="form-control" name="nomor_identitas" id="nomor_identitas">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_tamu">Jumlah Tamu</label>
                            <input required type="number" class="form-control" name="jumlah_tamu" id="jumlah_tamu">
                        </div>
                        <div class="form-group">
                            <button class="btn bg-main text-white">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('.detail-btn').click(function() {
            $('.detail-info').toggle();
        });
    </script>
@endsection
