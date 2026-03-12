<nav id="boutik-sidebar">

    <!-- LOGO -->
    <div class="sidebar-header">
        <a href="/espace/administrateur" class="sidebar-brand">
            Boutik<em>17</em>
        </a>
    </div>

    <!-- NAVIGATION -->
    <div class="sidebar-body">

        <div class="sidebar-section-label">Principal</div>

        <a href="/espace/administrateur"
           class="sidebar-nav-item {{ request()->is('espace/administrateur') ? 'active' : '' }}">
            <i class="ri-dashboard-line"></i>
            <span>Tableau de bord</span>
        </a>

        <div class="sidebar-section-label">Commandes</div>

        <a href="/list/command"
           class="sidebar-nav-item {{ request()->is('list/command') ? 'active' : '' }}">
            <i class="ri-shopping-cart-2-line"></i>
            <span>Liste des commandes</span>
        </a>

        <a href="/list/client"
           class="sidebar-nav-item {{ request()->is('list/client') ? 'active' : '' }}">
            <i class="ri-group-line"></i>
            <span>Liste des clients</span>
        </a>

        <div class="sidebar-section-label">Gestion du stock</div>

        <a href="/create/product"
           class="sidebar-nav-item {{ request()->is('create/product') ? 'active' : '' }}">
            <i class="ri-add-box-line"></i>
            <span>Ajouter un produit</span>
        </a>

        <a href="/list/product"
           class="sidebar-nav-item {{ request()->is('list/product') ? 'active' : '' }}">
            <i class="ri-archive-drawer-line"></i>
            <span>Produits</span>
        </a>

        <a href="/list/categorie"
           class="sidebar-nav-item {{ request()->is('list/categorie') ? 'active' : '' }}">
            <i class="ri-list-check"></i>
            <span>Catégories</span>
        </a>

        <a href="/list/sous/categorie"
           class="sidebar-nav-item {{ request()->is('list/sous/categorie') ? 'active' : '' }}">
            <i class="ri-list-check-2"></i>
            <span>Sous catégories</span>
        </a>

        <div class="sidebar-section-label">Administrateurs</div>

        <a href="/nouveau/administrateur"
           class="sidebar-nav-item {{ request()->is('nouveau/administrateur') ? 'active' : '' }}">
            <i class="ri-user-add-line"></i>
            <span>Ajouter admin</span>
        </a>

        <a href="/liste/administrateur"
           class="sidebar-nav-item {{ request()->is('liste/administrateur') ? 'active' : '' }}">
            <i class="ri-shield-user-line"></i>
            <span>Administrateurs</span>
        </a>

    </div>

    <!-- FOOTER -->
    <div class="sidebar-footer">
        <a href="/logout" class="sidebar-nav-item">
            <i class="ri-logout-box-r-line"></i>
            <span>Déconnexion</span>
        </a>

        @auth
        <div class="sidebar-user-box">
            @if(Auth::user()->picture != NULL)
                <img src="{{ env('IMAGES_PATH') }}/{{ Auth::user()->picture }}" alt="avatar">
            @else
                <img src="{{ asset('/admin/assets/images/users/avatar-1.jpg') }}" alt="avatar">
            @endif
            <div>
                <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="sidebar-user-role">Administrateur</div>
            </div>
        </div>
        @endauth
    </div>

</nav>
