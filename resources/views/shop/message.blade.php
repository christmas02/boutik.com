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
                        @if(isset($success))
                        <p style="text-align: center; font-size: 30px; margin: 40px 0px; font-family: Helvetica Neue, Arial, Helvetica, sans-serif; font-weight: bold">
                            {{ $success }}
                        </p>
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


