{{-- Cart Sidebar --}}
<div
    class="fixed right-0 top-0 h-full w-80 bg-white shadow-2xl z-50 flex flex-col transform transition-transform duration-300 ease-in-out"
    :class="cartOpen ? 'translate-x-0' : 'translate-x-full'"
>
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <h3 class="font-semibold text-slate-900">Mon panier
                @if($cartCount > 0)
                <span class="ml-1 text-sm text-slate-500">({{ $cartCount }})</span>
                @endif
            </h3>
        </div>
        <button @click="cartOpen = false" class="p-1.5 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Cart items --}}
    <div class="flex-1 overflow-y-auto px-5 py-4">
        @forelse($content as $item)
        <div class="flex gap-3 mb-4 pb-4 border-b border-slate-50 last:border-0 last:mb-0 last:pb-0">
            <div class="w-16 h-16 bg-slate-50 rounded-xl overflow-hidden shrink-0">
                <img src="{{ asset('uploads/'.$item->picture) }}"
                     alt="{{ $item->name }}"
                     class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-slate-900 truncate">{{ $item->name }}</p>
                <p class="text-sm font-bold text-blue-600 mt-0.5">{{ number_format($item->price, 0, ',', ' ') }} XOF</p>
                <p class="text-xs text-slate-400 mt-0.5">Qté : {{ $item->quantity }}</p>
            </div>
            <button data-delete-product="{{ $item->id }}"
                    class="self-start p-1 text-slate-300 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @empty
        <div class="flex flex-col items-center justify-center h-full py-12 text-center">
            <svg class="w-12 h-12 text-slate-200 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <p class="text-slate-400 text-sm">Votre panier est vide</p>
            <a href="/" @click="cartOpen = false" class="mt-3 text-sm text-blue-600 hover:underline font-medium">
                Continuer mes achats
            </a>
        </div>
        @endforelse
    </div>

    {{-- Footer --}}
    @if($cartCount > 0)
    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50">
        <div class="flex justify-between items-center mb-4">
            <span class="text-sm text-slate-600">Total</span>
            <span class="font-bold text-slate-900 text-lg">{{ number_format($cartTotal, 0, ',', ' ') }} XOF</span>
        </div>
        <a href="{{ route('cart') }}"
           @click="cartOpen = false"
           class="btn-primary w-full text-center">
            Voir mon panier
            <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    @endif
</div>
