@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between">
                            <h4>Kategori</h4>
                            <div class="search-element">
                                <input class="form-control main-radius border-0" type="search" placeholder="Search"
                                    aria-label="Search" data-width="250">
                                <i class="text-secondary fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 d-flex flex-row flex-nowrap overflow-auto list-kategori">
                        @foreach ($kategori as $row)
                            <div class="col-sm-2">
                                <a class="text-dark"
                                    href="{{ URL::to('/admin/pos/kategori/' . spaceToLine($row->nama_kategori)) }}">
                                    <div
                                        class="card {{ $nama_kategori == $row->nama_kategori ? 'active' : '' }} kategori p-3 d-flex align-items-center">
                                        <img src="{{ asset('data/gambar_kategori/' . $row->gambar) }}" alt="gambar kategori"
                                            width="40">
                                        <small>{{ $row->nama_kategori }} </small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12 d-flex justify-content-between align-items-end">
                            <h4>Semua Menu {!! $nama_kategori ? $nama_kategori . '<a href="../" class="ml-4 badge badge-secondary">all</a>' : '' !!}</h4>
                            <p class="text-second">12 Menu tersedia</p>
                        </div>
                    </div>
                    @if (count($menu) < 1)
                        <div class="row mt-5">
                            <div class="col-sm-12 flex-column d-flex justiy-content-center align-items-center">
                                <img src="{{ asset('img/svg/ilustration/food.svg') }}" alt="empty ilustration"
                                    width="300">
                                <p>Menu kosong</p>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-4">
                        @foreach ($menu as $row)
                            <div class="col-sm-6">
                                <div class="card p-3">
                                    <div class="menu-wrapper d-flex ">
                                        <div class="img-wrapper main-radius">
                                            <img src="{{ asset('data/gambar_menu/' . $row->gambar) }} "alt="gambar menu">
                                        </div>
                                        <div class="detail-wrapper ml-4">
                                            <h5>{{ $row->nama_menu }}</h5>
                                            <small class="text-second">{{ $row->deskripsi }}</small>
                                            <h6 class="mt-2">Rp. {{ number_format($row->harga) }}</h6>
                                        </div>
                                    </div>
                                    <button class="mt-4 second-radius btn bg-main text-white">Pesan</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" id="tagihan">
                        <div class="card-body">
                            <h5 class="my-4">Tagihan</h5>
                            @for ($i = 0; $i < 4; $i++)
                                <div class="tagihan-menu-wrapper d-flex  mt-2">
                                    <div class="img-wrapper main-radius">
                                        <img src="https://thumbs.dreamstime.com/b/glass-bottle-orange-juice-mint-half-fresh-lemon-grey-background-drink-143036824.jpg"
                                            alt="">
                                    </div>
                                    <div class="detail-wrapper ml-4 mt-1">
                                        <h6>Jus Jeruk</h6>
                                        <div class="tagihan d-flex justify-content-between">
                                            <p>x <strong>1</strong></p>
                                            <strong class="text-second">Rp. 18.000</strong>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                            <div class="d-flex justify-content-between mt-4">
                                <strong>Subtotal</strong>
                                <strong>Rp. 18.000</strong>
                            </div>

                            <div class="d-flex justify-content-between mt-2 text-second">
                                <strong>Tax (10%)</strong>
                                <strong>Rp. 18.000</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mt-2">
                                <strong>Total</strong>
                                <strong>Rp. 18.000</strong>
                            </div>
                            <button class="full-width mt-4 second-radius btn bg-main text-white">Print Tagihan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('#liPos').addClass('active');
        $(document).ready(function() {
            let tagihanOffset = $('#tagihan').offset().top;

            $('#tagihan').wrap('<div class="nav-placeholder"></div>');
            $('.nav-placeholder').height($('#tagihan').outerHeight());

            $(window).scroll(function() {
                let scrollTop = $(window).scrollTop();
                if (scrollTop >= (tagihanOffset + 0)) {
                    $('#tagihan').addClass('fixed-element');
                } else {
                    $('#tagihan').removeClass('fixed-element');
                }
            })
        })
    </script>
@endsection
