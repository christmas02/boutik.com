@extends('backoffice.layout')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            @include('backoffice.status')

            <!-- En-tête -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px; font-weight:700; color:#1e293b;">
                        Bonjour, {{ auth()->user()->name }} 👋
                    </h4>
                    <p class="text-muted mb-0" style="font-size:13px;">
                        {{ \Carbon\Carbon::now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                    </p>
                </div>
                <a href="/create/product" class="btn btn-success">
                    <i class="ri-add-line me-1"></i> Nouveau produit
                </a>
            </div>

            <!-- Stat Cards -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon teal">
                            <i class="ri-shopping-cart-2-line"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ isset($totalCommandes) ? $totalCommandes : '—' }}</div>
                            <div class="stat-label">Commandes totales</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon orange">
                            <i class="ri-archive-drawer-line"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ isset($totalProduits) ? $totalProduits : '—' }}</div>
                            <div class="stat-label">Produits en stock</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon purple">
                            <i class="ri-group-line"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ isset($totalClients) ? $totalClients : '—' }}</div>
                            <div class="stat-label">Clients</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="ri-bank-card-line"></i>
                        </div>
                        <div>
                            <div class="stat-value">{{ isset($totalRevenu) ? number_format($totalRevenu) : '—' }}</div>
                            <div class="stat-label">Revenus (CFA)</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accès rapide -->
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5>Accès rapide</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="/list/command" class="btn btn-success btn-sm">
                                    <i class="ri-shopping-cart-2-line me-1"></i> Commandes
                                </a>
                                <a href="/list/product" class="btn btn-light btn-sm">
                                    <i class="ri-archive-drawer-line me-1"></i> Produits
                                </a>
                                <a href="/list/client" class="btn btn-light btn-sm">
                                    <i class="ri-group-line me-1"></i> Clients
                                </a>
                                <a href="/list/categorie" class="btn btn-light btn-sm">
                                    <i class="ri-list-check me-1"></i> Catégories
                                </a>
                                <a href="/create/product" class="btn btn-light btn-sm">
                                    <i class="ri-add-box-line me-1"></i> Ajouter produit
                                </a>
                                <a href="/nouveau/administrateur" class="btn btn-light btn-sm">
                                    <i class="ri-user-add-line me-1"></i> Ajouter admin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Derniers produits ajoutés</h5>
                        </div>
                        <div class="card-body p-0">
                            @if(isset($derniersProduits) && count($derniersProduits))
                            <ul class="list-unstyled mb-0">
                                @foreach($derniersProduits as $p)
                                <li class="d-flex align-items-center gap-3 px-4 py-3" style="border-bottom:1px solid #f1f5f9;">
                                    <img src="{{ asset('uploads/'.$p['picture']) }}"
                                         style="width:40px;height:40px;border-radius:8px;object-fit:cover;">
                                    <div class="flex-grow-1">
                                        <div style="font-size:13.5px;font-weight:600;color:#1e293b;">{{ $p['name'] }}</div>
                                        <div style="font-size:12px;color:#94a3b8;">{{ number_format($p['amount']) }} CFA</div>
                                    </div>
                                    <a href="/detail/product/{{ $p['code_product'] }}"
                                       class="btn btn-light btn-sm">Voir</a>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="text-center py-5 text-muted">
                                <i class="ri-archive-drawer-line d-block mb-2" style="font-size:32px;"></i>
                                Aucun produit récent
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">&copy; {{ date('Y') }} Boutik17</div>
                <div class="col-sm-6 text-sm-end d-none d-sm-block">Espace Administration</div>
            </div>
        </div>
    </footer>
</div>
@endsection
