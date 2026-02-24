@extends('layouts.tailwind.master')

@section('main_content')

<div class="section-container mt-16 mb-24 flex flex-col items-center justify-center text-center">

    {{-- Icône succès --}}
    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-6">
        <svg class="w-12 h-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
    </div>

    {{-- Titre --}}
    <h1 class="text-3xl font-bold text-slate-900 mb-3">Commande confirmée !</h1>

    {{-- Message dynamique ou fallback --}}
    @if(isset($success))
    <p class="text-slate-500 text-base max-w-md leading-relaxed mb-8">
        {{ $success }}
    </p>
    @else
    <p class="text-slate-500 text-base max-w-md leading-relaxed mb-8">
        Votre commande a bien été enregistrée. Vous recevrez un e-mail de confirmation avec les détails de votre commande.
    </p>
    @endif

    {{-- Info box --}}
    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 max-w-md text-left mb-10">
        <h3 class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Prochaines étapes
        </h3>
        <ul class="space-y-2 text-sm text-blue-800">
            <li class="flex items-start gap-2">
                <span class="mt-0.5 text-blue-400">✓</span>
                Vérifiez votre e-mail pour la confirmation de commande.
            </li>
            <li class="flex items-start gap-2">
                <span class="mt-0.5 text-blue-400">✓</span>
                Nos équipes vous contacteront via WhatsApp pour organiser la livraison.
            </li>
            <li class="flex items-start gap-2">
                <span class="mt-0.5 text-blue-400">✓</span>
                Livraison assurée dans tout Abidjan.
            </li>
        </ul>
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap justify-center gap-3">
        <a href="/" class="btn-primary">
            <svg class="mr-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Retour à l'accueil
        </a>
        <a href="/produits_de_categorie/3/Parfumerie" class="btn-outline-blue">
            Continuer mes achats
        </a>
    </div>

</div>

@endsection
