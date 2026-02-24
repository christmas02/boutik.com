@extends('layouts.tailwind.master')

@section('main_content')

{{-- ─── HERO ──────────────────────────────────────────────────── --}}
<section class="section-container mt-6 mb-10">
    <div class="relative bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl overflow-hidden min-h-[340px] flex items-center">
        {{-- Decorative circles --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/3 translate-x-1/3"></div>
        <div class="absolute bottom-0 right-20 w-40 h-40 bg-white/5 rounded-full translate-y-1/3"></div>
        <div class="absolute top-1/2 right-12 w-20 h-20 bg-white/10 rounded-full -translate-y-1/2"></div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8 px-8 py-12 md:px-14 w-full">
            {{-- Text --}}
            <div class="flex flex-col justify-center">
                <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 w-fit">
                    ✦ Nouvelle collection
                </span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                    Sublimez votre<br>quotidien avec<br>
                    <span class="text-blue-200">nos parfums</span>
                </h1>
                <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 max-w-sm">
                    Découvrez une sélection exclusive de parfums et produits de beauté. Des fragrances uniques pour chaque moment.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="/produits_de_categorie/3/Parfumerie" class="btn-primary bg-white !text-blue-600 hover:bg-blue-50">
                        Découvrir
                        <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="#categories" class="btn-outline-white">
                        Nos catégories
                    </a>
                </div>
            </div>

            {{-- Hero image --}}
            <div class="hidden md:flex items-end justify-center">
                <img src="{{ asset('assets/img/banner/parfums/1.png') }}"
                     alt="Parfums Boutik17"
                     class="max-h-72 object-contain drop-shadow-2xl"
                     onerror="this.style.display='none'">
            </div>
        </div>
    </div>
</section>

{{-- ─── FEATURED PRODUCTS ─────────────────────────────────────── --}}
@if(!empty($featuredProducts))
<section class="section-container mb-14">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Produits Vedettes</h2>
            <p class="text-sm text-slate-500 mt-1">Nos meilleures ventes du moment</p>
        </div>
        <a href="/produits_de_categorie/3/Parfumerie"
           class="hidden sm:flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors">
            Voir tout
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($featuredProducts as $product)
        <a href="/produit/{{ $product['code_product'] }}" class="product-card">
            <div class="bg-slate-50 aspect-square flex items-center justify-center p-6 group-hover:bg-slate-100 transition-colors">
                <img src="{{ asset('uploads/'.$product['picture']) }}"
                     alt="{{ $product['name'] }}"
                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-5">
                <p class="text-xs text-slate-400 uppercase tracking-wide font-medium mb-1">{{ $product['category'] }}</p>
                <h3 class="font-semibold text-slate-900 text-sm mb-2 line-clamp-2">{{ $product['name'] }}</h3>
                <p class="text-blue-600 font-bold">{{ number_format($product['amount'], 0, ',', ' ') }} XOF</p>
            </div>
        </a>
        @endforeach
    </div>

    <div class="sm:hidden text-center mt-5">
        <a href="/produits_de_categorie/3/Parfumerie" class="btn-outline-blue text-sm px-5 py-2.5">
            Voir tous les produits
        </a>
    </div>
</section>
@endif

{{-- ─── SHOP BY CATEGORY ──────────────────────────────────────── --}}
<section id="categories" class="section-container mb-14">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Nos Catégories</h2>
            <p class="text-sm text-slate-500 mt-1">Explorez par univers</p>
        </div>
    </div>

    @php
        $categoryColors = ['bg-blue-50', 'bg-purple-50', 'bg-rose-50', 'bg-amber-50', 'bg-teal-50', 'bg-emerald-50'];
        $categoryAccents = ['text-blue-600', 'text-purple-600', 'text-rose-600', 'text-amber-600', 'text-teal-600', 'text-emerald-600'];
        $categoryHovers = ['hover:bg-blue-100', 'hover:bg-purple-100', 'hover:bg-rose-100', 'hover:bg-amber-100', 'hover:bg-teal-100', 'hover:bg-emerald-100'];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($categories as $i => $categorie)
        @php
            $colorBg = $categoryColors[$i % count($categoryColors)];
            $colorText = $categoryAccents[$i % count($categoryAccents)];
            $colorHover = $categoryHovers[$i % count($categoryHovers)];
        @endphp
        <a href="/produits_de_categorie/{{ $categorie->id }}/{{ $categorie->name }}"
           class="category-card {{ $colorBg }} {{ $colorHover }} block">
            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $categorie->name }}</h3>
            <p class="text-sm text-slate-500 mb-4 leading-relaxed">
                Découvrez toute notre collection {{ strtolower($categorie->name) }}.
            </p>
            <span class="inline-flex items-center gap-1 text-sm font-semibold {{ $colorText }}">
                Voir la catégorie
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        </a>
        @endforeach
    </div>
</section>

{{-- ─── FEATURES ───────────────────────────────────────────────── --}}
<section class="bg-slate-50 py-16 mb-0">
    <div class="section-container text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">
            Expérience Boutik17
        </h2>
        <p class="text-slate-500 mb-12">Simple, rapide et sécurisé</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            {{-- Livraison --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 border-2 border-slate-200 rounded-2xl flex items-center justify-center mb-4 bg-white">
                    <svg class="w-7 h-7 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-slate-900 mb-2">Livraison Rapide</h3>
                <p class="text-sm text-slate-500 leading-relaxed max-w-xs">
                    Livraison dans tout Abidjan. Recevez vos commandes directement chez vous.
                </p>
            </div>

            {{-- Click & Collect --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 border-2 border-slate-200 rounded-2xl flex items-center justify-center mb-4 bg-white">
                    <svg class="w-7 h-7 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-slate-900 mb-2">Commande Facile</h3>
                <p class="text-sm text-slate-500 leading-relaxed max-w-xs">
                    Commandez en quelques clics et suivez votre colis en temps réel.
                </p>
            </div>

            {{-- Garantie --}}
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 border-2 border-slate-200 rounded-2xl flex items-center justify-center mb-4 bg-white">
                    <svg class="w-7 h-7 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-slate-900 mb-2">Produits Authentiques</h3>
                <p class="text-sm text-slate-500 leading-relaxed max-w-xs">
                    100% originaux, sélectionnés avec soin. Satisfaction garantie ou remboursé.
                </p>
            </div>
        </div>

        <a href="/produits_de_categorie/3/Parfumerie" class="btn-primary inline-flex">
            Commander maintenant
        </a>
    </div>
</section>

@endsection
