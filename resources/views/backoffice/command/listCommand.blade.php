@extends('backoffice.layout')

@section('page-title', 'Commandes')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">Liste des commandes</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Suivi et gestion des commandes clients</p>
                </div>
            </div>

            @include('backoffice.status')

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Référence</th>
                                    <th>Client</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commands as $command)
                                <tr>
                                    <td></td>
                                    <td>
                                        <code style="font-size:12px;">{{ $command->identifiant_commande }}</code>
                                    </td>
                                    <td style="font-weight:500;">
                                        {{ $command->username }} {{ $command->firstname }}
                                    </td>
                                    <td class="text-muted">{{ $command->email }}</td>
                                    <td class="text-muted">{{ $command->phone }}</td>
                                    <td class="text-muted" style="font-size:12px;">{{ $command->created_at }}</td>
                                    <td>
                                        @if($command->statut == 2)
                                            <span class="btn btn-soft-success btn-sm">Traitement en cours</span>
                                        @elseif($command->statut == 11)
                                            <span class="btn btn-soft-danger btn-sm">Annulée</span>
                                        @elseif($command->statut == 1)
                                            <span class="btn btn-soft-warning btn-sm">Validée</span>
                                        @elseif($command->statut == 22)
                                            <span class="btn btn-soft-success btn-sm">Exécutée</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge" style="background:rgba(59,130,246,.1);color:#3b82f6;font-size:11px;">
                                            {{ $command->type }}
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm"
                                           href="/detail/commande/{{ $command->identifiant_commande }}">
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
