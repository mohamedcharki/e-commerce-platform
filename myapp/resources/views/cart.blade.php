<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart — Lumière</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-[#fbfbfd]">

    @include('components.navbar')

    <main class="py-12 md:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Empty Cart State -->
        <div id="empty-cart" class="hidden flex flex-col items-center justify-center py-32 text-center">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-8">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4 tracking-tight">Your bag is empty.</h1>
            <p class="text-lg text-gray-500 mb-10 max-w-sm mx-auto">Looks like you haven't added anything yet. Discover our latest collection and find something you love.</p>
            <a href="index.html" class="inline-flex items-center justify-center px-10 py-4 bg-black text-white text-lg font-bold rounded-full hover:bg-gray-800 transition-all shadow-lg hover:shadow-xl">
                Continue Shopping
            </a>
        </div>

        <!-- Cart Content -->
        <div id="cart-content" class="hidden">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Left: Items list -->
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-10 pb-6 border-b border-gray-100">
                        <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Review your bag.</h1>
                        <span class="text-gray-400 font-medium">Free delivery and returns.</span>
                    </div>

                    <div class="space-y-2">
                        <ul id="cart-items" class="divide-y divide-gray-100">
                            <!-- Items appended here -->
                        </ul>
                    </div>
                </div>

                <!-- Right: Summary Sidebar -->
                <div class="lg:w-96">
                    <div class="bg-gray-50/50 rounded-3xl p-8 sticky top-32 border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-8 tracking-tight">Summary</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-gray-600">
                                <span class="font-medium">Subtotal</span>
                                <span id="cart-subtotal" class="font-bold text-gray-900"></span>
                            </div>
                            <div class="flex justify-between text-gray-600 pb-4 border-b border-gray-100">
                                <span class="font-medium">Shipping</span>
                                <span class="text-green-600 font-bold uppercase text-xs tracking-wider">Free</span>
                            </div>
                            <div class="flex justify-between pt-2">
                                <span class="text-xl font-bold text-gray-900 tracking-tight">Total</span>
                                <span id="cart-total" class="text-2xl font-bold text-gray-900 tracking-tight"></span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <a href="checkout.html" class="w-full inline-flex items-center justify-center px-8 py-4 bg-black text-white text-lg font-bold rounded-2xl hover:bg-gray-800 transition-all shadow-lg hover:shadow-xl">
                                Check Out
                            </a>
                            <p class="text-[10px] text-center text-gray-400 uppercase tracking-[0.15em] font-bold">
                                Secure Checkout with SSL Encryption
                            </p>
                        </div>

                        <!-- Extra: Perks -->
                        <div class="mt-10 pt-10 border-t border-gray-200/50 space-y-4">
                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>30-day easy returns</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Authentic designer products</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/api.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>

    <script>
        function getItemImage(item) {
            try {
                let images = typeof item.images === 'string' ? JSON.parse(item.images) : (item.images || []);
                if (images && images.length > 0) {
                    return images[0].startsWith('http') ? images[0] : API_BASE_URL.replace('/api', '/storage/') + images[0];
                }
            } catch(e) {}
            return 'https://placehold.co/200x200/f5f5f7/86868b?text=No+Image';
        }

        function formatMAD(price) {
            return parseFloat(price).toFixed(2) + ' MAD';
        }

        function renderCart() {
            const items = Cart.getItems();
            const container = $('#cart-items');
            container.empty();

            if (items.length === 0) {
                $('#cart-content').addClass('hidden');
                $('#empty-cart').removeClass('hidden');
            } else {
                $('#empty-cart').addClass('hidden');
                $('#cart-content').removeClass('hidden');

                items.forEach(item => {
                    const price = parseFloat(item.prix_vente || item.prix || item.price || 0);
                    const imageUrl = getItemImage(item);

                    container.append(`
                        <li class="group py-8 first:pt-0">
                            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
                                <!-- Product Image -->
                                <div class="w-32 h-40 flex-shrink-0 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 flex items-center justify-center p-4 group-hover:bg-white transition-colors duration-500 relative">
                                    <img src="${imageUrl}" alt="${item.nom || item.name}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-700">
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 w-full">
                                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
                                        <div class="space-y-1">
                                            <h3 class="text-xl font-bold text-gray-900 tracking-tight leading-tight group-hover:text-blue-600 transition-colors">
                                                <a href="product.html?id=${item.id}">${item.nom || item.name}</a>
                                            </h3>
                                            <p class="text-sm text-gray-400 font-medium uppercase tracking-wider">Women's Collection</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xl font-bold text-gray-900 tracking-tight">${formatMAD(price * item.quantity)}</p>
                                            <p class="text-xs text-gray-400 font-medium mt-1">${formatMAD(price)} per item</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap items-center justify-between gap-6 pt-6 border-t border-gray-50">
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center bg-gray-50 rounded-xl p-1 border border-gray-100">
                                            <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-400 hover:text-black" onclick="updateItemQty(${item.id}, -1)">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/></svg>
                                            </button>
                                            <span class="text-sm font-bold w-10 text-center text-gray-900">${item.quantity}</span>
                                            <button class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white hover:shadow-sm transition-all text-gray-400 hover:text-black" onclick="updateItemQty(${item.id}, 1)">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                            </button>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex items-center gap-6">
                                            <button class="text-xs font-bold text-gray-400 hover:text-red-500 transition-colors flex items-center gap-2 group/remove" onclick="removeItem(${item.id})">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                <span>Remove</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `);
                });

                const totalValue = Cart.getTotal();
                $('#cart-subtotal').text(formatMAD(totalValue));
                $('#cart-total').text(formatMAD(totalValue));
            }
        }

        function updateItemQty(id, change) {
            const item = Cart.getItems().find(i => i.id == id);
            if (item) {
                Cart.updateQuantity(id, item.quantity + change);
                renderCart();
            }
        }

        function removeItem(id) {
            Cart.removeItem(id);
            renderCart();
        }

        $(document).ready(function() {
            renderCart();
        });
    </script>
</body>
</html>
