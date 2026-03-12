@extends('backoffice.layout')

@section('page-title', 'Nouveau produit')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">Créer un produit</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Ajouter un nouveau produit au catalogue</p>
                </div>
                <a href="/list/product" class="btn btn-light">
                    <i class="ri-arrow-left-line me-1"></i> Retour
                </a>
            </div>

            @include('backoffice.status')

            <form id="createproduct-form" autocomplete="off" class="needs-validation"
                  method="POST" action="/saveProduct" enctype="multipart/form-data" novalidate>
                {{ csrf_field() }}

                <div class="row g-4">

                    <!-- COLONNE PRINCIPALE -->
                    <div class="col-lg-8">

                        <!-- Informations générales -->
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="ri-information-line me-2 text-muted"></i>Informations générales</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nom du produit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" placeholder="Ex : Parfum Oud Royal 100ml" required>
                                    <div class="invalid-feedback">Veuillez saisir un nom de produit.</div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label">Description du produit</label>
                                    <textarea name="description" id="ckeditor-classic"
                                              placeholder="Description détaillée du produit...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="ri-image-line me-2 text-muted"></i>Images du produit</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label class="form-label">Image principale <span class="text-danger">*</span></label>
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width:80px;height:80px;border-radius:10px;background:#f8fafc;border:2px dashed #e2e8f0;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                            <img src="#" id="product-img" style="width:100%;height:100%;object-fit:cover;display:none;">
                                            <i class="ri-image-add-line" id="img-placeholder" style="font-size:24px;color:#cbd5e1;"></i>
                                        </div>
                                        <div>
                                            <label for="product-image-input" class="btn btn-light btn-sm" style="cursor:pointer;">
                                                <i class="ri-upload-2-line me-1"></i> Choisir
                                            </label>
                                            <input class="d-none" id="product-image-input" name="picture" type="file"
                                                   accept="image/webp,image/png,image/gif,image/jpeg">
                                            <p class="text-muted mt-1 mb-0" style="font-size:12px;">PNG, JPG, WEBP acceptés</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Images galerie (jusqu'à 4 photos)</label>
                                    <input id="imageInput2" type="file" name="images[]"
                                           accept="image/*" class="form-control" multiple required>
                                    <div class="form-text text-danger">Choisissez jusqu'à 4 images de détail.</div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="ri-save-line me-1"></i> Enregistrer le produit
                            </button>
                        </div>
                    </div>

                    <!-- COLONNE LATÉRALE -->
                    <div class="col-lg-4">

                        <!-- Catégorie -->
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="ri-list-check me-2 text-muted"></i>Classification</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Catégorie <span class="text-danger">*</span></label>
                                    <select name="categorie" id="categorie" class="form-select">
                                        <option value="">— Choisir la catégorie —</option>
                                        @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ old('categorie') == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sous catégorie</label>
                                    <select name="subcategorie" id="souscategorie" class="form-select">
                                        <option value="">— Choisir la sous catégorie —</option>
                                        @foreach($sous_categories as $scat)
                                        <option value="{{ $scat->id }}">{{ $scat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label">Disponibilité</label>
                                    <select name="typeachat" class="form-select">
                                        <option value="DISPO">Disponible</option>
                                        <option value="PRE_COM">Pré-commande</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Prix & Stock -->
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="ri-price-tag-3-line me-2 text-muted"></i>Prix & Stock</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Quantité en stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="quantity"
                                           value="{{ old('quantity') }}" placeholder="0" min="0" required>
                                    <div class="invalid-feedback">Veuillez indiquer la quantité.</div>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label">Prix unitaire (CFA) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="amount"
                                           value="{{ old('amount') }}" placeholder="0" min="0" required>
                                    <div class="invalid-feedback">Veuillez indiquer le prix.</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

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

@push('scripts')
<script>
    // Aperçu image principale
    document.getElementById('product-image-input')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('product-img').src = ev.target.result;
                document.getElementById('product-img').style.display = 'block';
                document.getElementById('img-placeholder').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
