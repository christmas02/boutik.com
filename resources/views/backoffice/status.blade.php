@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
    <i class="ri-checkbox-circle-line fs-5"></i>
    <div><strong>Succès :</strong> {{ Session::get('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
    <i class="ri-error-warning-line fs-5"></i>
    <div><strong>Erreur :</strong> {{ Session::get('error') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
