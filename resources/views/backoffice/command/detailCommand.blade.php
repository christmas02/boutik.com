@extends('backoffice.layout')

@section('page-title', 'Détail commande')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">
                        Commande <code style="font-size:16px;">{{ $command['command']->identifiant_commande }}</code>
                    </h4>
                    <p class="text-muted mb-0" style="font-size:13px;">
                        Passée le {{ $command['command']->created_at }}
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ asset('/invoices') }}/{{ $command['command']->invoice }}" target="_blank"
                       class="btn btn-success btn-sm">
                        <i class="ri-download-2-line me-1"></i> Télécharger la facture
                    </a>
                    <a href="/list/command" class="btn btn-light btn-sm">
                        <i class="ri-arrow-left-line me-1"></i> Retour
                    </a>
                </div>
            </div>

            @include('backoffice.status')

            <div class="row g-4">

                <!-- Produits commandés -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="ri-shopping-bag-line me-2 text-muted"></i>Produits commandés</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead style="background:#f8fafc;">
                                        <tr>
                                            <th style="padding:12px 20px;">Produit</th>
                                            <th>Prix unitaire</th>
                                            <th>Quantité</th>
                                            <th class="text-end" style="padding-right:20px;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr style="border-top:1px solid #f1f5f9;">
                                            <td style="padding:14px 20px;">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ asset('uploads/'.$product['picture']) }}"
                                                         style="width:48px;height:48px;border-radius:8px;object-fit:cover;">
                                                    <div>
                                                        <div style="font-size:14px;font-weight:600;color:#1e293b;">
                                                            {{ $product['name_product'] }}
                                                        </div>
                                                        <div style="font-size:12px;color:#94a3b8;">
                                                            Code : {{ $product['code_product'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="vertical-align:middle;">{{ number_format($product['priceUnit']) }} CFA</td>
                                            <td style="vertical-align:middle;">{{ $product['quantity'] }}</td>
                                            <td class="text-end" style="vertical-align:middle;padding-right:20px;font-weight:600;">
                                                {{ number_format($product['prices']) }} CFA
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="border-top:2px solid #e2e8f0;">
                                        <tr>
                                            <td colspan="3" class="text-end" style="padding:14px 20px;font-weight:600;color:#64748b;">
                                                TOTAL À PAYER (XOF)
                                            </td>
                                            <td class="text-end" style="padding-right:20px;font-size:18px;font-weight:700;color:#1e293b;">
                                                {{ number_format($command['command']->amount) }} CFA
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar commande -->
                <div class="col-lg-4">

                    <!-- Info client -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="ri-user-line me-2 text-muted"></i>Informations client</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <img src="{{ asset('/admin/assets/images/users/user-dummy-img.jpg') }}"
                                     style="width:46px;height:46px;border-radius:50%;object-fit:cover;">
                                <div>
                                    <div style="font-size:14px;font-weight:600;color:#1e293b;">
                                        {{ $command['command']->username }} {{ $command['command']->firstname }}
                                    </div>
                                    <div style="font-size:12px;color:#94a3b8;">Client</div>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-0" style="font-size:13.5px;">
                                <li class="d-flex align-items-center gap-2 mb-2">
                                    <i class="ri-mail-line text-muted"></i>
                                    <span>{{ $command['command']->email }}</span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="ri-phone-line text-muted"></i>
                                    <span>{{ $command['command']->phone }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Statut commande -->
                    <div class="card">
                        <div class="card-header">
                            <h5><i class="ri-flag-line me-2 text-muted"></i>Statut de la commande</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="badge px-3 py-2" style="font-size:13px;
                                    @if($command['command']->statut == 2) background:rgba(20,184,166,.1);color:#14b8a6;
                                    @elseif($command['command']->statut == 11) background:rgba(239,68,68,.1);color:#ef4444;
                                    @elseif($command['command']->statut == 1) background:rgba(234,179,8,.1);color:#ca8a04;
                                    @elseif($command['command']->statut == 22) background:rgba(20,184,166,.1);color:#14b8a6;
                                    @endif">
                                    @if($command['command']->statut == 2) Traitement en cours
                                    @elseif($command['command']->statut == 11) Commande annulée
                                    @elseif($command['command']->statut == 1) Commande validée
                                    @elseif($command['command']->statut == 22) Commande exécutée
                                    @endif
                                </span>
                            </div>
                            <div class="mb-3" style="font-size:13.5px;color:#64748b;">
                                <i class="ri-truck-line me-1"></i> {{ $command['command']->type }}
                            </div>

                            @if(in_array($command['command']->statut, [1, 2]))
                            <form action="/save/statucommande" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $command['command']->identifiant_commande }}" name="id_commande">
                                <div class="mb-3">
                                    <label class="form-label">Mettre à jour le statut</label>
                                    <select name="statut" class="form-select">
                                        <option value="">— Choisir —</option>
                                        <option value="22">Livrée / Récupérée</option>
                                        <option value="11">Annuler</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="ri-check-line me-1"></i> Valider
                                </button>
                            </form>
                            @elseif($command['command']->statut == 22)
                            <div class="alert alert-success mb-0">
                                <i class="ri-checkbox-circle-line me-1"></i>
                                Commande livrée / récupérée.
                            </div>
                            @elseif($command['command']->statut == 11)
                            <div class="alert alert-danger mb-0">
                                <i class="ri-close-circle-line me-1"></i>
                                Commande annulée.
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
