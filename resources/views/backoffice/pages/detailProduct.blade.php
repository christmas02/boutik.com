@extends('backoffice.layout')

@section('page-title', 'Détail produit')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">{{ $produit['name'] }}</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">
                        Code : <code>{{ $produit['code_product'] }}</code>
                        &bull; Catégorie : {{ $produit['category'] }}
                        &bull; Publié le {{ $produit['date_publication'] }}
                    </p>
                </div>
                <a href="/list/product" class="btn btn-light">
                    <i class="ri-arrow-left-line me-1"></i> Retour
                </a>
            </div>

            @include('backoffice.status')

            <div class="row g-4">

                <!-- Infos produit -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <img src="{{ asset('uploads/'.$produit['picture']) }}"
                                         class="w-100 rounded-3" style="object-fit:cover;max-height:260px;">
                                </div>
                                <div class="col-md-8">
                                    <h5 style="font-size:18px;font-weight:700;">{{ $produit['name'] }}</h5>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge" style="background:rgba(20,184,166,.1);color:#14b8a6;font-size:12px;">
                                            {{ $produit['category'] }}
                                        </span>
                                        @if($produit['archive'] != null)
                                        <span class="badge bg-danger">Archivé</span>
                                        @else
                                        <span class="badge" style="background:rgba(20,184,166,.12);color:#14b8a6;">Actif</span>
                                        @endif
                                    </div>
                                    <table class="table table-sm mb-3" style="font-size:13.5px;">
                                        <tbody>
                                            <tr>
                                                <th style="width:140px;color:#64748b;font-weight:500;">Prix unitaire</th>
                                                <td style="font-weight:700;font-size:16px;">{{ number_format($produit['amount']) }} CFA</td>
                                            </tr>
                                            <tr>
                                                <th style="color:#64748b;font-weight:500;">Quantité en stock</th>
                                                <td>
                                                    @if($produit['quantity'] <= 5)
                                                    <span class="btn btn-soft-danger btn-sm">{{ $produit['quantity'] }} unités</span>
                                                    @else
                                                    <span class="btn btn-soft-success btn-sm">{{ $produit['quantity'] }} unités</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="color:#64748b;font-weight:500;">Ventes réalisées</th>
                                                <td>{{ $produit['nbrvente'] ?? 0 }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="font-size:13.5px;color:#475569;">
                                        {!! $produit['description'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Galerie -->
                    @if(isset($produit['galerie']) && count($produit['galerie']))
                    <div class="card">
                        <div class="card-header">
                            <h5>Galerie d'images</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                @foreach($produit['galerie'] as $items)
                                <div class="col-3">
                                    <img src="{{ asset('uploads/'.$items->image) }}"
                                         class="w-100 rounded-3"
                                         style="height:100px;object-fit:cover;">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Historique -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="ri-history-line me-2 text-muted"></i>Historique du stock</h5>
                        </div>
                        <div class="card-body p-0">
                            @forelse($produit['historic'] as $value)
                            <div class="d-flex align-items-start gap-3 px-4 py-3" style="border-bottom:1px solid #f1f5f9;">
                                <div style="width:36px;height:36px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;
                                     background:{{ $value->operation == 1 ? 'rgba(20,184,166,.12)' : 'rgba(239,68,68,.12)' }};
                                     color:{{ $value->operation == 1 ? '#14b8a6' : '#ef4444' }};">
                                    <i class="ri-shopping-bag-line" style="font-size:15px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div style="font-size:13.5px;font-weight:500;color:#1e293b;">{{ $value->description }}</div>
                                    <div style="font-size:12px;color:#94a3b8;">{{ $value->created_at }}</div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4 text-muted">
                                <i class="ri-history-line d-block mb-1" style="font-size:24px;"></i>
                                Aucun historique
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="ri-settings-3-line me-2 text-muted"></i>Actions</h5>
                        </div>
                        <div class="card-body d-flex flex-column gap-2">

                            <button type="button" class="btn btn-success w-100 text-start"
                                    data-bs-toggle="modal" data-bs-target="#approModal">
                                <i class="ri-add-circle-line me-2"></i> Approvisionner le stock
                            </button>
                            <button type="button" class="btn btn-secondary w-100 text-start"
                                    data-bs-toggle="modal" data-bs-target="#modifiprodModal">
                                <i class="ri-pencil-line me-2"></i> Modifier les informations
                            </button>
                            <button type="button" class="btn btn-info w-100 text-start"
                                    data-bs-toggle="modal" data-bs-target="#modifimageModal">
                                <i class="ri-image-edit-line me-2"></i> Modifier l'image principale
                            </button>
                            <button type="button" class="btn btn-warning w-100 text-start"
                                    data-bs-toggle="modal" data-bs-target="#modifgalerieModal">
                                <i class="ri-gallery-line me-2"></i> Modifier la galerie
                            </button>
                            <hr class="my-1">
                            <form action="/saveValueFeatured" method="POST">
                                @csrf
                                @if($produit['featured'] != null)
                                    <input type="hidden" value="0" name="featured">
                                    <input type="hidden" value="{{ $produit['code_product'] }}" name="code_product">
                                    <button type="submit" class="btn btn-danger w-100 text-start"
                                            onclick="return confirm('Retirer de la vedette ?')">
                                        <i class="ri-star-fill me-2"></i> Retirer de la vedette
                                    </button>
                                @else
                                    <input type="hidden" value="1" name="featured">
                                    <input type="hidden" value="{{ $produit['code_product'] }}" name="code_product">
                                    <button type="submit" class="btn btn-success w-100 text-start"
                                            onclick="return confirm('Mettre en vedette ?')">
                                        <i class="ri-star-line me-2"></i> Mettre en vedette
                                    </button>
                                @endif
                            </form>
                            <form action="/saveValueArchive" method="POST">
                                @csrf
                                @if($produit['archive'] != null)
                                    <input type="hidden" value="1" name="archive">
                                    <input type="hidden" value="{{ $produit['code_product'] }}" name="code_product">
                                    <button type="submit" class="btn btn-success w-100 text-start mt-2">
                                        <i class="ri-lock-unlock-line me-2"></i> Déarchiver le produit
                                    </button>
                                @else
                                    <input type="hidden" value="0" name="archive">
                                    <input type="hidden" value="{{ $produit['code_product'] }}" name="code_product">
                                    <button type="submit" class="btn btn-danger w-100 text-start mt-2"
                                            onclick="return confirm('Archiver ce produit ?')">
                                        <i class="ri-archive-line me-2"></i> Archiver le produit
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Modal Approvisionnement -->
    <div class="modal fade" id="approModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approvisionner — {{ $produit['name'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-3"
                         style="background:#f8fafc;border:1px solid #e2e8f0;">
                        <div>
                            <div style="font-size:12px;color:#64748b;">Stock actuel</div>
                            <div style="font-size:22px;font-weight:700;color:#1e293b;">{{ $produit['quantity'] }}</div>
                        </div>
                        <i class="ri-archive-drawer-line" style="font-size:32px;color:#e2e8f0;"></i>
                    </div>
                    <form action="/saveApprovisionnement" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $produit['code_product'] }}" name="code_product">
                        <input type="hidden" value="{{ $produit['quantity'] }}" name="old_quantity">
                        <div class="mb-3">
                            <label class="form-label">Quantité à ajouter</label>
                            <input type="text" name="new_quantity" class="form-control"
                                   placeholder="Ex : 50" min="1" required />
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Modifier produit -->
    <div class="modal fade" id="modifiprodModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier les informations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updateProduct" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" name="name"
                                   value="{{ $produit['name'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="ckeditor-classic">{{ $produit['description'] }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select name="categorie" id="categorie" class="form-select">
                                <option value="">— Choisir la catégorie —</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" @if($categorie->id == $produit['idcategory']) selected @endif>
                                    {{ $categorie->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prix unitaire (CFA)</label>
                            <input type="number" class="form-control" name="amount"
                                   value="{{ $produit['amount'] }}" required>
                        </div>
                        <input type="hidden" value="{{ $produit['code_product'] }}" name="code_product">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Modifier image principale -->
    <div class="modal fade" id="modifimageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'image principale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updatePicture" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Image actuelle</label>
                            <img src="{{ asset('uploads/'.$produit['picture']) }}"
                                 class="w-100 rounded-3 mb-3" style="max-height:180px;object-fit:cover;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nouvelle image</label>
                            <input type="file" class="form-control" name="picture"
                                   accept="image/png,image/webp,image/gif,image/jpeg" required>
                        </div>
                        <input type="hidden" value="{{ $produit['code_product'] }}" name="code_product">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Modifier galerie -->
    <div class="modal fade" id="modifgalerieModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la galerie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updateProduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            @foreach($produit['galerie'] as $items)
                            <div class="col-3">
                                <img src="{{ asset('uploads/'.$items->image) }}"
                                     class="w-100 rounded-3" style="height:80px;object-fit:cover;">
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nouvelles images (remplacera la galerie)</label>
                            <input type="file" class="form-control" name="images[]"
                                   accept="image/*" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
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
