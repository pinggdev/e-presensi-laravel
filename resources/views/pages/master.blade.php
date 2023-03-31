@include('pages/includes/header')
    <div id="app">
        @include('pages/includes/sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Dashboard</h3>
                {{-- <h4>Selamat Datang {{Auth::user()->name}}</h4> --}}
            </div>
            <div class="page-content">
                @yield('content')
            </div>

        </div>
    </div>
@include('pages/includes/footer')