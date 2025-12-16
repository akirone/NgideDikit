<nav id="navmenu" class="navmenu">
    <ul>
        @if (Request::is('/') || Request::is('welcome'))
            <li class="nav-item">
                <a href="#home" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="#tentang" class="nav-link">Tentang</a>
            </li>
            <li class="nav-item">
                <a href="#contact" class="nav-link">Hubungi Saya</a>
            </li>
        @endif

        @guest
            <li class="nav-item">
                <a href="/login" class="nav-link">Login</a>
            </li>
        @endguest

        @auth
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center nav-profile-link" href="#" id="navbarUserDropdown1"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('admin/img/profile.jpg') }}" alt="user-img" width="36" class="rounded-circle">
                    <span class="ms-2">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-user dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                    <li>
                        <div class="px-3 py-2">
                            <div class="user-box d-flex align-items-center">
                                <div class="u-img me-3">
                                    <img src="{{ asset('admin/img/profile.jpg') }}" alt="user" class="rounded-circle"
                                        style="width:48px; height:48px;">
                                </div>
                                <div class="u-text">
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <p class="text-muted mb-0 small">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('do-logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        @endauth

    </ul>

    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

</nav>

<style>
    .nav-profile-link {
        transition: none;
        background-color: transparent;
        color: inherit;
    }

    .nav-profile-link:hover {
        background-color: transparent !important;
        color: inherit !important;
        text-decoration: none !important;
        transform: none !important;
    }

    .nav-profile-link:focus {
        background-color: transparent !important;
        outline: none !important;
    }
</style>
