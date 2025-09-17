@extends('layouts.simple.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('main_content')
<div class="mn-breadcrumb m-b-30">
    <div class="row">
        <div class="col-12">
            <div class="row gi_breadcrumb_inner">
                <div class="col-md-6 col-sm-12">
                    <h2 class="mn-breadcrumb-title">Panier</h2>
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- mn-breadcrumb-list start -->
                    <ul class="mn-breadcrumb-list">
                        <li class="mn-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="mn-breadcrumb-item active"> Panier</li>
                    </ul>
                    <!-- mn-breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart section -->

<section class="mn-cart-section p-b-15">
    <h2 class="d-none">Panier</h2>
    <div id="flash-container" style="top: 20px; right: 20px; z-index: 9999;"></div>

    <div class="row">
        <div class="mn-cart-leftside col-lg-12 col-md-12">
            <!-- cart content Start -->
            <div class="mn-cart-content">
                <div class="mn-cart-inner cart_list">
                    <div class="row">
                        @if(count($content) === 0)
                        <p style="text-align: center; font-size: 30px; margin: 40px 0px; font-family: Helvetica Neue, Arial, Helvetica, sans-serif; font-weight: bold">
                        Votre panier est vide</p>
                        @else
                        <form action="#">
                            <div class="table-content cart-table-content">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Produits</th>
                                        <th>Prix Unit</th>
                                        <th style="text-align: center;">Quantité</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($content as $item)
                                    <tr class="mn-cart-product">
                                        <td data-label="Product" class="mn-cart-pro-name">
                                            <a href="product-detail.html">
                                                <img class="mn-cart-pro-img" src="{{ env('IMAGES_PATH') }}/{{ $item->picture }}" alt="">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td data-label="Price" class="mn-cart-pro-price">
                                            <span class="amount">{{ number_format($item->price, 0, ',', ' ') }} XOF</span>
                                        </td>
                                        <td data-label="Quantity" class="" style="text-align: center;">
                                            <div class="">
                                                <input type="hidden" value="{{ $item->id }}" name="productId">
                                                <input type="number" class="cs-quantity_input"
                                                       id="quantity_{{ $item->id }}" name="quantity"
                                                       value="{{ $item->quantity }}" min="1"
                                                       onchange="updateQuantity(event, {{ $item->id }})">
                                            </div>
                                        </td>
                                        <td data-label="Total" id="subtotal_{{ $item->id }}" class="mn-cart-pro-subtotal">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} Fr CFA
                                        </td>
                                        <td data-label="" class="">
                                            <button id="deleteProduct" class="btn">
                                                <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mn-sb-block-content">
                                <div class="mn-cart-summary-bottom">
                                    <div class="mn-cart-summary">
                                        <div class="mn-cart-summary-total">
                                            <span class="text-left">Montant total du panier</span>
                                            <span class="text-right"> {{ number_format($prixTotal, 0, ',', ' ') }} XOF </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mn-cart-update-bottom">
                                    <a href="/">Continuez vos achats</a>
                                    <a class="mn-btn-2" href="/valide_panier"><span>Validez votre panier</span></a>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <!--cart content End -->
        </div>

    </div>
</section>
@endsection

@section('scripts')
<!-- calendar js-->
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>


@endsection


