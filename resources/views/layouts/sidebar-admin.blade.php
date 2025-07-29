<aside class="main-sidebar bg-white shadow-md">
    <a href="#" class="brand-link bg-white">
        <span class="brand-text text-blue-400 font-weight-bold">Dashboard</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">LAYANAN</li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt me-2"></i>
                        <p>Dashboard Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.books.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book me-2"></i>
                        <p>Bibliografi Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pemanfaat.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book me-2"></i>
                        <p>Pengguna / Pemanfaat</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.daftarpermintaanebook') }}" class="nav-link">
                        <i class="nav-icon fas fa-book me-2"></i>
                        <p>Daftar Permintaan user</p>
                    </a>
                </li>
                <li class="nav-item has-treeview menu-close">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-file me-2"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 1rem;">
                        <li class="nav-item">
                            <a href="{{ route('admin.laporan.buku') }}" class="nav-link ">
                                <i class="fa fa-book nav-icon me-2"></i>
                                <p>Laporan buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.laporan.pengguna') }}" class="nav-link ">
                                <i class="fa fa-users nav-icon me-2"></i>
                                <p>Laporan Pengguna</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item mb-5">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start bg-transparent border-0">
                            <i class="nav-icon fas fa-sign-out-alt me-2"></i>
                            <p>Log Out</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
