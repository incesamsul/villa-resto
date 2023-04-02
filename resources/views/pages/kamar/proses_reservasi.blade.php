@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Reservasi {{ $kamar ? $kamar->nama_kamar : '' }}</h4>
                        <a href="{{ URL::to('/admin/check_in/' . $id_kamar) }}" class="btn btn-info">Check in <i
                                class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-5">
                    <form action="{{ URL::to('/admin/create_reservasi') }}" method="POST">
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
                            <label for="booking_fee">Booking fee</label>
                            <input required type="text" class="form-control number_format" name="booking_fee"
                                id="booking_fee">
                        </div>
                        <div class="form-group">
                            <label for="tgl_check_in">Tgl Check In</label>
                            <input required type="date" class="form-control " name="tgl_check_in" id="tgl_check_in">
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
@endsection
