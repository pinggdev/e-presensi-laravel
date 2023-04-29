<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/">E-PRESENSI</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

                @if (Auth::user()->role === "guru" || Auth::user()->role === "kepsek" || Auth::user()->role === "tata_usaha")
                <li class="sidebar-item  ">
                    <a href="{{ route('presences.create') }}" class='sidebar-link'>
                        <i class="bi bi-calendar-date-fill"></i>
                        <span>Absen</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-paperclip"></i>
                        <span>Data Absen</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="/by-name-data">Data Absen Saya</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="/by-month-data">Data Absen Saya per Bulan</a>
                        </li>
                    </ul>
                </li>
                @endif

                
                @if (Auth::user()->role === "admin")

                <li class="sidebar-item">
                    <a href="/data-guru" class='sidebar-link'>
                        <i class="bi bi-paperclip"></i>
                        <span>Data Guru</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Users</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('users.index') }}">Data User</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-calendar-date-fill"></i>
                        <span>Presences</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('presences.index') }}">Data Presence</a>
                        </li>
                    </ul>
                </li>
              
                @endif

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>