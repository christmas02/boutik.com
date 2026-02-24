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
            <a href="/produits_de_categorie/{{ $product['category'] }}/{{ $product['category'] }}"
               class="text-slate-500 hover:text-blue-600 transition-colors">
                {{ $product['category'] }}
            </a>
            <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium text-slate-900 truncate max-w-[200px]">{{ $product['name'] }}</span>
        </div>
    </div>
</div>

{{-- ─── PRODUCT DETAIL ────────────────────────────────────────── --}}
<div class="section-container mt-8 mb-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 xl:gap-16">

        {{-- ── Image Gallery ────────────────── --}}
        <div x-data="{ activeImg: '{{ asset('uploads/'.$product['picture']) }}' }">
            {{-- Main image --}}
            <div class="bg-slate-50 rounded-3xl aspect-square flex items-center justify-center p-8 mb-4 overflow-hidden">
                <img :src="activeImg"
                     alt="{{ $product['name'] }}"
                     class="w-full h-full object-contain transition-opacity duration-200">
            </div>

            {{-- Thumbnails --}}
            @if(count($product['galerie']) > 0)
            <div class="flex gap-3 overflow-x-auto pb-1">
                <button @click="activeImg='{{ asset('uploads/'.$product['picture']) }}'"
                        class="shrink-0 w-16 h-16 bg-slate-50 rounded-xl overflow-hidden border-2 border-blue-600 transition-colors p-1">
                    <img src="{{ asset('uploads/'.$product['picture']) }}" alt="Principal" class="w-full h-full object-contain">
                </button>
                @foreach($product['galerie'] as $galItem)
                <button @click="activeImg='{{ asset('uploads/'.$galItem->image) }}'"
                        class="shrink-0 w-16 h-16 bg-slate-50 rounded-xl overflow-hidden border-2 border-transparent hover:border-blue-400 transition-colors p-1">
                    <img src="{{ asset('uploads/'.$galItem->image) }}" alt="" class="w-full h-full object-contain">
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- ── Product Info ─────────────────── --}}
        <div class="flex flex-col justify-center">
            {{-- Category + Badge --}}
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm text-blue-600 font-semibold bg-blue-50 px-3 py-1 rounded-full">
                    {{ $product['category'] }}
                </span>
                @if($product['typeachat'] === 'DISPO')
                <span class="text-xs font-semibold text-green-700 bg-green-100 px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full inline-block"></span>
                    En stock
                </span>
                @elseif($product['typeachat'] === 'PRE_COM')
                <span class="text-xs font-semibold text-amber-700 bg-amber-100 px-3 py-1 rounded-full flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full inline-block"></span>
                    Pré-commande
                </span>
                @endif
            </div>

            {{-- Name --}}
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 leading-snug mb-4">
                {{ $product['name'] }}
            </h1>

            {{-- Price --}}
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-3xl font-bold text-blue-600">
                    {{ number_format($product['amount'], 0, ',', ' ') }}
                </span>
                <span class="text-slate-500 font-medium">XOF</span>
            </div>

            {{-- Description --}}
            @if($product['description'])
            <div class="prose prose-sm text-slate-600 leading-relaxed mb-8 border-t border-slate-100 pt-6">
                {!! $product['description'] !!}
            </div>
            @endif

            {{-- Add to Cart --}}
            @if($product['typeachat'] === 'DISPO')
            <div class="border-t border-slate-100 pt-6">
                <div class="flex items-center gap-3 mb-4">
                    <label class="text-sm font-medium text-slate-700">Quantité :</label>
                    <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden">
                        <button type="button"
                                onclick="const el=document.getElementById('quantity'); if(parseInt(el.value)>1) el.value=parseInt(el.value)-1"
                                class="w-10 h-10 flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                               class="w-14 h-10 text-center text-sm font-semibold border-x border-slate-200 focus:outline-none">
                        <button type="button"
                                onclick="const el=document.getElementById('quantity'); el.value=parseInt(el.value)+1"
                                class="w-10 h-10 flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <input type="hidden" id="product-id" value="{{ $product['id'] }}">
                <button id="addcart"
                        class="btn-primary w-full sm:w-auto text-base px-8 py-3.5">
                    <svg class="mr-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Ajouter au panier
                </button>
            </div>
            @elseif($product['typeachat'] === 'PRE_COM')
            <div class="border-t border-slate-100 pt-6">
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-4">
                    <p class="text-sm text-amber-800 font-medium">
                        Ce produit est en pré-commande. Contactez-nous via WhatsApp pour réserver.
                    </p>
                </div>
                <a href="https://wa.me/2250565121084?text=Je+souhaite+pré-commander+{{ urlencode($product['name']) }}"
                   target="_blank"
                   class="btn-primary bg-green-500 hover:bg-green-600 w-full sm:w-auto text-base px-8 py-3.5">
                    <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.127 1.533 5.861L0 24l6.335-1.64A11.942 11.942 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.687-.5-5.232-1.377L2.5 21.5l.896-4.17A9.952 9.952 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                    </svg>
                    Pré-commander via WhatsApp
                </a>
            </div>
            @endif

            {{-- Reference --}}
            <p class="text-xs text-slate-400 mt-4">Référence : {{ $product['code_product'] }}</p>
        </div>
    </div>
</div>

@endsection
