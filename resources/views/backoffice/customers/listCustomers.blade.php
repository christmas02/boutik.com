@extends('backoffice.layout')

@section('page-title', 'Clients')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-1" style="font-size:20px;font-weight:700;color:#1e293b;">Liste des clients</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Base de données clients</p>
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
                                    <th>Avatar</th>
                                    <th>Nom du client</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Adresse de livraison</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td></td>
                                    <td>
                                        <img src="{{ asset('/admin/assets/images/users/user-dummy-img.jpg') }}"
                                             style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                                    </td>
                                    <td style="font-weight:500;">{{ $customer->name_customer }}</td>
                                    <td class="text-muted">{{ $customer->email }}</td>
                                    <td class="text-muted">{{ $customer->phone }}</td>
                                    <td class="text-muted">{{ $customer->adresse }}</td>
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
