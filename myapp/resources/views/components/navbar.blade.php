<nav id="main-nav" class="glass sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12 items-center">
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="index.html" class="text-gray-900 hover:opacity-70 transition-opacity flex items-center gap-2">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.47a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.47a2 2 0 00-1.34-2.23z"/>
                    </svg>
                    <span class="font-bold tracking-widest text-sm uppercase hidden sm:block">Lumière</span>
                </a>
            </div>

            <!-- Center Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="index.html" class="text-[12px] font-normal text-gray-600 hover:text-black transition-colors uppercase tracking-wider">Home</a>
                
                <!-- Products Dropdown -->
                <div class="dropdown group">
                    <button class="text-[12px] font-normal text-gray-600 hover:text-black transition-colors flex items-center gap-1 uppercase tracking-wider">
                        Collection
                    </button>
                    <div class="dropdown-content">
                        <a href="categories.html?category=Robes" class="dropdown-item">Robes</a>
                        <a href="categories.html?category=Hauts" class="dropdown-item">Hauts</a>
                        <a href="categories.html?category=Jupes" class="dropdown-item">Jupes</a>
                        <a href="categories.html?category=Vestes Femme" class="dropdown-item">Vestes Femme</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="categories.html" class="dropdown-item font-medium">All Products</a>
                    </div>
                </div>

                <a href="about.html" class="text-[12px] font-normal text-gray-600 hover:text-black transition-colors uppercase tracking-wider">About</a>
                <a href="contact.html" class="text-[12px] font-normal text-gray-600 hover:text-black transition-colors uppercase tracking-wider">Contact</a>
            </div>

            <!-- Right icons -->
            <div class="flex items-center space-x-1">

                <!-- Search -->
                <button id="search-btn" onclick="openSearch()" class="p-2 text-gray-500 hover:text-black transition-colors rounded-lg hover:bg-gray-100" title="Search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path d="M15.5 15.5 21 21"/>
                    </svg>
                </button>

                <!-- Mini Cart Dropdown -->
                <div class="relative" id="mini-cart-wrapper">
                    <button id="mini-cart-btn" class="p-2 text-gray-500 hover:text-black transition-colors rounded-lg hover:bg-gray-100 relative" title="Cart">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                            <path d="M3 6h18"/>
                            <path d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                        <span id="cart-count" class="absolute -top-0.5 -right-0.5 inline-flex items-center justify-center w-4 h-4 text-[9px] font-bold text-white bg-black rounded-full hidden">0</span>
                    </button>

                    <!-- Dropdown Panel -->
                    <div id="mini-cart-dropdown" class="mini-cart-dropdown hidden absolute right-0 top-full mt-3 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 z-[200] overflow-hidden">
                        <!-- Header -->
                        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest">Your Cart</h3>
                            <span id="mini-cart-count-label" class="text-xs text-gray-400 font-medium">0 items</span>
                        </div>

                        <!-- Items list -->
                        <div id="mini-cart-items" class="max-h-72 overflow-y-auto divide-y divide-gray-50 px-5 py-2">
                            <div id="mini-cart-empty" class="py-10 text-center">
                                <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <p class="text-sm text-gray-400">Your cart is empty</p>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div id="mini-cart-footer" class="hidden px-5 py-4 bg-gray-50/70 border-t border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs text-gray-500 uppercase tracking-wider font-medium">Total</span>
                                <span id="mini-cart-total" class="text-base font-bold text-gray-900">0.00 MAD</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <a href="cart.html" class="w-full text-center py-2.5 rounded-xl border border-gray-300 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-all duration-200">View Cart</a>
                                <a href="checkout.html" class="w-full text-center py-2.5 rounded-xl bg-black text-white text-sm font-bold hover:bg-gray-800 transition-all duration-200 shadow-md">Checkout →</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User / Account -->
                <a href="{{ route('admin.index') }}" id="user-btn" class="p-2 text-gray-500 hover:text-black transition-colors rounded-lg hover:bg-gray-100" title="Admin Dashboard">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                </a>

                <!-- Mobile menu button -->
                <button type="button" id="mobile-menu-button" class="md:hidden p-2 text-gray-500 hover:text-black rounded-lg hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white fixed inset-0 z-[100] pt-16 px-10 space-y-8 animate-in fade-in slide-in-from-top-4 duration-300">
        <button id="close-mobile-menu" class="absolute top-4 right-6 text-gray-400">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
        <div class="flex flex-col space-y-6">
            <a href="index.html" class="text-3xl font-semibold hover:text-black">Home</a>
            <div class="space-y-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Collection</p>
                <a href="categories.html?category=Robes" class="block text-2xl font-medium ml-4 text-gray-600 hover:text-black">Robes</a>
                <a href="categories.html?category=Hauts" class="block text-2xl font-medium ml-4 text-gray-600 hover:text-black">Hauts</a>
                <a href="categories.html?category=Jupes" class="block text-2xl font-medium ml-4 text-gray-600 hover:text-black">Jupes</a>
                <a href="categories.html?category=Vestes Femme" class="block text-2xl font-medium ml-4 text-gray-600 hover:text-black">Vestes Femme</a>
            </div>
            <a href="about.html" class="text-3xl font-semibold">About</a>
            <a href="contact.html" class="text-3xl font-semibold">Contact</a>
        </div>
    </div>
</nav>

<!-- ── Search Overlay ─────────────────────────────────────────────── -->
<div id="search-overlay" class="fixed inset-0 z-[500] hidden" aria-modal="true" role="dialog">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeSearch()"></div>

    <!-- Panel -->
    <div class="relative z-10 max-w-2xl mx-auto mt-24 mx-4 px-4">
        <!-- Search input -->
        <div class="flex items-center bg-white rounded-2xl shadow-2xl px-5 py-4 gap-3">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                <circle cx="10.5" cy="10.5" r="6.5"/><path d="M15.5 15.5 21 21"/>
            </svg>
            <input id="search-input" type="text" placeholder="Rechercher un produit..." autocomplete="off"
                   class="flex-1 text-base text-gray-800 placeholder-gray-400 outline-none bg-transparent">
            <button onclick="closeSearch()" class="text-gray-400 hover:text-gray-700 transition-colors">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Results -->
        <div id="search-results" class="mt-3 bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[60vh] overflow-y-auto hidden">
            <div id="search-results-list"></div>
        </div>

        <!-- Hint -->
        <p class="text-center text-white/50 text-xs mt-4">Appuyez sur <kbd class="px-1.5 py-0.5 bg-white/20 rounded text-white font-mono">Esc</kbd> pour fermer</p>
    </div>
</div>

<script>
function openSearch() {
    document.getElementById('search-overlay').classList.remove('hidden');
    setTimeout(() => document.getElementById('search-input').focus(), 50);
}

function closeSearch() {
    document.getElementById('search-overlay').classList.add('hidden');
    document.getElementById('search-input').value = '';
    document.getElementById('search-results').classList.add('hidden');
    document.getElementById('search-results-list').innerHTML = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeSearch();
});

let searchTimer = null;
document.addEventListener('input', function(e) {
    if (e.target.id !== 'search-input') return;
    const q = e.target.value.trim();
    clearTimeout(searchTimer);

    if (q.length < 2) {
        document.getElementById('search-results').classList.add('hidden');
        return;
    }

    document.getElementById('search-results-list').innerHTML =
        '<div class="p-6 text-center text-gray-400 text-sm">Recherche...</div>';
    document.getElementById('search-results').classList.remove('hidden');

    searchTimer = setTimeout(() => {
        $.ajax({
            url: window.location.origin + '/api/products',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const products = Array.isArray(data) ? data : (data.data || []);
                const filtered = products.filter(p =>
                    (p.nom || p.name || '').toLowerCase().includes(q.toLowerCase())
                );
                renderSearchResults(filtered, q);
            },
            error: function() {
                document.getElementById('search-results-list').innerHTML =
                    '<div class="p-6 text-center text-red-400 text-sm">Erreur de chargement.</div>';
            }
        });
    }, 300);
});

function renderSearchResults(products, q) {
    const list = document.getElementById('search-results-list');
    if (products.length === 0) {
        list.innerHTML = '<div class="p-6 text-center text-gray-400 text-sm">Aucun produit trouvé pour <strong>"' + q + '"</strong></div>';
        return;
    }
    list.innerHTML = products.slice(0, 8).map(p => {
        let images = [];
        try { images = typeof p.images === 'string' ? JSON.parse(p.images) : (p.images || []); } catch(e){}
        const img = (images.length > 0 && images[0].startsWith('http'))
            ? images[0]
            : 'https://placehold.co/60x60?text=?';
        const price = p.prix_vente || p.prix || 0;
        const name = (p.nom || p.name || '');
        const highlighted = name.replace(new RegExp('(' + q + ')', 'gi'), '<mark class="bg-yellow-100 text-yellow-800 rounded px-0.5">$1</mark>');
        return `
        <a href="{{ url('/product') }}?id=${p.id}" onclick="closeSearch()" class="flex items-center gap-4 px-5 py-3.5 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
            <img src="${img}" alt="${name}" class="w-14 h-14 object-contain rounded-xl bg-gray-50 border border-gray-100 flex-shrink-0">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 truncate">${highlighted}</p>
                <p class="text-xs text-gray-400 mt-0.5">${p.categorie?.nom || ''}</p>
            </div>
            <span class="text-sm font-bold text-gray-900 flex-shrink-0">${parseFloat(price).toFixed(2)} MAD</span>
        </a>`;
    }).join('');
}
</script>
