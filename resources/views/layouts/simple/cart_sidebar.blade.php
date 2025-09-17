<div class="mn-side-cart-overlay"></div>
<div id="mn-side-cart" class="mn-side-cart">
    <div class="mn-cart-inner">
        <div class="mn-cart-top">
            <div class="mn-cart-title">
                <span class="cart_title">Mon panier</span>
                <a href="javascript:void(0)" class="mn-cart-close">
                    <i class="ri-close-line"></i>
                </a>
            </div>
            <ul class="mn-cart-pro-items">
                @foreach ($content as $item)
                <li class="cart-sidebar-list">
                    <a href="/" class="mn-pro-img"><img src="{{asset('uploads/'.$item->picture ) }}" alt="{{ $item->picture }}"></a>
                    <div class="mn-pro-content">
                        <a href="" class="cart-pro-title">{{ $item['name'] }}</a>
                        <span class="cart-price"><span>{{ number_format($item->price, 0, ',', ' ') }} XOF</span> x {{ $item->quantity }}</span>
                        <div class="qty-plus-minus">
                            <input class="qty-input" type="text" name="mn-qtybtn" value="1">
                        </div>
                        <a href="javascript:void(0)" class="cart-remove-item">×</a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="mn-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                    <tr>
                        <td class="text-left">Sous-Total :</td>
                        <td class="text-right">{{ number_format($cartTotal) }} XOF</td>
                    </tr>
                    <tr>
                        <td class="text-left">TVA (0%) :</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-left">Total :</td>
                        <td class="text-right primary-color">{{ number_format($cartTotal) }} XOF</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="{{ route('cart') }}" class="mn-btn-2"><span>Voir mon panier<i class="ri-arrow-right-s-line"></i></span></a>
            </div>
        </div>
    </div>
</div>
