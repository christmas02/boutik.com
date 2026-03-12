@extends('backoffice.layout')

@section('page-title', 'Catégories')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">Liste des catégories</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Gérer les catégories de produits</p>
                </div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#showModal">
                    <i class="ri-add-line me-1"></i> Ajouter une catégorie
                </button>
            </div>

            @include('backoffice.status')

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date de création</th>
                                    <th>Code catégorie</th>
                                    <th>Nom de la catégorie</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $categorie)
                                <tr>
                                    <td></td>
                                    <td class="text-muted" style="font-size:12px;">{{ $categorie->created_at }}</td>
                                    <td><code style="font-size:12px;">{{ $categorie->code }}</code></td>
                                    <td style="font-weight:500;">{{ $categorie->name }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#update{{ $categorie->id }}">
                                                <i class="ri-pencil-line me-1"></i> Modifier
                                            </button>
                                            <a href="/supprimer/categorie/{{ $categorie->id }}"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Supprimer cette catégorie ?')">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
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

    <!-- Modal Ajouter catégorie -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvelle catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/saveCategory" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Code catégorie</label>
                            <input type="text" name="code_categ" class="form-control"
                                   placeholder="Ex : PARF" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nom de la catégorie</label>
                            <input type="text" name="nom_categ" class="form-control"
                                   placeholder="Ex : Parfums" required />
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

    <!-- Modals Modifier catégorie -->
    @foreach($categories as $value)
    <div class="modal fade" id="update{{ $value->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier — {{ $value->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updateCategory" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom de la catégorie</label>
                            <input type="hidden" value="{{ $value->id }}" name="id_category">
                            <input type="text" name="nom_category" class="form-control"
                                   value="{{ $value->name }}" required />
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
    @endforeach

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
