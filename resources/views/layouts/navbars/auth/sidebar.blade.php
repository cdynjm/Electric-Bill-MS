<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
        <img src="{{ asset('assets/electrical-energy.png') }}" class="navbar-brand-img h-100" alt="...">
        <span class="ms-3 font-weight-bold">Electric Bill MS</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active shadow-none' : '') }}" href="{{ url('dashboard') }}">
          <div class="bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-home"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      @if(Auth::user()->role == 1)
      <li class="nav-item py-2">
        <a class="nav-link {{ (Request::is('create-bill') ? 'active shadow-none' : '') }}" href="{{ url('create-bill') }}">
          <div class="bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-file-invoice-dollar text-lg me-1"></i>
          </div>
          <span class="nav-link-text ms-1">Create Bill</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
  
</aside>
