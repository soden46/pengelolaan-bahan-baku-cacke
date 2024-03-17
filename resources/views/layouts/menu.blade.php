<!-- need to remove -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('data-barang/index')}}">
        <i class="fas fa-fw fa-clipboard"></i>
        <span>Barang</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('kategori/index')}}">
        <i class="fas fa-fw fa-clipboard"></i>
        <span>Kategori</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('barang-keluar/index')}}">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Barang Keluar</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('barang-masuk/index')}}">
        <i class="fas fa-fw fa-receipt"></i>
        <span>Barang Masuk</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('laporan')}}">
        <i class="fas fa-fw fa-money-bill"></i>
        <span>Laporan</span>
    </a>
</li>

<!-- <li class="nav-item">
    <a class="nav-link" href="{{route('laporan/stok')}}">
        <i class="fas fa fa-file"></i>
        <span>Laporan Stok Barang</span>
    </a>
</li> -->

<li class="nav-item">
    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
    </a>
</li>