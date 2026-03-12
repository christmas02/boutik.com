@extends('backoffice.layout')

@section('page-title', 'Nouvel administrateur')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">Créer un administrateur</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Ajouter un nouveau compte administrateur</p>
                </div>
                <a href="/liste/administrateur" class="btn btn-light">
                    <i class="ri-arrow-left-line me-1"></i> Retour
                </a>
            </div>

            @include('backoffice.status')

            <form id="createproduct-form" autocomplete="off" class="needs-validation"
                  method="POST" action="/save/administrateur" enctype="multipart/form-data" novalidate>
                {{ csrf_field() }}

                <div class="row g-4">

                    <!-- Informations personnelles -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="ri-user-line me-2 text-muted"></i>Informations personnelles</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nom et Prénom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" placeholder="Ex : Jean Dupont" required>
                                    @error('name')
                                    <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Adresse email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" placeholder="admin@boutik17.com" required>
                                    @error('email')
                                    <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="phone"
                                           value="{{ old('phone') }}" placeholder="Ex : 0701234567" required>
                                    @error('phone')
                                    <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accès & sécurité -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="ri-shield-keyhole-line me-2 text-muted"></i>Accès & sécurité</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Rôle <span class="text-danger">*</span></label>
                                    <select name="role" class="form-select">
                                        <option value="">— Choisir un rôle —</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role['value'] }}"
                                                {{ old('role') == $role['value'] ? 'selected' : '' }}>
                                            {{ $role['libel'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Min. 8 caractères" required>
                                    @error('password')
                                    <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="Confirmer le mot de passe" required>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="ri-user-add-line me-1"></i> Créer l'administrateur
                            </button>
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
@endsection
