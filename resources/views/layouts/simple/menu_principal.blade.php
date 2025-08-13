<div class="nav-desk">
    <div class="row">
        <div class="col-md-12 align-self-center">
            <div class="mn-main-menu">
                <ul>
                    <li class="non-drop">
                        <a href="/">Home</a>
                    </li>
                    <li class="dropdown drop-list">
                        <a href="javascript:void(0)" class="dropdown-arrow">Categories<i
                                class="ri-arrow-down-s-line"></i></a>
                        <ul class="mega-menu d-block">
                            <li class="d-flex">
                                <span class="bg"></span>
                                <ul class="d-block mega-block">
                                    @foreach($categories as $categorie)
                                    <li style="display: inline-block; padding-left: 10px; font-size: 16px"><a href="/produits_de_categorie/{{ $categorie->id }}/{{ $categorie->name }}">{{ $categorie->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('cart') }}" class="dropdown-arrow">Panier </a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-arrow">Contact </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
