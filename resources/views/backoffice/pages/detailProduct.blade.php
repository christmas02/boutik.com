@extends('backoffice.layout')

@section('content')
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail du $produit</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @include('backoffice.status')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gx-lg-5">
                                <div class="col-xl-4 col-md-8 mx-auto">
                                    <div class="product-img-slider sticky-side-div">
                                        <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <a class="container-image">
                                                        <img src="{{asset('uploads/'.$produit['picture'])}}" alt="" class="img-fluid d-block" />
                                                        <div class="overlay">
                                                            <button data-bs-toggle="modal" data-bs-target="#exampleModalUpadeImage{{ $produit['id'] }}" class="btn btn-sm btn-primary btn-rounded">
                                                                <i class="ri-pencil-fill align-bottom"></i>
                                                            </button>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end swiper thumbnail slide -->

                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-8">
                                    <div class="mt-xl-0 mt-5">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h4>{{$produit['name']}}</h4>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <div class="text-muted">Catégorie : <span class="text-body fw-medium">{{$produit['category']}}</span></div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Date de publication : <span class="text-body fw-medium">{{$produit['date_publication']}}</span></div>
                                                    <div class="vr"></div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="mt-4 text-muted">
                                            <h5 class="fs-14">Description :</h5>
                                            {!! $produit['description'] !!}

                                            <hr>

                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row" style="width: 200px;">Prix unitaire</th>
                                                        <td>{{ number_format($produit['amount'] ) }} CFA</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Quantité en stock</th>
                                                        <td>{{$produit['quantity']}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <hr>
                                            <h3>Autre images</h3>
                                            <hr>
                                            <div class="swiper-wrapper row">
                                                @foreach($produit['galerie'] as $items)
                                                <div class="col-md-3 swiper-slide">
                                                    <div class="nav-slide-item">
                                                        <a class="container-image">
                                                            <div class="" style="padding: 20px; border:1px solid red;">
                                                                <img src="{{asset('uploads/'.$items->image }}" alt="" class="img-fluid d-block" />
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Base Buttons -->
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#approModal">Approvissionement du $produit</button>

                            <button type="button" class="btn btn-secondary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#modifiprodModal">Modification du $produit</button>

                            <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#modifimageModal">Modification de l'image du $produit</button>

                            <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#modifgalerieModal">Modification la galerie du produit</button>

                            <form class="hstack gap-2 justify-content-end" action="/saveValueArchive" method="POST">
                                @csrf
                                @if( $produit['archive'] != null )
                                <input type="hidden" value="1" name="archive">
                                <input type="hidden" value="{{$produit['code_product']}}" name="code_product">
                                <button type="submit" class="btn btn-danger waves-effect waves-light" >Dérouiller le $produit</button>
                                @else
                                <input type="hidden" value="0" name="archive">
                                <input type="hidden" value="{{$produit['code_product']}}" name="code_product">
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Supprimer le $produit</button>
                                @endif
                            </form>
                            <!-- end row -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Historique d'évolution du $produit</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach($produit['historic'] as $value)
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                @if($value->operation == 1)
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                                @else
                                                <div class="avatar-title bg-danger rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Description de l'historique - <span class="fw-normal"> {{ $value->created_at }}</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">{{ $value->description }} </h6>
                                        <p class="text-muted">{{ $value->created_at }}</p>

                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <div class="modal fade" id="approModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Approvisionnement du $produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <tbody>
                        <tr>
                            <th scope="row" style="width: 200px;">Nom du $produit</th>
                            <td>{{$produit['name']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Quantité en stock </th>
                            <td>{{$produit['quantity']}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <form class="tablelist-form" action="/saveApprovisionnement" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email-field" class="form-label"></label>
                            <input type="hidden" value="{{$produit['code_product']}}" name="code_product">
                            <input type="hidden" value="{{$produit['quantity']}}" name="old_quantity">
                            <input type="text" name="new_quantity"  class="form-control" placeholder="Quantité du $produit pour approvissionement" required />
                            <div class="invalid-feedback">Entrée.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modifiprodModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Modification des information du produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>

                <form class="tablelist-form" action="/updateProduct" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Nom de produit</label>
                            <input type="text" class="form-control" name="name" value="{{ $produit['name'] }}" required>
                            <div class="invalid-feedback">Please Enter a product title.</div>
                        </div>
                        <div class="mb-3">
                            <label>Description du $produit</label>
                            <textarea name="description" id="ckeditor-classic"> {{ $produit['description'] }} </textarea>
                        </div>

                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Catégorie</label>
                            <select name="categorie" id="categorie" class="form-select">
                                <option value="">--Choisir la Catégorie--</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" @if($categorie->id == $produit['idcategory'] ) selected @endif>{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Montant</label>
                            <input type="text" class="form-control d-none">
                            <input type="number" class="form-control" name="amount" value="{{ $produit['amount'] }}"  required>
                            <div class="invalid-feedback">Please Enter a product title.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email-field" class="form-label"></label>
                            <input type="hidden" value="{{$produit['code_product']}}" name="code_product">
                            <div class="invalid-feedback">Entrée.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modifimageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Modification de l'image du $produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>

                <form class="tablelist-form" action="/updatePicture" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Image du $produit</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <div class="position-absolute top-100 start-100 translate-middle">
                                                <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                            <i class="ri-image-fill"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                                <input class="form-control d-none" value="" id="product-image-input" name="picture" type="file" accept="image/png, image/webp, image/gif, image/jpeg">
                                            </div>
                                            <div class="avatar-lg">
                                                <div class="avatar-title bg-light rounded">
                                                    <img src="#" id="product-img" class="avatar-md h-auto" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropzone d-none">

                                    </div>

                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                        <li class="mt-2" id="dropzone-preview-list">
                                            <!-- This is used as the file preview template -->
                                            <div class="border rounded">
                                                <div class="d-flex p-2">
                                                    <div class="flex-shrink-0 me-3">

                                                    </div>
                                                    <div class="flex-grow-1">

                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- end dropzon-preview -->
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="mb-3">
                            <label for="email-field" class="form-label"></label>
                            <input type="hidden" value="{{$produit['code_product']}}" name="code_product">
                            <div class="invalid-feedback">Entrée.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modifgalerieModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Modification des image de la galerie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>

                <form class="tablelist-form" action="/updateProduct" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        @foreach($produit['galerie'] as $items)
                        <div class="col-md-3 swiper-slide">
                            <div class="nav-slide-item">
                                <a class="container-image">
                                    <div class="" style="padding: 20px; border:1px solid red;">
                                        <img src="{{ env('IMAGES_PATH') }}/{{ $items->image }}" alt="" class="img-fluid d-block" />
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Nouvelle image</label>
                            <input type="file" class="form-control" name="image" value="" required>
                            <div class="invalid-feedback">Please Enter a product title.</div>
                        </div>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Enregistrer</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Velzon.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Richkoff
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->
@endsection


