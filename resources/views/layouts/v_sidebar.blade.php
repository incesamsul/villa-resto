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
            <li data-toggle="tooltip" title="Dashboard" data-placement="right" class="" id="liDashboard"><a
                    class="nav-link" href="{{ URL::to('/dashboard') }}">
                    <i class="fa-regular fa-chart-bar"></i>
                    <span>Dashboard</span></a></li>
            <li data-toggle="tooltip" title="Profile" data-placement="right" class="" id="liProfile"><a
                    class="nav-link" href="{{ URL::to('/profile') }}">
                    <i class="fa-regular fa-user"></i>
                    <span>Profile</span></a></li>
            <li data-toggle="tooltip" title="Bantuan" data-placement="right" class="" id="liBantuan"><a
                    class="nav-link" href="{{ URL::to('/bantuan') }}">
                    <i class="fa-regular fa-circle-question"></i>
                    <span>Bantuan</span></a></li>



            @if (auth()->user()->role == 'Administrator')
                {{-- MENU ADMIN --}}
                <li class="menu-header">Admin</li>
                @include('components.sidebar.menu_admin')
                @include('components.sidebar.menu_resepsionis')
                @include('components.sidebar.menu_kasir')
                {{-- END OF MENU ADMIN --}}
            @endif

            @if (auth()->user()->role == 'resepsionis')
                <li class="menu-header">Resepsionis</li>
                @include('components.sidebar.menu_resepsionis')
            @endif

            @if (auth()->user()->role == 'kasir')
                <li class="menu-header">Kasir</li>
                @include('components.sidebar.menu_kasir')
            @endif

            @if (auth()->user()->role == 'owner')
                <li class="menu-header">Owner</li>
                @include('components.sidebar.menu_owner')
            @endif



        </ul>


    </aside>
</div>
