@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kamar tersedia</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (count($kamar) < 1)
                <div class="col-sm-12">
                    <div class="card p-5 d-flex align-items-center">
                        <img src="{{ asset('img/svg/ilustration/contact.svg') }}" alt="food" width="300">
                        <p class="mt-4">No room available at this moment</p>
                    </div>
                </div>
            @endif
            @foreach ($kamar as $row)
                <div class="col-lg-3">
                    <a href="{{ URL::to('/admin/check_in/' . $row->id_kamar) }}">
                        <div class="card my-card pt-5 pb-3 text-center">
                            <i class="text-dark fa-regular fa-building  room-icon"></i>
                            <h5 class="text-dark mt-4">{{ $row->nama_kamar }}</h5>
                            <p class="text-secondary">Rp. {{ number_format($row->harga_kamar) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('#liCheckIn').addClass('active');
    </script>
@endsection
