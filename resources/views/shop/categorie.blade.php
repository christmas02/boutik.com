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
            @include('layouts.simple.banner')

            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="filter-sidebar-overlay"></div>
                <div class="mn-shop-sidebar mn-filter-sidebar col-lg-3 col-md-12">

                </div>
                <div class="mn-shop-rightside col-md-12 m-t-991">
                    <!-- Shop Top Start -->
                    <div class="mn-pro-list-top d-flex">
                        <div class="col-md-6 mn-grid-list"></div>
                        <div class="col-md-6 mn-sort-select">
                            <div class="mn-select-inner">
                                <select name="mn-select" id="mn-select">
                                    @foreach($sousCategory as $item)
                                    <option> <a href="/produits_de_sous_categorie/{{ $item->id }}/{{ $item->name }}"> {{ $item->name }} </a> </option>
                                    @endforeach
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
                                                    <img class="main-img" src="{{asset('uploads/'.$product['picture']) }}" alt="product">
                                                    <img class="hover-img" src="{{asset('uploads/'.$product['picture']) }}"  alt="product">
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


