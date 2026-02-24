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
            <span class="font-medium text-slate-900">Mon panier</span>
        </div>
    </div>
</div>

<div class="section-container mt-8 mb-16">
    <h1 class="text-2xl font-bold text-slate-900 mb-8">Mon panier</h1>

    @if(count($content) === 0)
    {{-- ─── EMPTY CART ─────────────────────── --}}
    <div class="flex flex-col items-center justify-center py-20 text-center">
        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
            <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <h2 class="text-xl font-semibold text-slate-700 mb-2">Votre panier est vide</h2>
        <p class="text-slate-400 mb-8">Découvrez nos produits et ajoutez-en à votre panier.</p>
        <a href="/" class="btn-primary">Continuer mes achats</a>
    </div>

    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ─── CART ITEMS ──────────────────── --}}
        <div class="lg:col-span-2 space-y-3">
            @foreach($content as $item)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex items-center gap-4">
                {{-- Image --}}
                <div class="w-20 h-20 bg-slate-50 rounded-xl overflow-hidden shrink-0">
                    <img src="{{ asset('uploads/'.$item->picture) }}"
                         alt="{{ $item->name }}"
                         class="w-full h-full object-cover">
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-slate-900 text-sm truncate">{{ $item->name }}</h3>
                    <p class="text-blue-600 font-bold text-sm mt-0.5">
                        {{ number_format($item->price, 0, ',', ' ') }} XOF
                    </p>
                </div>

                {{-- Quantity --}}
                <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden shrink-0">
                    <button type="button"
                            onclick="const el=document.getElementById('quantity_{{ $item->id }}'); if(parseInt(el.value)>1){el.value=parseInt(el.value)-1; el.dispatchEvent(new Event('change'))}"
                            class="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-colors text-lg leading-none">
                        −
                    </button>
                    <input type="number" id="quantity_{{ $item->id }}" name="quantity"
                           value="{{ $item->quantity }}" min="1"
                           onchange="updateQuantity(event, {{ $item->id }})"
                           class="w-10 h-8 text-center text-sm font-semibold border-x border-slate-200 focus:outline-none">
                    <button type="button"
                            onclick="const el=document.getElementById('quantity_{{ $item->id }}'); el.value=parseInt(el.value)+1; el.dispatchEvent(new Event('change'))"
                            class="w-8 h-8 flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-colors text-lg leading-none">
                        +
                    </button>
                </div>

                {{-- Subtotal --}}
                <div class="text-right shrink-0 min-w-[90px]">
                    <p class="text-xs text-slate-400 mb-0.5">Total</p>
                    <p id="subtotal_{{ $item->id }}" class="font-bold text-slate-900 text-sm">
                        {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} Fr CFA
                    </p>
                </div>

                {{-- Delete --}}
                <button data-delete-product="{{ $item->id }}"
                        class="p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
            @endforeach

            {{-- Continue shopping --}}
            <a href="/" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 font-medium mt-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Continuer mes achats
            </a>
        </div>

        {{-- ─── ORDER SUMMARY ───────────────── --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                <h2 class="font-bold text-slate-900 text-lg mb-6">Résumé</h2>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Sous-total</span>
                        <span class="font-medium text-slate-900">{{ number_format($prixTotal, 0, ',', ' ') }} XOF</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Livraison</span>
                        <span class="text-slate-500 italic">À la charge du client</span>
                    </div>
                    <div class="border-t border-slate-100 pt-3 flex justify-between">
                        <span class="font-semibold text-slate-900">Total</span>
                        <span class="font-bold text-blue-600 text-lg">{{ number_format($prixTotal, 0, ',', ' ') }} XOF</span>
                    </div>
                </div>

                <a href="/valide_panier" class="btn-primary w-full text-center mb-3">
                    Valider ma commande
                    <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <div class="flex items-center gap-2 text-xs text-slate-400 justify-center mt-4">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Commande 100% sécurisée
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
