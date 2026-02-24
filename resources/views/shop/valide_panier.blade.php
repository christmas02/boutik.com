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
            <a href="{{ route('cart') }}" class="text-slate-500 hover:text-blue-600 transition-colors">Panier</a>
            <svg class="w-3 h-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium text-slate-900">Validation</span>
        </div>
    </div>
</div>

{{-- ─── Steps indicator ────────────────────────────────────────── --}}
<div class="section-container mt-6">
    <div class="flex items-center gap-3 text-sm">
        <div class="flex items-center gap-2 text-slate-400">
            <span class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold">✓</span>
            <span>Panier</span>
        </div>
        <div class="flex-1 h-px bg-slate-200"></div>
        <div class="flex items-center gap-2 text-blue-600 font-semibold">
            <span class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">2</span>
            <span>Informations</span>
        </div>
        <div class="flex-1 h-px bg-slate-200"></div>
        <div class="flex items-center gap-2 text-slate-400">
            <span class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold">3</span>
            <span>Confirmation</span>
        </div>
    </div>
</div>

<div class="section-container mt-8 mb-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ─── CUSTOMER FORM ───────────────────── --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Vos informations
                </h2>

                <form action="/valide_commande" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Nom <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="username" placeholder="Doe" required
                                   class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Prénom <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="firstname" placeholder="John" required
                                   class="input-field">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Adresse e-mail
                            </label>
                            <input type="email" name="email" placeholder="john@exemple.com"
                                   class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">
                                Numéro WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" placeholder="07 00 00 00 00" required
                                   class="input-field">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Lieu de livraison <span class="text-red-500">*</span>
                        </label>
                        <textarea name="livraison" required rows="3"
                                  placeholder="Ex: Cocody Angré, en face du CHU, immeuble résidence..."
                                  class="input-field resize-none"></textarea>
                        <p class="text-xs text-slate-400 mt-1">Précisez la commune, le quartier et un point de repère.</p>
                    </div>

                    {{-- Info box --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
                        <p class="text-sm text-blue-800">
                            <strong>Important :</strong> Vous recevrez un e-mail de confirmation avec le détail de votre commande. Nos équipes vous contacteront via WhatsApp pour coordonner la livraison.
                        </p>
                    </div>

                    <button type="submit"
                            class="btn-primary w-full text-base py-4">
                        <svg class="mr-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Confirmer ma commande
                    </button>
                </form>
            </div>
        </div>

        {{-- ─── ORDER SUMMARY ───────────────── --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                <h3 class="font-bold text-slate-900 mb-5">Résumé de commande</h3>

                {{-- Items --}}
                <div class="space-y-3 mb-5">
                    @foreach($content as $item)
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-slate-50 rounded-xl overflow-hidden shrink-0">
                            <img src="{{ asset('uploads/'.$item->picture) }}"
                                 alt="{{ $item->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-700 truncate">{{ $item->name }}</p>
                            <p class="text-xs text-slate-400">× {{ $item->quantity }}</p>
                        </div>
                        <p class="text-xs font-semibold text-slate-900 shrink-0">
                            {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} XOF
                        </p>
                    </div>
                    @endforeach
                </div>

                {{-- Totals --}}
                <div class="border-t border-slate-100 pt-4 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Sous-total</span>
                        <span class="font-medium">{{ number_format($total, 0, ',', ' ') }} XOF</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Livraison</span>
                        <span class="text-slate-400 text-xs">À la charge du client</span>
                    </div>
                    <div class="flex justify-between font-bold text-base pt-2 border-t border-slate-100">
                        <span class="text-slate-900">Total</span>
                        <span class="text-blue-600">{{ number_format($total, 0, ',', ' ') }} XOF</span>
                    </div>
                </div>

                {{-- Security badge --}}
                <div class="flex items-center gap-2 text-xs text-slate-400 mt-4 justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Commande sécurisée
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
