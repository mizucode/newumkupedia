<aside class="main-sidebar bg-white shadow-md">

    <a href="#" class="brand-link bg-white">

        <span class="brand-text text-blue-400 font-weight-bold">Dashboard {{ Auth::user()->name }}</span>
    </a>

    <div class="sidebar">


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">LAYANAN</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('favorites.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-book me-2"></i>
                        <p>Buku Favorit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.requestebook.form') }}" class="nav-link">
                        <i class="nav-icon fas fa-book me-2"></i>
                        <p>Permintaan E-book</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('daftarpermintaanebook') }}" class="nav-link">
                        <i class="nav-icon fas fa-book me-2"></i>
                        <p>Daftar Permintaan Saya</p>
                    </a>
                </li>


                <li class="nav-item mb-5">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
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
