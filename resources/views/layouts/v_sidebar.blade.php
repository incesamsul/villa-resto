<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Villa&Resto</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            {{-- MENU PENGGUNA --}}
            {{-- SEMUA PENGGUNA / USER MEMPUNYAI MENU INI --}}
            <li class="menu-header">Pengguna</li>
            <li class="" id="liDashboard"><a class="nav-link" href="{{ URL::to('/dashboard') }}">
                    <i class="fa-regular fa-chart-bar"></i>
                    <span>Dashboard</span></a></li>
            <li class="" id="liProfile"><a class="nav-link" href="{{ URL::to('/profile') }}">
                    <i class="fa-regular fa-user"></i>
                    <span>Profile</span></a></li>
            <li class="" id="liBantuan"><a class="nav-link" href="{{ URL::to('/bantuan') }}">
                    <i class="fa-regular fa-circle-question"></i>
                    <span>Bantuan</span></a></li>



            @if (auth()->user()->role == 'Administrator')
                {{-- MENU ADMIN --}}
                <li class="menu-header">Admin</li>
                <li class="nav-item dropdown " id="liPengguna">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fa-regular fa-circle-user"></i>
                        <span>Pengguna</span></a>
                    <ul class="dropdown-menu">
                        <li id="liManajemenPengguna"><a class="nav-link" href="/admin/pengguna">Manajemen Pengguna</a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="" id="liDestination"><a class="nav-link" href="{{ URL::to('/admin/destination') }}"><i
                            class="fas fa-mountain"></i> <span>Destination</span></a></li> --}}
                {{-- <li class="" id="liBerita"><a class="nav-link" href="{{ URL::to('/admin/berita') }}">
                        <i class="fa-regular fa-newspaper"></i>
                        <span>Berita</span></a></li> --}}
                {{-- <li class="" id="liPenginapan"><a class="nav-link" href="{{ URL::to('/admin/penginapan') }}"><i class="fa-regular fa-building"></i> <span>Penginapan</span></a></li> --}}
                <li class="" id="liKamar">
                    <a class="nav-link" href="{{ URL::to('/admin/kamar') }}">
                        <i class="fa-regular fa-building"></i>
                        <span>Kamar</span>
                    </a>
                </li>
                <li class="" id="liCheckIn"><a class="nav-link" href="{{ URL::to('/admin/check_in') }}"><i
                            class="fa-regular fa-building"></i> <span>Check In</span></a></li>
                <li class="" id="liPos"><a class="nav-link" href="{{ URL::to('/admin/pos') }}">
                        <i class="fa-regular fa-handshake"></i>
                        <span>Pos</span></a></li>
                <li class="" id="liMenu"><a class="nav-link" href="{{ URL::to('/admin/menu') }}">
                        <i class="fas fa-bell-concierge"></i>
                        <span>Menu</span></a></li>

                <li class="" id="liKategori">
                    <a class="nav-link" href="{{ URL::to('/admin/kategori') }}">
                        <i class="fa-regular fa-rectangle-list"></i>
                        <span>Kategori</span>
                    </a>
                </li>


                {{-- END OF MENU ADMIN --}}
            @endif







        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ URL::to('/logout') }}" class="btn bg-main text-white btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
