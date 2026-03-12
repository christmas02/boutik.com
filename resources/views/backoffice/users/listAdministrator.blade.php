@extends('backoffice.layout')

@section('page-title', 'Administrateurs')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">Liste des administrateurs</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Gestion des comptes administrateurs</p>
                </div>
                <a href="/nouveau/administrateur" class="btn btn-success">
                    <i class="ri-user-add-line me-1"></i> Ajouter un administrateur
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
                                    <th>Nom & Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rôle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($administrator as $admin)
                                <tr>
                                    <td></td>
                                    <td style="font-weight:500;">{{ $admin->name }}</td>
                                    <td class="text-muted">{{ $admin->email }}</td>
                                    <td class="text-muted">{{ $admin->phone }}</td>
                                    <td>
                                        <span class="badge px-2 py-1" style="font-size:11px;font-weight:500;
                                            @switch($admin->role)
                                                @case(1) background:rgba(139,92,246,.1);color:#8b5cf6; @break
                                                @case(2) background:rgba(20,184,166,.1);color:#14b8a6; @break
                                                @case(3) background:rgba(59,130,246,.1);color:#3b82f6; @break
                                                @case(4) background:rgba(249,115,22,.1);color:#f97316; @break
                                                @default background:#f1f5f9;color:#64748b;
                                            @endswitch">
                                            @switch($admin->role)
                                                @case(1) Super Administrateur @break
                                                @case(2) Administrateur @break
                                                @case(3) Suivi commandes @break
                                                @case(4) Gestionnaire stock @break
                                                @default Rôle inconnu
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $admin->id }}">
                                            <i class="ri-pencil-line me-1"></i> Modifier
                                        </button>
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

    <!-- Modals Modifier -->
    @foreach($administrator as $admin)
    <div class="modal fade" id="editModal{{ $admin->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier — {{ $admin->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" method="POST" action="/update/administrateur" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $admin->id }}" />
                        <div class="mb-3">
                            <label class="form-label">Nom et Prénom</label>
                            <input type="text" class="form-control" name="name"
                                   value="{{ $admin->name }}" required>
                            @error('name')
                            <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email" class="form-control" name="email"
                                   value="{{ $admin->email }}" required>
                            @error('email')
                            <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="number" class="form-control" name="phone"
                                   value="{{ $admin->phone }}" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Rôle</label>
                            <select name="role" class="form-select">
                                <option value="">— Choisir un rôle —</option>
                                @foreach($roles as $role)
                                <option value="{{ $role['value'] }}" @if($role['value'] == $admin->role) selected @endif>
                                    {{ $role['libel'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
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
