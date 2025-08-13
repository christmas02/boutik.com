<div class="mn-menu-title">
    <span class="menu_title">Navigation</span>
    <button type="button" class="mn-close-menu">×</button>
</div>
<div class="mn-menu-inner">
    <div class="mn-menu-content">
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a href="javascript:void(0)">Categories</a>
                <ul class="sub-menu">
                    @foreach($categories as $categorie)
                    <li><a href="/produits_de_categorie/{{ $categorie->id }}/{{ $categorie->name }}">{{ $categorie->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li >
                <a href="{{ route('cart') }}">Panier </a>
            </li>
            <li >
                <a href="">Contact </a>
            </li>
        </ul>
    </div>
</div>
