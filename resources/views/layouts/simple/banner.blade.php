<div class="m-b-30">
    <div class="row">
        @if($categorie == 'Parfumerie')
        <div class="col-md-6">
            <div class="mn-ofr-banners">
                <div class="mn-bnr-body">
                    <div class="mn-bnr-img">
                        <img src="{{ asset('assets/img/banner/5.jpg') }}" alt="banner">
                    </div>
                    <div class="mn-bnr-detail">
                        <h5>Best men's fashion sale</h5>
                        <p>Stylish Design of clothes.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mn-ofr-banners m-t-767">
                <div class="mn-bnr-body">
                    <div class="mn-bnr-img">
                        <img src="{{ asset('assets/img/banner/6.jpg') }}" alt="banner">
                    </div>
                    <div class="mn-bnr-detail">
                        <h5>Trending women's sale</h5>
                        <p>Trending desings of clothes.</p>
                    </div>
                </div>
            </div>
        </div>
        @else
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
        @endif
    </div>
</div>
