@extends('layouts.tailwind.master')

@section('main_content')

{{-- ─── BREADCRUMB ────────────────────────────────────────────── --}}
<div class="bg-slate-50 border-b border-slate-100">
    <div class="section-container py-4">
        <div class="flex items-center gap-2 text-sm">
            <a href="/" class="text-slate-500 hover:text-blue-600 transition-colors">Accueil</a>
            <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium text-slate-900">{{ $categorie }}</span>
        </div>
    </div>
</div>

{{-- ─── PAGE HEADER ────────────────────────────────────────────── --}}
<div class="section-container mt-8 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $categorie }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ count($products) }} produit(s) trouvé(s)</p>
        </div>

        {{-- Subcategory filter --}}
        @if($sousCategory && count($sousCategory) > 0)
        <div class="flex items-center gap-2">
            <label for="subcategory-filter" class="text-sm font-medium text-slate-600 shrink-0">Filtrer :</label>
            <select id="subcategory-filter"
                    onchange="window.location.href=this.value || '/produits_de_categorie/{{ $categorie_id }}/{{ $categorie }}'"
                    class="input-field w-48 text-sm py-2">
                <option value="">Toutes les sous-catégories</option>
                @foreach($sousCategory as $item)
                <option value="/produits_de_sous_categorie/{{ $item->id }}/{{ $item->name }}">
                    {{ $item->name }}
                </option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
</div>

{{-- ─── PRODUCTS GRID ──────────────────────────────────────────── --}}
<div class="section-container mb-16">
    @forelse($products as $product)
    @if($loop->first)
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-5">
    @endif

        <a href="/produit/{{ $product['code_product'] }}" class="product-card">
            <div class="bg-slate-50 aspect-square flex items-center justify-center p-4 sm:p-6 group-hover:bg-slate-100 transition-colors overflow-hidden">
                <img src="{{ asset('uploads/'.$product['picture']) }}"
                     alt="{{ $product['name'] }}"
                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                     loading="lazy">
            </div>
            <div class="p-4">
                <p class="text-xs text-slate-400 uppercase tracking-wide font-medium mb-1 truncate">
                    {{ $product['category'] }}
                </p>
                <h3 class="font-semibold text-slate-900 text-sm mb-2 line-clamp-2 leading-snug">
                    {{ $product['name'] }}
                </h3>
                <p class="text-blue-600 font-bold text-sm">
                    {{ number_format($product['amount'], 0, ',', ' ') }} XOF
                </p>
            </div>
        </a>

    @if($loop->last)
    </div>
    @endif

    @empty
    <div class="flex flex-col items-center justify-center py-20 text-center">
        <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
        </svg>
        <h3 class="font-semibold text-slate-700 mb-2">Aucun produit disponible</h3>
        <p class="text-slate-400 text-sm mb-6">Cette catégorie ne contient pas encore de produits.</p>
        <a href="/" class="btn-primary text-sm">Retour à l'accueil</a>
    </div>
    @endforelse
</div>

@endsection
