<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show {{ request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : '' }}" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none d-flex align-items-center">
        <a href="{{ route('home') }}" class="d-flex align-items-center">
            <img class="c-sidebar-brand-full mb-2 mt-2" src="{{ asset('images/logo toko.png') }}" alt="Site Logo" width="50">
            <img class="c-sidebar-brand-minimized" src="{{ asset('images/logo toko.png') }}" alt="Site Logo" width="25">
        </a>
        <div class="ml-3 text-white text-large sidebar-text"> <!-- Tambahkan div untuk tulisan -->
            {{ settings()->company_name }}
        </div>
    </div>
    <ul class="c-sidebar-nav">
        @include('layouts.menu')
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 692px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 369px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>

<!-- Tambahkan CSS di bawah ini -->
<style>
    .text-large {
        font-size: 1.2rem; /* Ukuran font default */
    }

    .c-sidebar-minimized .sidebar-text {
        display: none; /* Sembunyikan teks saat sidebar diminimalkan */
    }
</style>
