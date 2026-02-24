<footer id="contact" class="bg-slate-900 text-slate-300 mt-16">
    <div class="section-container py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            {{-- Brand --}}
            <div>
                <a href="/" class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Boutik17" class="h-8 brightness-0 invert"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                    <span style="display:none" class="text-xl font-bold text-white">Boutik17</span>
                </a>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Votre boutique en ligne de parfums et produits de beauté. Qualité et élégance livrées chez vous à Abidjan.
                </p>
            </div>

            {{-- Categories --}}
            <div>
                <h4 class="font-semibold text-white mb-4">Catégories</h4>
                <ul class="space-y-2.5">
                    @foreach($categories as $categorie)
                    <li>
                        <a href="/produits_de_categorie/{{ $categorie->id }}/{{ $categorie->name }}"
                           class="text-sm text-slate-400 hover:text-white transition-colors">
                            {{ $categorie->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-semibold text-white mb-4">Contact</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-blue-400 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm text-slate-400">Côte d'Ivoire, Abidjan</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.127 1.533 5.861L0 24l6.335-1.64A11.942 11.942 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.687-.5-5.232-1.377L2.5 21.5l.896-4.17A9.952 9.952 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                        </svg>
                        <a href="tel:+2250565121084" class="text-sm text-slate-400 hover:text-white transition-colors">
                            +225 05 65 12 10 84
                        </a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:contact@boutik17.com" class="text-sm text-slate-400 hover:text-white transition-colors">
                            contact@boutik17.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-slate-800">
        <div class="section-container py-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs text-slate-500">
                © <span id="copyright-year"></span> Boutik17. Tous droits réservés.
            </p>
            <p class="text-xs text-slate-600">Paiement sécurisé · Livraison Abidjan</p>
        </div>
    </div>
</footer>
<script>document.getElementById('copyright-year').textContent = new Date().getFullYear();</script>
