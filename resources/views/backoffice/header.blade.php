<header id="boutik-topbar">

    <div class="topbar-left">
        <h6 class="mb-0 fw-semibold" style="font-size:15px; color:#1e293b;">
            @yield('page-title', 'Tableau de bord')
        </h6>
    </div>

    <div class="topbar-right">
        <!-- Recherche -->
        <div class="topbar-search d-none d-md-flex">
            <i class="ri-search-line"></i>
            <input type="text" placeholder="Rechercher...">
        </div>

        <!-- Notifications (placeholder) -->
        <div class="position-relative" style="cursor:pointer; padding:6px;">
            <i class="ri-notification-3-line" style="font-size:20px; color:#64748b;"></i>
        </div>

        <!-- User dropdown -->
        <div class="dropdown">
            <button class="topbar-user-btn dropdown-toggle" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false"
                    style="border:none; background:none; cursor:pointer; display:flex; align-items:center; gap:8px; padding:4px 6px; border-radius:8px;">
                @if(Auth::user()->picture != NULL)
                    <img src="{{ env('IMAGES_PATH') }}/{{ Auth::user()->picture }}" alt="avatar"
                         style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;">
                @else
                    <img src="{{ asset('/admin/assets/images/users/avatar-1.jpg') }}" alt="avatar"
                         style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;">
                @endif
                <div class="text-start d-none d-xl-block">
                    <div style="font-size:13px;font-weight:600;color:#1e293b;line-height:1.3;">{{ auth()->user()->name }}</div>
                    <div style="font-size:11px;color:#94a3b8;">Administrateur</div>
                </div>
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><h6 class="dropdown-header">Bienvenue {{ auth()->user()->name }} !</h6></li>
                <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                        <i class="ri-user-line me-2 text-muted"></i> Mon profil
                    </button>
                </li>
                <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#passwordModalgrid">
                        <i class="ri-lock-line me-2 text-muted"></i> Mot de passe
                    </button>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="/logout">
                        <i class="ri-logout-box-r-line me-2"></i> Se déconnecter
                    </a>
                </li>
            </ul>
        </div>
    </div>

</header>
