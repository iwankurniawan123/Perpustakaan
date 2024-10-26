@auth
    @php
      $user = auth()->user();
    @endphp
@endauth

<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{ route('admin.dashboard') }}" class="logo">
          <img
            src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          @if($user->role ===  \App\Models\User::ROLE_ADMIN)
          <li class="nav-item active">
            <a href=" {{ route('admin.dashboard') }}">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Components</h4>
          </li>
          <li class="nav-item">
            <a href="{{ route('categories.index') }}">
              <i class="fas fa-layer-group"></i>
              <p>Master</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('books.index') }}">
              <i class="fas fa-solid fa-book"></i>
              <p>Buku</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pinjam') }}">
              <i class="fas fa-solid fa-list"></i>
              <p>Peminjaman</p>
            </a>
          </li>
          @elseif($user->role === \App\Models\User::ROLE_MAHASISWA)
          <li class="nav-item active">
            <a href=" {{ route('mahasiswa.dashboard') }}">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Components</h4>
          </li>
          <li class="nav-item">
            <a href="{{ route('pinjam.index') }}">
              <i class="fas fa-solid fa-book"></i>
              <p>Pinjam Buku</p>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->