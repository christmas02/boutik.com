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
                    <h2 class="mn-breadcrumb-title">{{ $categorie }}</h2>
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- mn-breadcrumb-list start -->
                    <ul class="mn-breadcrumb-list">
                        <li class="mn-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="mn-breadcrumb-item active">Nos categorie</li>
                    </ul>
                    <!-- mn-breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-12">
        <!-- Shop section -->
        <section class="mn-shop">

            <!-- Shop Banners Start -->
            <div class="m-b-30">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mn-ofr-banners">
                            <div class="mn-bnr-body">
                                <div class="mn-bnr-img">
                                    <span class="lbl">70% Off</span>
                                    <img src="{{ asset('assets/img/banner/5.jpg') }}" alt="banner">
                                </div>
                                <div class="mn-bnr-detail">
                                    <h5>Best men's fashion sale</h5>
                                    <p>Stylish Design of clothes.</p>
                                    <a href="shop-right-sidebar.html" class="mn-btn-2"><span>Shop Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mn-ofr-banners m-t-767">
                            <div class="mn-bnr-body">
                                <div class="mn-bnr-img">
                                    <span class="lbl">50% Off</span>
                                    <img src="{{ asset('assets/img/banner/6.jpg') }}" alt="banner">
                                </div>
                                <div class="mn-bnr-detail">
                                    <h5>Trending women's sale</h5>
                                    <p>Trending desings of clothes.</p>
                                    <a href="shop-right-sidebar.html" class="mn-btn-2"><span>Sho Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="filter-sidebar-overlay"></div>
                <div class="mn-shop-sidebar mn-filter-sidebar col-lg-3 col-md-12">
                    <div id="shop_sidebar">
                        <div class="mn-sidebar-wrap">
                            <!-- Sidebar Filters Block -->
                            <div class="mn-sidebar-block drop">
                                <div class="mn-sb-title">
                                    <h3 class="mn-sidebar-title">Filters</h3>
                                    <a href="javascript:void(0)" class="filter-close"><i class="ri-close-large-line"></i></a>
                                </div>
                                <div class="mn-sb-block-content p-t-15">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="mn-sidebar-block-item main drop">clothes</a>
                                            <ul style="display: block;">
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a href="#">Men
                                                            <span>-25</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a href="#">Women
                                                            <span>-52</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a href="#">Boy
                                                            <span>-40</span></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mn-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="mn-sidebar-block-item main drop">cosmetics</a>
                                            <ul>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Shampoo
                                                            <span>-25</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Body Wash
                                                            <span>-52</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Sunscreen
                                                            <span>-40</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Makeup
                                                            <span>-35</span></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mn-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="shop-right-sidebar.html"
                                               class="mn-sidebar-block-item main">shoes<span>-15</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mn-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="shop-right-sidebar.html"
                                               class="mn-sidebar-block-item main">bag<span>-27</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mn-sb-block-content">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="mn-sidebar-block-item main drop">electronics</a>
                                            <ul>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Laptop
                                                            <span>-25</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Air Conditioner
                                                            <span>-52</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Trimmer
                                                            <span>-40</span></a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="mn-sidebar-sub-item"><a
                                                            href="shop-right-sidebar.html">Watches
                                                            <span>-35</span></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Brand Block -->
                            <div class="mn-sidebar-block">
                                <div class="mn-sb-title">
                                    <h3 class="mn-sidebar-title">Brand</h3>
                                </div>
                                <div class="mn-sb-block-content">
                                    <ul>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" checked>
                                                <a href="javascript:void(0)">
                                                    <span>Zencart Mart</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox">
                                                <a href="javascript:void(0)">
                                                    <span>Xeta Store</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox">
                                                <a href="javascript:void(0)">
                                                    <span>Pili Market</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox">
                                                <a href="javascript:void(0)">
                                                    <span>Indiana Store</span>
                                                </a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Weight Block -->
                            <div class="mn-sidebar-block">
                                <div class="mn-sb-title">
                                    <h3 class="mn-sidebar-title">Size</h3>
                                </div>
                                <div class="mn-sb-block-content">
                                    <ul>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="" checked>
                                                <a href="#">S - Size</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <a href="#">M - Size</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <a href="#">L - Size</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <a href="#">XL - Size</a>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Color item -->
                            <div class="mn-sidebar-block color-block mn-sidebar-block-clr">
                                <div class="mn-sb-title">
                                    <h3 class="mn-sidebar-title">Color</h3>
                                </div>
                                <div class="mn-sb-block-content">
                                    <ul>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#c4d6f9;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#ff748b;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#000000;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li class="active">
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#2bff4a;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#ff7c5e;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#f155ff;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#ffef00;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#c89fff;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#7bfffa;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#56ffc1;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#ffdb9f;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#9f9f9f;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mn-sidebar-block-item">
                                                <input type="checkbox" value="">
                                                <span class="mn-clr-block"
                                                      style="background-color:#6556ff;"></span>
                                                <span class="checked"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sidebar Price Block -->
                            <div class="mn-sidebar-block">
                                <div class="mn-sb-title">
                                    <h3 class="mn-sidebar-title">Price</h3>
                                </div>
                                <div class="mn-sb-block-content mn-price-range-slider es-price-slider">
                                    <div class="mn-price-filter">
                                        <div class="mn-price-input">
                                            <label class="filter__label">
                                                From<input type="text" class="filter__input">
                                            </label>
                                            <span class="mn-price-divider"></span>
                                            <label class="filter__label">
                                                To<input type="text" class="filter__input">
                                            </label>
                                        </div>
                                        <div id="mn-sliderPrice" class="filter__slider-price" data-min="0"
                                             data-max="250" data-step="10"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar tags -->
                            <div class="mn-sidebar-block">
                                <div class="mn-sb-title">
                                    <h3 class="mn-sidebar-title">Tags</h3>
                                </div>
                                <div class="mn-tag-block mn-sb-block-content">
                                    <a href="shop-right-sidebar.html"><span>Clothes</span></a>
                                    <a href="shop-right-sidebar.html"><span>Fruits</span></a>
                                    <a href="shop-right-sidebar.html"><span>Snacks</span></a>
                                    <a href="shop-right-sidebar.html"><span>Dairy</span></a>
                                    <a href="shop-right-sidebar.html"><span>Seafood</span></a>
                                    <a href="shop-right-sidebar.html"><span>Fastfood</span></a>
                                    <a href="shop-right-sidebar.html"><span>Toys</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mn-shop-rightside col-md-12 m-t-991">
                    <!-- Shop Top Start -->
                    <div class="mn-pro-list-top d-flex">
                        <div class="col-md-6 mn-grid-list"></div>
                        <div class="col-md-6 mn-sort-select">
                            <div class="mn-select-inner">
                                <select name="mn-select" id="mn-select">
                                    <option selected disabled>Sort by</option>
                                    <option value="1">Position</option>
                                    <option value="2">Relevance</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->


                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 m-b-24 mn-product-box pro-gl-content">
                                    <div class="mn-product-card">
                                        <div class="mn-product-img">
                                            <div class="mn-img">
                                                <a href="/produit/{{ $product['code_product'] }}" class="image">
                                                    <img class="main-img" src="{{ env('IMAGES_PATH') }}/{{ $product['picture'] }}" alt="product">
                                                    <img class="hover-img" src="{{ env('IMAGES_PATH') }}/{{ $product['picture'] }}" alt="product">
                                                </a>
                                                <div class="mn-pro-loader"></div>
                                            </div>
                                        </div>
                                        <div class="mn-product-detail">
                                            <div class="cat">
                                                <a href="/produit/{{ $product['code_product'] }}">{{ $product['category']}}</a>
                                            </div>
                                            <h5><a href="">{{ $product['name']}}</a></h5>
                                            <div class="mn-price">
                                                <div class="mn-price-new">{{ number_format($product['amount'] ) }} CFA</div>
                                            </div>
                                            <div class="mn-pro-option"></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Pagination Start -->
                        <div class="mn-pro-pagination m-b-15">
                            <span>Showing 1-12 of 21 item(s)</span>
                            <ul class="mn-pro-pagination-inner">
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a class="next" href="#">Next <i class="ri-arrow-right-double-line"></i></a>
                                </li>
                            </ul>
                        </div>
                        <!-- Pagination End -->
                    </div>
                    <!--Shop content End -->

                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
<!-- calendar js-->
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>

@endsection


