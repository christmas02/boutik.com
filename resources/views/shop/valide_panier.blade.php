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
                    <h2 class="mn-breadcrumb-title">Checkout Page</h2>
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- mn-breadcrumb-list start -->
                    <ul class="mn-breadcrumb-list">
                        <li class="mn-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="mn-breadcrumb-item active">Checkout Page</li>
                    </ul>
                    <!-- mn-breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Checkout section -->
<section class="mn-checkout-section p-b-15">
    <h2 class="d-none">Checkout Page</h2>
    <div class="row">
        <div class="mn-checkout-leftside col-lg-8 col-md-12">
            <!-- checkout content Start -->
            <div class="mn-checkout-content">
                <div class="mn-checkout-inner">
                   <!-- <div class="mn-checkout-wrap m-b-30">
                        <div class="mn-checkout-block mn-check-new">
                            <h3 class="mn-checkout-title">New Customer</h3>
                            <div class="mn-check-block-content">
                                <div class="mn-check-subtitle">Checkout Options</div>
                                <form action="#">
												<span class="mn-new-option">
													<span class="m-b-15">
														<input type="radio" id="account1" name="radio-group" checked>
														<label for="account1">Register Account</label>
													</span>
													<span class="m-b-15">
														<input type="radio" id="account2" name="radio-group">
														<label for="account2">Guest Account</label>
													</span>
												</span>
                                </form>
                                <div class="mn-new-desc">By creating an account you will be able to shop
                                    faster,
                                    be up to date on an order's status, and keep track of the orders you
                                    have
                                    previously made.
                                </div>
                                <div class="mn-new-btn"><a href="#"
                                                           class="mn-btn-2"><span>Continue</span></a></div>

                            </div>
                        </div>
                        <div class="mn-checkout-block mn-check-login">
                            <h3 class="mn-checkout-title">Returning Customer</h3>
                            <div class="mn-check-login-form">
                                <form action="#" method="post">
												<span class="mn-check-login-wrap">
													<label>Email Address</label>
													<input type="text" name="name"
                                                           placeholder="Enter your email address" required>
												</span>
                                    <span class="mn-check-login-wrap">
													<label>Password</label>
													<input type="password" name="password"
                                                           placeholder="Enter your password" required>
												</span>

                                    <span class="mn-check-login-wrap mn-check-login-btn">
													<button class="mn-btn-2" type="submit"><span>Login</span></button>
													<a class="mn-check-login-fp" href="#">Forgot Password?</a>
												</span>
                                </form>
                            </div>
                        </div>

                    </div> -->

                    <div class="mn-checkout-wrap m-b-30 padding-bottom-3">
                        <div class="mn-checkout-block mn-check-bill">
                            <h3 class="mn-checkout-title">Informations vous concernant</h3>
                            <div class="mn-bl-block-content">

                                <div class="mn-check-bill-form">
                                    <form action="/valide_commande" method="post">
                                        @csrf
                                        <span class="mn-bill-wrap mn-bill-half">
                                            <label>Nom *</label>
                                            <input type="text" name="username" placeholder="Doe" required>
                                        </span>
                                        <span class="mn-bill-wrap mn-bill-half">
                                            <label>Prénom *</label>
                                            <input type="text" name="firstname" placeholder="John" required>
                                        </span>
                                        <span class="mn-bill-wrap mn-bill-half">
                                            <label>Adress electronique </label>
                                            <input type="text" name="email" placeholder="john@exemple.com">
                                        </span>
                                        <span class="mn-bill-wrap mn-bill-half">
                                            <label>Numéro whatsapp *</label>
                                            <input type="text" name="phone" placeholder="00 00 00 00 ">
                                        </span>
                                        <span class="mn-bill-wrap">
                                            <label>Lieu de livraison (Commune, quartier) *</label>
                                            <input type="text" name="livraison" placeholder="Cocody angré en face nouveau chu dans l'immeuble de la versus bank">
                                        </span>

                                        <span class="mn-check-login-wrap mn-check-login-btn">
                                        </span>
                                        <div class="mn-new-btn">
                                            <button class="mn-btn-2" type="submit"><span>Valider votre commande</span></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--cart content End -->
        </div>
        <!-- Sidebar Area Start -->
        <div class="mn-checkout-rightside col-lg-4 col-md-12 m-t-991">
            <div class="mn-sidebar-wrap">
                <!-- Sidebar Summary Block -->
                <div class="mn-sidebar-block">
                    <div class="mn-sb-title">
                        <h3 class="mn-sidebar-title">Résumer de votre panier</h3>
                    </div>
                    <div class="mn-sb-block-content">
                        <div class="mn-checkout-summary">
                            <div>
                                <span class="text-left">Sous total</span>
                                <span class="text-right">{{ number_format($total, 0, ',', ' ') }} XOF</span>
                            </div>
                            <div>
                                <span class="text-left"> Livraison</span>
                                <span class="text-right">A la charge du client</span>
                            </div>

                            <div class="mn-checkout-summary-total">
                                <span class="text-left">Total Amount</span>
                                <span class="text-right">{{ number_format($total, 0, ',', ' ') }} XOF</span>
                            </div>
                        </div>
                        <div class="mn-checkout-pro">
                            <div class="col-sm-12 mb-6">
                                @foreach ($content as $item)
                                <div class="mn-product-inner">
                                    <div class="mn-pro-image-outer">
                                        <div class="mn-pro-image">
                                            <a href="product-detail.html" class="image">
                                                <img class="main-image" src="{{ env('IMAGES_PATH') }}/{{ $item->picture }}" alt="{{ $item->picture }}">
                                                <img class="hover-image" src="{{ env('IMAGES_PATH') }}/{{ $item->picture }}" alt="{{ $item->picture }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mn-pro-content">
                                        <h5 class="mn-pro-title"><a href="product-detail.html">Round neck cotton t-shirt</a></h5>
                                        <span class="mn-price"><span class="new-price"><span>{{ number_format($item->price, 0, ',', ' ') }} XOF</span> x {{ $item->quantity }}</span>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Summary Block -->
            </div>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<!-- calendar js-->
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>

@endsection


