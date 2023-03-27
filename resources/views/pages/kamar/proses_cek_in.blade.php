@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ceckin {{ $kamar ? $kamar->nama_kamar : '' }}</h4>
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
                            <input type="text" class="form-control" name="nama_tamu" id="nama_tamu">
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
