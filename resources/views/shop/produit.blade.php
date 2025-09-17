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
                    <h2 class="mn-breadcrumb-title">Product Page</h2>
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- mn-breadcrumb-list start -->
                    <ul class="mn-breadcrumb-list">
                        <li class="mn-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="mn-breadcrumb-item active">Product Page</li>
                    </ul>
                    <!-- mn-breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div id="flash-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div> -->
<div id="flash-container" style="top: 20px; right: 20px; z-index: 9999;"></div>
<div class="row">
    <div class="col-xxl-12">
        <section class="mn-single-product">
            <div class="row">
                <div class="mn-pro-rightside mn-common-rightside col-lg-12 col-md-12 m-b-15">
                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img single-pro-img-no-sidebar">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="{{asset('uploads/'.$product['picture']) }}" alt="">
                                            </div>
                                            @foreach($product['galerie'] as $items)
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="{{asset('uploads/'.$items->image) }}" alt="">
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="single-nav-thumb">
                                            <div class="single-slide">
                                                <img class="img-responsive"  src="{{asset('uploads/'.$product['picture']) }}" alt="">
                                            </div>
                                            @foreach($product['galerie'] as $items)
                                            <div class="single-slide">
                                                <img class="img-responsive" src="{{asset('uploads/'.$items->image) }}" alt="">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc single-pro-desc-no-sidebar m-t-991">
                                    <div class="single-pro-content">
                                        <small> {{ $product['category'] }} </small>
                                        <h5 class="mn-single-title">{{ $product['name']}}</h5>

                                        <div class="mn-single-price-stoke">
                                            <div class="mn-single-price">
                                                <div class="final-price">{{ number_format($product['amount'] ) }} CFA</div>
                                            </div>
                                            <div class="mn-single-stoke">
                                                <span class="mn-single-sku">{{ $product['code_product']}}</span>
                                                @if($product['typeachat'] == "DISPO")
                                                <span class="mn-single-ps-title"> DISPONIBLE</span>
                                                @elseif( $product['typeachat'] == "PRE_COM")
                                                <span class="mn-single-ps-title"> PRÉ COMMANDE</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mn-single-desc"> {!! $product['description'] !!}</div>

                                        @if($product['typeachat'] == "DISPO")
                                        <div class="mn-single-qty" style="margin-top: 30px">
                                            <input type="hidden" id="id" name="id" value="{{ $product['id'] }}">
                                            <div class="qty-plus-minus">
                                                <input id="quantity" name="quantity" class="qty-input" type="text" name="ms_qtybtn" value="1">
                                            </div>
                                            <div class="mn-btns">
                                                <div class="mn-single-cart">
                                                    <button id="addcart" class="btn btn-primary mn-btn-2">
                                                        <span>Ajouter au panier</span>
                                                    </button>
                                                </div>
                                                <div class="mn-single-wishlist">
                                                    <a href="javascript:void(0)"
                                                       class="mn-btn-group wishlist mn-wishlist"
                                                       title="Wishlist">
                                                        <i class="ri-heart-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                       @elseif( $product['typeachat'] == "PRE_COM")
                                        <div class="mn-single-qty">
                                            <div class="mn-btns">
                                                <div class="mn-single-cart">
                                                    <button class="btn btn-primary mn-btn-2 mn-add-cart"><span>Pré_commander</span></button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->


                    <!-- Related Section -->
                    <section class="mn-related-product m-t-30">
                        <div class="mn-title">
                            <h2>Related <span>Products</span></h2>
                        </div>
                        <div class="mn-related owl-carousel">
                            <div class="mn-product-card">
                                <div class="mn-product-img">
                                    <div class="lbl">
                                        <span class="trending">trending</span>
                                    </div>
                                    <div class="mn-img">
                                        <a href="product-detail.html" class="image">
                                            <img class="main-img" src="assets/img/product/5.jpg"
                                                 alt="product">
                                            <img class="hover-img" src="assets/img/product/6.jpg"
                                                 alt="product">
                                        </a>
                                        <div class="mn-pro-loader"></div>
                                        <div class="mn-options">
                                            <ul>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Quick View" data-link-action="quickview"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#quickview_modal">
                                                        <i class="ri-eye-line"></i></a></li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Compare" class="mn-compare"><i
                                                            class="ri-repeat-line"></i></a>
                                                </li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Add To Cart" class="mn-add-cart"><i
                                                            class="ri-shopping-cart-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mn-product-detail">
                                    <div class="cat">
                                        <a href="shop-right-sidebar.html">T-shirt</a>
                                        <ul>
                                            <li>s</li>
                                            <li>m</li>
                                            <li>xl</li>
                                        </ul>
                                    </div>
                                    <h5><a href="">Cotton fabric T-shirt</a></h5>
                                    <div class="mn-price">
                                        <div class="mn-price-new">$120</div>
                                        <div class="mn-price-old">$130</div>
                                    </div>
                                    <div class="mn-pro-option">
                                        <div class="mn-pro-color">
                                            <ul class="mn-opt-swatch mn-change-img">
                                                <li class="active"><a href="#" class="mn-opt-clr-img active"
                                                                      data-src="assets/img/product/5.jpg"
                                                                      data-src-hover="assets/img/product/5.jpg"
                                                                      data-tooltip="Gray"><span
                                                            style="background-image:url('assets/img/product/bg/5.jpg');"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/6.jpg"
                                                       data-src-hover="assets/img/product/6.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-image:url('assets/img/product/bg/6.jpg');"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/7.jpg"
                                                       data-src-hover="assets/img/product/7.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#e97e70;"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/8.jpg"
                                                       data-src-hover="assets/img/product/8.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#70e98a;"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="mn-wishlist" data-tooltip
                                           title="Wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mn-product-card">
                                <div class="mn-product-img">
                                    <div class="mn-img">
                                        <a href="product-detail.html" class="image">
                                            <img class="main-img" src="assets/img/product/9.jpg"
                                                 alt="product">
                                            <img class="hover-img" src="assets/img/product/10.jpg"
                                                 alt="product">
                                        </a>
                                        <div class="mn-pro-loader"></div>
                                        <div class="mn-options">
                                            <ul>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Quick View" data-link-action="quickview"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#quickview_modal"><i
                                                            class="ri-eye-line"></i></a></li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Compare" class="mn-compare"><i
                                                            class="ri-repeat-line"></i></a>
                                                </li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Add To Cart" class="mn-add-cart"><i
                                                            class="ri-shopping-cart-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mn-product-detail">
                                    <div class="cat">
                                        <a href="shop-right-sidebar.html">Shoes</a>
                                        <ul>
                                            <li>7</li>
                                            <li>8</li>
                                            <li>10</li>
                                        </ul>
                                    </div>
                                    <h5><a href="">Special sport shoes</a></h5>
                                    <div class="mn-price">
                                        <div class="mn-price-new">$55</div>
                                    </div>
                                    <div class="mn-pro-option">
                                        <div class="mn-pro-color">
                                            <ul class="mn-opt-swatch mn-change-img">
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/9.jpg"
                                                       data-src-hover="assets/img/product/9.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#0e0e0e;"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/10.jpg"
                                                       data-src-hover="assets/img/product/10.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#c54367;"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="mn-wishlist active"
                                           data-tooltip title="Wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mn-product-card">
                                <div class="mn-product-img">
                                    <div class="lbl">
                                        <span class="new">new</span>
                                    </div>
                                    <div class="mn-img">
                                        <a href="product-detail.html" class="image">
                                            <img class="main-img" src="assets/img/product/1.jpg"
                                                 alt="product">
                                            <img class="hover-img" src="assets/img/product/3.jpg"
                                                 alt="product">
                                        </a>
                                        <div class="mn-pro-loader"></div>
                                        <div class="mn-options">
                                            <ul>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Quick View" data-link-action="quickview"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#quickview_modal"><i
                                                            class="ri-eye-line"></i></a></li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Compare" class="mn-compare"><i
                                                            class="ri-repeat-line"></i></a>
                                                </li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Add To Cart" class="mn-add-cart"><i
                                                            class="ri-shopping-cart-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mn-product-detail">
                                    <div class="cat">
                                        <a href="shop-right-sidebar.html">Top</a>
                                        <ul>
                                            <li>s</li>
                                            <li>m</li>
                                        </ul>
                                    </div>
                                    <h5><a href="">Cotton fabric Top</a></h5>
                                    <div class="mn-price">
                                        <div class="mn-price-new">$120</div>
                                        <div class="mn-price-old">$130</div>
                                    </div>
                                    <div class="mn-pro-option">
                                        <div class="mn-pro-color">
                                            <ul class="mn-opt-swatch mn-change-img">
                                                <li class="active"><a href="#" class="mn-opt-clr-img active"
                                                                      data-src="assets/img/product/1.jpg"
                                                                      data-src-hover="assets/img/product/3.jpg"
                                                                      data-tooltip="Gray"><span
                                                            style="background-color:#f3f3f3;"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/2.jpg"
                                                       data-src-hover="assets/img/product/4.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#e8c2ff;"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="mn-wishlist" data-tooltip
                                           title="Wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mn-product-card">
                                <div class="mn-product-img">
                                    <div class="lbl">
                                        <span class="sale">sale</span>
                                    </div>
                                    <div class="mn-img">
                                        <a href="product-detail.html" class="image">
                                            <img class="main-img" src="assets/img/product/11.jpg"
                                                 alt="product">
                                            <img class="hover-img" src="assets/img/product/12.jpg"
                                                 alt="product">
                                        </a>
                                        <div class="mn-pro-loader"></div>
                                        <div class="mn-options">
                                            <ul>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Quick View" data-link-action="quickview"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#quickview_modal"><i
                                                            class="ri-eye-line"></i></a></li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Compare" class="mn-compare"><i
                                                            class="ri-repeat-line"></i></a>
                                                </li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Add To Cart" class="mn-add-cart"><i
                                                            class="ri-shopping-cart-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mn-product-detail">
                                    <div class="cat">
                                        <a href="shop-right-sidebar.html">watches</a>
                                    </div>
                                    <h5><a href="">Mantu smart watch</a></h5>
                                    <div class="mn-price">
                                        <div class="mn-price-new">$955</div>
                                        <div class="mn-price-old">$999</div>
                                    </div>
                                    <div class="mn-pro-option">
                                        <div class="mn-pro-color">
                                            <ul class="mn-opt-swatch mn-change-img">
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/11.jpg"
                                                       data-src-hover="assets/img/product/12.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#f3f3f3;"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/12.jpg"
                                                       data-src-hover="assets/img/product/11.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#242424;"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="mn-wishlist" data-tooltip
                                           title="Wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mn-product-card">
                                <div class="mn-product-img">
                                    <div class="lbl">
                                        <span class="discount">20% off</span>
                                    </div>
                                    <div class="mn-img">
                                        <a href="product-detail.html" class="image">
                                            <img class="main-img" src="assets/img/product/13.jpg"
                                                 alt="product">
                                            <img class="hover-img" src="assets/img/product/14.jpg"
                                                 alt="product">
                                        </a>
                                        <div class="mn-pro-loader"></div>
                                        <div class="mn-options">
                                            <ul>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Quick View" data-link-action="quickview"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#quickview_modal"><i
                                                            class="ri-eye-line"></i></a></li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Compare" class="mn-compare"><i
                                                            class="ri-repeat-line"></i></a>
                                                </li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Add To Cart" class="mn-add-cart"><i
                                                            class="ri-shopping-cart-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mn-product-detail">
                                    <div class="cat">
                                        <a href="shop-right-sidebar.html">belt</a>
                                    </div>
                                    <h5><a href="">Mantu leather belt</a></h5>
                                    <div class="mn-price">
                                        <div class="mn-price-new">$10</div>
                                        <div class="mn-price-old">$12</div>
                                    </div>
                                    <div class="mn-pro-option">
                                        <div class="mn-pro-color">
                                            <ul class="mn-opt-swatch mn-change-img">
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/13.jpg"
                                                       data-src-hover="assets/img/product/14.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#d48a5b;"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/14.jpg"
                                                       data-src-hover="assets/img/product/13.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#242424;"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="mn-wishlist" data-tooltip
                                           title="Wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mn-product-card">
                                <div class="mn-product-img">
                                    <div class="mn-img">
                                        <a href="product-detail.html" class="image">
                                            <img class="main-img" src="assets/img/product/15.jpg"
                                                 alt="product">
                                            <img class="hover-img" src="assets/img/product/16.jpg"
                                                 alt="product">
                                        </a>
                                        <div class="mn-pro-loader"></div>
                                        <div class="mn-options">
                                            <ul>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Quick View" data-link-action="quickview"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#quickview_modal"><i
                                                            class="ri-eye-line"></i></a></li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Compare" class="mn-compare"><i
                                                            class="ri-repeat-line"></i></a>
                                                </li>
                                                <li><a href="javascript:void(0)" data-tooltip
                                                       title="Add To Cart" class="mn-add-cart"><i
                                                            class="ri-shopping-cart-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="mn-product-detail">
                                    <div class="cat">
                                        <a href="shop-right-sidebar.html">Bag</a>
                                        <ul>
                                            <li>m</li>
                                            <li>l</li>
                                        </ul>
                                    </div>
                                    <h5><a href="">Leather bag</a></h5>
                                    <div class="mn-price">
                                        <div class="mn-price-new">$66</div>
                                    </div>
                                    <div class="mn-pro-option">
                                        <div class="mn-pro-color">
                                            <ul class="mn-opt-swatch mn-change-img">
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/15.jpg"
                                                       data-src-hover="assets/img/product/16.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#b75956;"></span></a>
                                                </li>
                                                <li><a href="#" class="mn-opt-clr-img"
                                                       data-src="assets/img/product/16.jpg"
                                                       data-src-hover="assets/img/product/15.jpg"
                                                       data-tooltip="Orange"><span
                                                            style="background-color:#0e0e0e;"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="mn-wishlist" data-tooltip
                                           title="Wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')

<!-- calendar js-->

@endsection


