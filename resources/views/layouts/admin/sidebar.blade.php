<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        {{-- <div class="user">
            <div class="photo">
                <img src="admin/img/profile.jpg">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        Hizrian
                        <span class="user-level">Administrator</span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="d-flex border-bottom border-secondary">
        </div>
        <ul class="nav flex-column mt-4 mb-4 px-2 gap-1">
            <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                <a href="/dashboard" class="nav-link d-flex align-items-center rounded-3 px-3 py-3"
                    style="font-size: 20px;">
                    <i class="bi bi-speedometer2 me-3" style="font-size: 20px;"></i>
                    <span class="fw-semibold" style="font-size: 20px;">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('kategori*') ? 'active' : '' }}">
                <a href="/kategori" class="nav-link d-flex align-items-center rounded-3 px-3 py-3"
                    style="font-size: 20px;">
                    <i class="bi bi-tag me-3" style="font-size: 20px;"></i>
                    <span class="fw-semibold" style="font-size: 20px;">Kategori</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('ideas*') ? 'active' : '' }}">
                <a href="/ideas" class="nav-link d-flex align-items-center rounded-3 px-3 py-3"
                    style="font-size: 20px;">
                    <i class="bi bi-lightbulb me-3" style="font-size: 20px;"></i>
                    <span class="fw-semibold" style="font-size: 20px;">Ide</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                <a href="/users" class="nav-link d-flex align-items-center rounded-3 px-3 py-3"
                    style="font-size: 20px;">
                    <i class="bi bi-person me-3" style="font-size: 20px;"></i>
                    <span class="fw-semibold" style="font-size: 20px;">Pengguna</span>
                </a>
            </li>
        </ul>
    </div>
</div>
