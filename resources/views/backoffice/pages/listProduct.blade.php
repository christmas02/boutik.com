@extends('backoffice.layout')

@section('page-title', 'Produits')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">Liste des produits</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Gestion du catalogue produits</p>
                </div>
                <a href="/create/product" class="btn btn-success">
                    <i class="ri-add-line me-1"></i> Ajouter un produit
                </a>
            </div>

            @include('backoffice.status')

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Nom du produit</th>
                                    <th>Code produit</th>
                                    <th>Montant</th>
                                    <th>Catégorie</th>
                                    <th>Type achat</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produits as $produit)
                                <tr>
                                    <td class="text-muted" style="font-size:12px;">{{ $produit['code_product'] }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/'.$produit['picture']) }}"
                                             style="width:42px;height:42px;border-radius:8px;object-fit:cover;">
                                    </td>
                                    <td style="font-weight:500;">{{ $produit['name'] }}</td>
                                    <td><code style="font-size:12px;">{{ $produit['code_product'] }}</code></td>
                                    <td style="font-weight:600;">{{ number_format($produit['amount']) }} CFA</td>
                                    <td>{{ $produit['category'] }}</td>
                                    <td>
                                        <span class="badge" style="background:rgba(59,130,246,.1);color:#3b82f6;font-size:11px;">
                                            {{ $produit['type_achat'] }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($produit['quantity'] <= 5)
                                            <span class="btn btn-soft-danger btn-sm">{{ $produit['quantity'] }} en stock</span>
                                        @else
                                            <span class="btn btn-soft-success btn-sm">{{ $produit['quantity'] }} en stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/detail/product/{{ $produit['code_product'] }}"
                                           class="btn btn-success btn-sm">
                                            <i class="ri-eye-line me-1"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
