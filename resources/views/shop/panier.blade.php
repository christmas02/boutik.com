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
                    <h2 class="mn-breadcrumb-title">Cart Page</h2>
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- mn-breadcrumb-list start -->
                    <ul class="mn-breadcrumb-list">
                        <li class="mn-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="mn-breadcrumb-item active">Cart Page</li>
                    </ul>
                    <!-- mn-breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart section -->
<section class="mn-cart-section p-b-15">
    <h2 class="d-none">Cart Page</h2>
    <div class="row">
        <div class="mn-cart-leftside col-lg-8 col-md-12">
            <!-- cart content Start -->
            <div class="mn-cart-content">
                <div class="mn-cart-inner cart_list">
                    <div class="row">
                        <form action="#">
                            <div class="table-content cart-table-content">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th style="text-align: center;">Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="mn-cart-product">
                                        <td data-label="Product" class="mn-cart-pro-name">
                                            <a href="product-detail.html">
                                                <img class="mn-cart-pro-img"
                                                     src="assets/img/product/11.jpg" alt="">Mantu smart
                                                watch
                                            </a>
                                        </td>
                                        <td data-label="Price" class="mn-cart-pro-price">
                                            <span class="amount">$516.00</span>
                                        </td>
                                        <td data-label="Quantity" class="mn-cart-pro-qty"
                                            style="text-align: center;">
                                            <div class="cart-qty-plus-minus">
                                                <input class="cart-plus-minus" type="text"
                                                       name="cartqtybutton" value="1">
                                            </div>
                                        </td>
                                        <td data-label="Total" class="mn-cart-pro-subtotal">$516.00
                                        </td>
                                        <td data-label="Remove" class="mn-cart-pro-remove">
                                            <a href="#"><i class="ri-delete-bin-line"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="mn-cart-product">
                                        <td data-label="Product" class="mn-cart-pro-name">
                                            <a href="product-detail.html">
                                                <img class="mn-cart-pro-img"
                                                     src="assets/img/product/15.jpg" alt="">Leather bag
                                            </a>
                                        </td>
                                        <td data-label="Price" class="mn-cart-pro-price">
                                            <span class="amount">$75.00</span>
                                        </td>
                                        <td data-label="Quantity" class="mn-cart-pro-qty"
                                            style="text-align: center;">
                                            <div class="cart-qty-plus-minus">
                                                <input class="cart-plus-minus" type="text"
                                                       name="cartqtybutton" value="1">
                                            </div>
                                        </td>
                                        <td data-label="Total" class="mn-cart-pro-subtotal">$75.00
                                        </td>
                                        <td data-label="Remove" class="mn-cart-pro-remove">
                                            <a href="#"><i class="ri-delete-bin-line"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="mn-cart-product">
                                        <td data-label="Product" class="mn-cart-pro-name"><a
                                                href="product-detail.html">
                                                <img class="mn-cart-pro-img"
                                                     src="assets/img/product/21.jpg" alt="">Cotton fabric
                                                T-shirt
                                            </a>
                                        </td>
                                        <td data-label="Price" class="mn-cart-pro-price">
                                            <span class="amount">$48.00</span>
                                        </td>
                                        <td data-label="Quantity" class="mn-cart-pro-qty"
                                            style="text-align: center;">
                                            <div class="cart-qty-plus-minus">
                                                <input class="cart-plus-minus" type="text"
                                                       name="cartqtybutton" value="1">
                                            </div>
                                        </td>
                                        <td data-label="Total" class="mn-cart-pro-subtotal">$48.00
                                        </td>
                                        <td data-label="Remove" class="mn-cart-pro-remove">
                                            <a href="#"><i class="ri-delete-bin-line"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="mn-cart-product">
                                        <td data-label="Product" class="mn-cart-pro-name"><a
                                                href="product-detail.html">
                                                <img class="mn-cart-pro-img"
                                                     src="assets/img/product/9.jpg" alt="">Special sport
                                                shoes
                                            </a>
                                        </td>
                                        <td data-label="Price" class="mn-cart-pro-price">
                                            <span class="amount">$95.00</span>
                                        </td>
                                        <td data-label="Quantity" class="mn-cart-pro-qty"
                                            style="text-align: center;">
                                            <div class="cart-qty-plus-minus">
                                                <input class="cart-plus-minus" type="text"
                                                       name="cartqtybutton" value="1">
                                            </div>
                                        </td>
                                        <td data-label="Total" class="mn-cart-pro-subtotal">$95.00
                                        </td>
                                        <td data-label="Remove" class="mn-cart-pro-remove">
                                            <a href="#"><i class="ri-delete-bin-line"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12">
                                <div class="mn-cart-update-bottom">
                                    <a href="#">Continue Shopping</a>
                                    <button class="mn-btn-2"><span>Check Out</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--cart content End -->
        </div>
        <!-- Sidebar Area Start -->
        <div class="mn-cart-rightside col-lg-4 col-md-12 m-t-991">
            <div class="mn-sidebar-wrap">
                <!-- Sidebar Summary Block -->
                <div class="mn-sidebar-block">
                    <div class="mn-sb-title">
                        <h3 class="mn-sidebar-title">Summary</h3>
                    </div>
                    <div class="mn-sb-block-content">
                        <div class="mn-cart-form">
                            <p>Enter your destination to get a shipping estimate</p>
                            <form action="#" method="post">
											<span class="mn-cart-wrap">
												<label>Country *</label>
												<span class="mn-cart-select-inner">
													<select name="gi_cart_country" id="mn-cart-select-country"
                                                            class="mn-cart-select">
														<option selected="" disabled="">United States</option>
														<option value="1">Country 1</option>
														<option value="2">Country 2</option>
														<option value="3">Country 3</option>
														<option value="4">Country 4</option>
														<option value="5">Country 5</option>
													</select>
												</span>
											</span>
                                <span class="mn-cart-wrap">
												<label>State/Province</label>
												<span class="mn-cart-select-inner">
													<select name="gi_cart_state" id="mn-cart-select-state"
                                                            class="mn-cart-select">
														<option selected="" disabled="">Please Select a region,
															state
														</option>
														<option value="1">Region/State 1</option>
														<option value="2">Region/State 2</option>
														<option value="3">Region/State 3</option>
														<option value="4">Region/State 4</option>
														<option value="5">Region/State 5</option>
													</select>
												</span>
											</span>
                                <span class="mn-cart-wrap">
												<label>Zip/Postal Code</label>
												<input type="text" name="postalcode" placeholder="Zip/Postal Code">
											</span>
                            </form>
                        </div>
                    </div>

                    <div class="mn-sb-block-content">
                        <div class="mn-cart-summary-bottom">
                            <div class="mn-cart-summary">
                                <div>
                                    <span class="text-left">Sub-Total</span>
                                    <span class="text-right">$734.00</span>
                                </div>
                                <div>
                                    <span class="text-left">Delivery Charges</span>
                                    <span class="text-right">$80.00</span>
                                </div>
                                <div>
                                    <span class="text-left">Coupan Discount</span>
                                    <span class="text-right"><a class="mn-cart-coupan">Apply
														Coupan</a></span>
                                </div>
                                <div class="mn-cart-coupan-content">
                                    <form class="mn-cart-coupan-form" name="mn-cart-coupan-form"
                                          method="post" action="#">
                                        <input class="mn-coupan" type="text" required=""
                                               placeholder="Enter Your Coupan Code" name="mn-coupan" value="">
                                        <button class="mn-btn-2" type="submit" name="subscribe"
                                                value=""><span>Apply</span></button>
                                    </form>
                                </div>
                                <div class="mn-cart-summary-total">
                                    <span class="text-left">Total Amount</span>
                                    <span class="text-right">$814.00</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<!-- calendar js-->
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>

@endsection


