<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Boutik17 - Parfums et produits de beauté en ligne. Livraison Abidjan.">
    <title>Boutik17 – eCommerce</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class="font-sans bg-white text-slate-900" x-data="{ cartOpen: false, mobileMenuOpen: false }">

    {{-- Header --}}
    @include('layouts.tailwind.header')

    {{-- Cart Sidebar --}}
    @include('layouts.tailwind.cart_sidebar')

    {{-- Overlay --}}
    <div
        x-show="cartOpen || mobileMenuOpen"
        x-on:click="cartOpen = false; mobileMenuOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 z-40"
        style="display:none"
    ></div>

    {{-- Flash container --}}
    <div id="flash-container" class="fixed top-5 right-5 z-[9999] space-y-2 w-80 pointer-events-none"></div>

    {{-- Main Content --}}
    <main>
        @yield('main_content')
    </main>

    {{-- Footer --}}
    @include('layouts.tailwind.footer')

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    {{-- Cart Scripts (no jQuery required) --}}
    <script>
        const _token = document.querySelector('meta[name="csrf-token"]').content;

        function showFlashMessage(message, type = 'success') {
            const container = document.getElementById('flash-container');
            const el = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            el.className = `pointer-events-auto px-4 py-3 rounded-xl shadow-lg text-sm font-medium text-white flex items-center justify-between gap-3 ${bgColor}`;
            el.innerHTML = `
                <span>${message}</span>
                <button onclick="this.parentElement.remove()" class="shrink-0 hover:opacity-75">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>`;
            container.appendChild(el);
            setTimeout(() => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = 0;
            }, 2500);
            setTimeout(() => { el.remove(); location.reload(); }, 3100);
        }

        /* ── Add to cart ─────────────────────────── */
        document.addEventListener('click', function (e) {
            if (!e.target.closest('#addcart')) return;
            e.preventDefault();
            const productId = document.getElementById('product-id')?.value;
            const quantity  = document.getElementById('quantity')?.value || 1;
            const body = new URLSearchParams({ _token, id: productId, quantity });
            fetch("{{ route('add.cart') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body.toString()
            })
            .then(r => r.json())
            .then(data => showFlashMessage(data.message))
            .catch(() => showFlashMessage('Erreur réseau', 'error'));
        });

        /* ── Delete from cart ────────────────────── */
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-delete-product]');
            if (!btn) return;
            e.preventDefault();
            const productId = btn.dataset.deleteProduct;
            const body = new URLSearchParams({ _token, id: productId });
            fetch("{{ route('delete.product') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body.toString()
            })
            .then(r => r.json())
            .then(data => showFlashMessage(data.message))
            .catch(() => showFlashMessage('Erreur réseau', 'error'));
        });

        /* ── Update quantity ─────────────────────── */
        function updateQuantity(event, productId) {
            const quantity = event.target.value;
            fetch(`/update_quantity/${productId}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _token },
                body: JSON.stringify({ quantity })
            })
            .then(r => r.json())
            .then(data => {
                const el = document.getElementById(`subtotal_${productId}`);
                if (el) el.textContent = data.newSubtotal + ' Fr CFA';
            })
            .catch(err => console.error(err));
        }
    </script>

    @stack('scripts')
</body>
</html>
