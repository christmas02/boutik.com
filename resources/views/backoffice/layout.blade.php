<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Boutik17 | Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS (Remix Icons) -->
    <link href="{{ asset('/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Dropzone -->
    <link href="{{ asset('/admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* ===================== DESIGN SYSTEM ===================== */
        :root {
            --sidebar-width: 240px;
            --sidebar-bg:    #0f172a;
            --accent:        #14b8a6;
            --accent-hover:  #0d9488;
            --content-bg:    #f1f5f9;
            --white:         #ffffff;
            --border:        #e2e8f0;
            --text-primary:  #1e293b;
            --text-muted:    #64748b;
            --topbar-h:      62px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--content-bg);
            color: var(--text-primary);
            font-size: 14px;
        }

        /* ===================== SIDEBAR ===================== */
        #boutik-sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1040;
        }
        #boutik-sidebar::-webkit-scrollbar { width: 4px; }
        #boutik-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

        .sidebar-header {
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.06);
            flex-shrink: 0;
        }
        .sidebar-brand {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.5px;
            text-decoration: none;
        }
        .sidebar-brand em { color: var(--accent); font-style: normal; }

        .sidebar-body {
            flex: 1;
            padding: 10px 0;
        }
        .sidebar-section-label {
            padding: 14px 18px 5px;
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            color: rgba(255,255,255,.25);
        }
        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            margin: 1px 8px;
            color: rgba(255,255,255,.55);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            border-radius: 8px;
            transition: background .15s, color .15s;
        }
        .sidebar-nav-item i {
            font-size: 16px;
            width: 18px;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar-nav-item:hover {
            color: #fff;
            background: rgba(255,255,255,.06);
            text-decoration: none;
        }
        .sidebar-nav-item.active {
            color: #fff;
            background: var(--accent);
        }

        .sidebar-footer {
            padding: 10px 0;
            border-top: 1px solid rgba(255,255,255,.06);
            flex-shrink: 0;
        }
        .sidebar-user-box {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            margin-top: 4px;
        }
        .sidebar-user-box img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,.12);
        }
        .sidebar-user-name {
            font-size: 12.5px;
            font-weight: 600;
            color: #fff;
            line-height: 1.3;
        }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,.35); }

        /* ===================== TOPBAR ===================== */
        #main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #boutik-topbar {
            background: var(--white);
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            flex-shrink: 0;
        }
        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 14px;
        }
        .topbar-search input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            width: 190px;
            color: var(--text-primary);
        }
        .topbar-search input::placeholder { color: #94a3b8; }
        .topbar-search i { color: #94a3b8; font-size: 15px; }

        .topbar-user-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 8px;
            border-radius: 8px;
            transition: background .15s;
        }
        .topbar-user-btn:hover { background: #f8fafc; }
        .topbar-user-btn img {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
        }
        .topbar-user-name { font-size: 13px; font-weight: 600; color: var(--text-primary); line-height: 1.2; }
        .topbar-user-role { font-size: 11px; color: #94a3b8; }

        /* ===================== PAGE CONTENT ===================== */
        .main-content { flex: 1; display: flex; flex-direction: column; }
        .page-content { flex: 1; padding: 24px; }

        .page-title-box h4 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0;
        }

        /* ===================== CARDS ===================== */
        .card {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 1px 3px rgba(0,0,0,.06) !important;
            margin-bottom: 20px;
        }
        .card-header {
            background: var(--white) !important;
            border-bottom: 1px solid #f1f5f9 !important;
            border-radius: 12px 12px 0 0 !important;
            padding: 16px 20px !important;
        }
        .card-header h5 { font-size: 14px; font-weight: 600; color: var(--text-primary); margin: 0; }
        .card-body { padding: 20px !important; }

        /* ===================== STAT CARDS ===================== */
        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .stat-icon.teal   { background: rgba(20,184,166,.12); color: var(--accent); }
        .stat-icon.orange { background: rgba(249,115,22,.12);  color: #f97316; }
        .stat-icon.purple { background: rgba(139,92,246,.12);  color: #8b5cf6; }
        .stat-icon.blue   { background: rgba(59,130,246,.12);  color: #3b82f6; }
        .stat-value { font-size: 26px; font-weight: 700; color: var(--text-primary); line-height: 1.1; }
        .stat-label { font-size: 12px; color: #94a3b8; margin-top: 2px; }

        /* ===================== BUTTONS ===================== */
        .btn-success, .btn-primary {
            background-color: var(--accent) !important;
            border-color: var(--accent) !important;
            color: #fff !important;
            font-weight: 500;
            border-radius: 8px !important;
        }
        .btn-success:hover, .btn-primary:hover,
        .btn-success:focus, .btn-primary:focus {
            background-color: var(--accent-hover) !important;
            border-color: var(--accent-hover) !important;
            box-shadow: none !important;
        }
        .btn-soft-success {
            background-color: rgba(20,184,166,.12) !important;
            color: var(--accent) !important;
            border: none !important;
            border-radius: 6px !important;
        }
        .btn-soft-danger {
            background-color: rgba(239,68,68,.12) !important;
            color: #ef4444 !important;
            border: none !important;
            border-radius: 6px !important;
        }
        .btn-soft-warning {
            background-color: rgba(234,179,8,.12) !important;
            color: #ca8a04 !important;
            border: none !important;
            border-radius: 6px !important;
        }
        .btn-danger {
            background-color: #ef4444 !important;
            border-color: #ef4444 !important;
            border-radius: 8px !important;
        }
        .btn-warning {
            background-color: #f59e0b !important;
            border-color: #f59e0b !important;
            border-radius: 8px !important;
        }
        .btn-secondary {
            background-color: #475569 !important;
            border-color: #475569 !important;
            border-radius: 8px !important;
        }
        .btn-info {
            background-color: #3b82f6 !important;
            border-color: #3b82f6 !important;
            border-radius: 8px !important;
        }
        .btn-light { border-radius: 8px !important; }
        .btn-sm { font-size: 12px !important; padding: 4px 10px !important; }

        /* ===================== TABLES ===================== */
        .table thead th, table.dataTable thead th {
            background: #f8fafc !important;
            color: var(--text-muted) !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: .6px !important;
            border-bottom: 1px solid var(--border) !important;
            white-space: nowrap;
        }
        .table tbody td { vertical-align: middle; font-size: 13.5px; }
        .table tbody tr:hover td { background: #f8fafc; }
        table.dataTable { border-collapse: collapse !important; }

        /* ===================== FORMS ===================== */
        .form-control, .form-select {
            border-radius: 8px !important;
            border: 1px solid var(--border) !important;
            font-size: 13.5px !important;
            padding: 8px 12px !important;
            color: var(--text-primary) !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(20,184,166,.12) !important;
        }
        .form-label { font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 5px; }
        .form-text { font-size: 12px; color: #94a3b8; }

        /* ===================== MODALS ===================== */
        .modal-content {
            border-radius: 16px !important;
            border: none !important;
            box-shadow: 0 20px 60px rgba(0,0,0,.15) !important;
        }
        .modal-header {
            border-radius: 16px 16px 0 0 !important;
            padding: 18px 22px !important;
            border-bottom: 1px solid var(--border) !important;
        }
        .modal-title { font-size: 15px; font-weight: 600; }
        .modal-body { padding: 20px 22px !important; }
        .modal-footer { padding: 14px 22px !important; border-top: 1px solid var(--border) !important; }

        /* ===================== ALERTS ===================== */
        .alert { border-radius: 10px !important; border: none !important; font-size: 13.5px !important; }
        .alert-success { background: rgba(20,184,166,.1) !important; color: #0d9488 !important; }
        .alert-danger  { background: rgba(239,68,68,.1) !important; color: #dc2626 !important; }

        /* ===================== DROPDOWN ===================== */
        .dropdown-menu {
            border-radius: 12px !important;
            border: 1px solid var(--border) !important;
            box-shadow: 0 8px 30px rgba(0,0,0,.1) !important;
            padding: 6px !important;
        }
        .dropdown-item {
            border-radius: 8px !important;
            font-size: 13.5px !important;
            padding: 8px 12px !important;
        }
        .dropdown-item:hover { background: #f8fafc !important; }
        .dropdown-header { font-size: 11px !important; font-weight: 700 !important; text-transform: uppercase; letter-spacing: .6px; padding: 6px 12px 4px !important; }
        .dropdown-divider { margin: 4px 0 !important; }

        /* ===================== BADGES ===================== */
        .badge { border-radius: 6px !important; font-weight: 500 !important; }

        /* ===================== FOOTER ===================== */
        footer.footer {
            background: var(--white);
            padding: 14px 24px;
            border-top: 1px solid var(--border);
            font-size: 12px;
            color: #94a3b8;
        }

        /* ===================== HIDE VELZON ===================== */
        .vertical-overlay, #back-to-top, #preloader,
        .app-menu, #page-topbar, .navbar-menu { display: none !important; }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 991px) {
            #boutik-sidebar { transform: translateX(-100%); }
            #main-wrapper { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- ========== SIDEBAR ========== -->
@include('backoffice.sidebar')

<!-- ========== MAIN WRAPPER ========== -->
<div id="main-wrapper">

    @include('backoffice.header')

    @yield('content')

</div>
<!-- end main-wrapper -->

<!-- ========== MODAL PROFILE ========== -->
<div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Modification du profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/update/profiluser" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            @if(Auth::user()->picture != NULL)
                                <img class="rounded-circle img-thumbnail" style="width:80px;height:80px;object-fit:cover;"
                                     src="{{ env('IMAGES_PATH') }}/{{ Auth::user()->picture }}" alt="Avatar">
                            @else
                                <img class="rounded-circle img-thumbnail" style="width:80px;height:80px;object-fit:cover;"
                                     src="{{ asset('/admin/assets/images/users/avatar-1.jpg') }}" alt="Avatar">
                            @endif
                        </div>
                        <h6 class="mt-2 mb-0">{{ auth()->user()->name }}</h6>
                        <small class="text-muted">Administrateur</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo de profil</label>
                        <input type="file" name="file" class="form-control">
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nom d'utilisateur</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ========== MODAL MOT DE PASSE ========== -->
<div class="modal fade" id="passwordModalgrid" tabindex="-1" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/update/changePasswordUser" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control password-input" placeholder="Min. 8 caractères" id="password-input" required>
                            <button class="btn btn-link position-absolute end-0 top-0 text-muted password-addon" type="button">
                                <i class="ri-eye-fill"></i>
                            </button>
                        </div>
                        <div class="form-text">Doit contenir au moins 8 caractères.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stack('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ asset('/admin/assets/js/pages/datatables.init.js') }}"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/admin/assets/js/pages/select2.init.js') }}"></script>
<!-- CKEditor -->
<script src="{{ asset('/admin/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<!-- Dropzone -->
<script src="{{ asset('/admin/assets/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/pages/ecommerce-product-create.init.js') }}"></script>
<!-- Sweet Alerts -->
<script src="{{ asset('/admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Profile -->
<script src="{{ asset('/admin/assets/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ asset('/admin/assets/js/pages/passowrd-create.init.js') }}"></script>
<!-- Feather Icons -->
<script src="{{ asset('/admin/assets/libs/feather-icons/feather.min.js') }}"></script>

<script>
    $(document).ready(function () {
        // AJAX sous-catégories
        $('#categorie').on('change', function (e) {
            var cat_id = e.target.value;
            $.get('/ajax_souscategorie?cat_id=' + cat_id, function (data) {
                $('#souscategorie').empty();
                $.each(data, function (index, subcatObj) {
                    $('#souscategorie').append('<option value="' + subcatObj.id + '">' + subcatObj.name + '</option>');
                });
            });
        });
    });
</script>

</body>
</html>
