<li data-toggle="tooltip" title="Pengguna" data-placement="right" class="" id="liPengguna">
    <a class="nav-link" href="{{ URL::to('/admin/pengguna') }}">
        <i class="fa-regular fa-circle-user"></i>
        <span>Pengguna</span>
    </a>
</li>
<li data-toggle="tooltip" title="Kamar" data-placement="right" class="" id="liKamar">
    <a class="nav-link" href="{{ URL::to('/admin/kamar') }}">
        <i class="fa-regular fa-building"></i>
        <span>Kamar</span>
    </a>
</li>
<li class="" id="liMenu" data-toggle="tooltip" title="Menu" data-placement="right">
    <a class="nav-link" href="{{ URL::to('/admin/menu') }}">
        <i class="fas fa-bell-concierge"></i>
        <span>Menu</span>
    </a>
</li>
<li class="" id="liKategori" data-toggle="tooltip" title="Kategori" data-placement="right">
    <a class="nav-link" href="{{ URL::to('/admin/kategori') }}">
        <i class="fa-regular fa-rectangle-list"></i>
        <span>Kategori</span>
    </a>
</li>


<li class="nav-item dropdown " id="liDataBarang">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fa-regular fa-hard-drive"></i>
        <span>Stok opname</span></a>
    <ul class="dropdown-menu">
        <li id="liPembelian"><a class="nav-link" href="/admin/pembelian">Belanja</a></li>
    </ul>
</li>

<li class="" id="liSatuan" data-toggle="tooltip" title="Satuan" data-placement="right">
    <a class="nav-link" href="{{ URL::to('/admin/satuan') }}">
        <i class="fa-regular fa-hand-spock"></i>
        <span>Satuan</span>
    </a>
</li>

<li class="" id="liInventaris" data-toggle="tooltip" title="Inventaris" data-placement="right">
    <a class="nav-link" href="{{ URL::to('/admin/inventaris') }}">
        <i class="fa-regular fa-rectangle-list"></i>
        <span>Inventaris</span>
    </a>
</li>
