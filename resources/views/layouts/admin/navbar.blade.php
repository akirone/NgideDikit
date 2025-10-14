<div class="logo-header">
    <a href="/" class="logo" style="font-size: 20px;">
        NgideDikit
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
        aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
</div>
<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown">
                @auth
                    <a class="nav-link d-flex align-items-center" href="#" id="navbarUserDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline" >Hai, {{ Auth::user()->name }}</span>
                        <img src="{{ asset('admin/img/profile.jpg') }}" alt="user-img" width="36"
                            class="rounded-circle">
                    </a>

                    <div class="dropdown-menu dropdown-user dropdown-menu-right" aria-labelledby="navbarUserDropdown">
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

                        <div class="dropdown-divider"></div>

                        <form action="{{ route('do-logout') }}" method="POST" class="d-flex m-0">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                @endauth

                @guest
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                @endguest
            </li>
        </ul>
    </div>
</nav>

</div>
