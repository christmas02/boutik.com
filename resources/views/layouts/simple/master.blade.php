<!DOCTYPE html>
<html lang="fr">

<head>
    @include('layouts.simple.head')
    @include('layouts.simple.css')
</head>

<body data-mn-mode="">

<main class="wrapper sb-default">

    <!-- Loader -->
    <div id="mn-overlay">
        <div class="loader">
            <img src="assets/img/logo/loader.png" alt="loader">
            <span class="shape"></span>
        </div>
    </div>

    <!-- Header -->
    <header class="sb-hide">
        @include('layouts.simple.header')
    </header>

    <!-- Main Content -->
    <div class="mn-main-content sb-hide">
        @yield('main_content')
    </div>

    <!-- Footer -->
    @include('layouts.simple.footer')

    <!-- Quick view Modal -->
    <div class="modal fade quickview-modal" id="quickview_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="qty-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Close"></button>
                <div class="modal-body">
                    <div class="row mb-minus-24">
                        <div class="col-md-5 col-sm-12 col-xs-12 mb-24">
                            <div class="single-pro-img single-pro-img-no-sidebar">
                                <div class="single-product-scroll">
                                    <div class="single-slide-quickview owl-carousel">
                                        <img class="img-responsive" src="assets/img/product/1.jpg"
                                             alt="product-img-1">
                                        <img class="img-responsive" src="assets/img/product/2.jpg"
                                             alt="product-img-1">
                                        <img class="img-responsive" src="assets/img/product/3.jpg"
                                             alt="product-img-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12 mb-24">
                            <div class="quickview-pro-content">
                                <h5 class="mn-quick-title">
                                    <a href="product-detail.html">Best cotton fabric women's half sleeve
                                        T-shirt white color.</a>
                                </h5>
                                <div class="mn-pro-rating">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill grey"></i>
                                </div>
                                <div class="mn-quickview-desc">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                    ever
                                    since the 1900s.</div>
                                <div class="mn-quickview-price">
                                    <span class="new-price">$50.00</span>
                                    <span class="old-price">$62.00</span>
                                </div>
                                <div class="mn-pro-variations">
                                    <ul>
                                        <li class="active">
                                            <a href="javascript:void(0)" class="mn-opt-sz"
                                               data-tooltip="Small">s</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="mn-opt-sz"
                                               data-tooltip="Medium">m</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="mn-opt-sz"
                                               data-tooltip="Large">l</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="mn-opt-sz"
                                               data-tooltip="Extra Large">xl</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mn-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="mn-qtybtn" value="1">
                                    </div>
                                    <div class="mn-quickview-cart">
                                        <a href="cart.html" class="mn-btn-1">
                                            <span><i class="ri-shopping-bag-line"></i>Add To Cart</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Sidebar -->
    @include('layouts.simple.search_sidebar')

    <!-- Cart sidebar Start -->
    @include('layouts.simple.cart_sidebar')

    <!-- Wishlist sidebar Start -->
    @include('layouts.simple.wishlist_sidebar')

</main>
<!-- Vendor Custom -->
@include('layouts.simple.script')
</body>

</html>
