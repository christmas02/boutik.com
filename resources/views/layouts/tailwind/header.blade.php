<header class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
    <div class="section-container">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 shrink-0">
                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Boutik17" class="h-8"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <span style="display:none" class="text-xl font-bold text-blue-600">Boutik17</span>
            </a>

            {{-- Desktop navigation --}}
            <nav class="hidden md:flex items-center gap-8">
                <a href="/" class="text-sm font-medium text-slate-700 hover:text-blue-600 transition-colors">
                    Accueil
                </a>

                {{-- Categories dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 text-sm font-medium text-slate-700 hover:text-blue-600 transition-colors">
                        Catégories
                        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50"
                        style="display:none"
                    >
                        @foreach($categories as $categorie)
                        <a href="/produits_de_categorie/{{ $categorie->id }}/{{ $categorie->name }}"
                           class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors first:rounded-t-xl last:rounded-b-xl">
                            {{ $categorie->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('cart') }}" class="text-sm font-medium text-slate-700 hover:text-blue-600 transition-colors">
                    Panier
                </a>
                <a href="#contact" class="text-sm font-medium text-slate-700 hover:text-blue-600 transition-colors">
                    Contact
                </a>
            </nav>

            {{-- Right side: cart + mobile menu --}}
            <div class="flex items-center gap-3">
                {{-- Cart button --}}
                <button @click="cartOpen = true"
                        class="relative p-2 text-slate-700 hover:text-blue-600 transition-colors rounded-lg hover:bg-blue-50">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    @if($cartCount > 0)
                    <span class="absolute -top-0.5 -right-0.5 bg-blue-600 text-white text-[10px] font-bold min-w-[18px] h-[18px] flex items-center justify-center rounded-full px-1">
                        {{ $cartCount }}
                    </span>
                    @endif
                </button>

                {{-- Mobile hamburger --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 text-slate-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="md:hidden border-t border-slate-100 py-4 space-y-1"
            style="display:none"
        >
            <a href="/" class="block px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                Accueil
            </a>
            <div class="px-3 py-1 text-xs font-semibold text-slate-400 uppercase tracking-wide">Catégories</div>
            @foreach($categories as $categorie)
            <a href="/produits_de_categorie/{{ $categorie->id }}/{{ $categorie->name }}"
               class="block px-3 py-2.5 pl-6 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                {{ $categorie->name }}
            </a>
            @endforeach
            <a href="{{ route('cart') }}" class="block px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                Panier @if($cartCount > 0)<span class="ml-2 bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full">{{ $cartCount }}</span>@endif
            </a>
            <a href="#contact" class="block px-3 py-2.5 text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-colors">
                Contact
            </a>
        </div>
    </div>
</header>
