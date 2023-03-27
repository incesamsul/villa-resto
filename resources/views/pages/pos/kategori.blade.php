<div class="row mt-4">
    <div class="col-sm-12 d-flex justify-content-between align-items-end">
        <h4>Semua Menu {!! $nama_kategori
            ? $nama_kategori . '<a data-nama_kategori="all" href="../" class="ml-4 btn-kategori badge badge-secondary">all</a>'
            : '' !!}</h4>
        <p class="text-second">{{ count($menu) }} Menu tersedia</p>
    </div>
</div>
@if (count($menu) < 1)
    <div class="row mt-5">
        <div class="col-sm-12 flex-column d-flex justiy-content-center align-items-center">
            <img src="{{ asset('img/svg/ilustration/food.svg') }}" alt="empty ilustration" width="300">
            <p>Menu kosong</p>
        </div>
    </div>
@endif
<div class="row mt-4" id="menu-wrapper">
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
                <button data-path="{{ asset('data/gambar_menu/') }}" data-pesanan='@json($row)'
                    class="mt-4 second-radius btn bg-main text-white btn-pesan">Pesan</button>
            </div>
        </div>
    @endforeach
</div>
