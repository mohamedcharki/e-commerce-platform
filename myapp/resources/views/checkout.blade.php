<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Apple-like</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .input-clean {
            border: 1px solid #d2d2d7;
            border-radius: 12px;
            padding: 16px;
            width: 100%;
            font-size: 17px;
            background: #fff;
            transition: all 0.2s ease;
        }
        .input-clean:focus {
            outline: none;
            border-color: #0066cc;
            box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.1);
        }
    </style>
</head>
<body class="bg-[#fbfbfd]">

    <nav class="glass sticky top-0 z-50 py-4 border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 flex justify-between items-center">
            <span class="text-xl font-bold tracking-tight text-gray-900">Checkout</span>
            <a href="cart.html" class="text-blue-600 font-medium hover:underline text-sm">Return to Bag</a>
        </div>
    </nav>

    <main class="py-16 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="checkout-container" class="hidden fade-in">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-10 tracking-tight text-center">Where should we send your order?</h1>

            <form id="checkout-form" class="space-y-10">
                <div class="bg-white rounded-[2rem] p-8 md:p-12 shadow-sm border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 tracking-tight">Customer Information</h2>
                    <div>
                        <input type="number" id="client_id" value="1" required class="input-clean" placeholder="Client ID">
                        <p class="text-xs text-gray-500 mt-2 ml-2">For demo purposes, a mock client ID is used.</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-[2rem] p-8 md:p-12 border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 tracking-tight">Order Summary</h2>
                    <ul id="checkout-items" class="divide-y divide-gray-200 mb-6">
                        <!-- Checkout items -->
                    </ul>
                    <div class="flex justify-between items-center text-2xl font-bold text-gray-900 pt-6 border-t border-gray-200">
                        <span>Total</span>
                        <span id="checkout-total"></span>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" id="submit-btn" class="btn-sleek w-full py-5 text-xl font-semibold flex items-center justify-center gap-3">
                        <span>Place Order</span>
                        <div id="submit-spinner" class="hidden w-6 h-6 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                    <p class="text-center text-sm text-gray-500 mt-6 font-medium">Securely processed. Free returns within 14 days.</p>
                </div>
            </form>
        </div>

        <div id="empty-checkout" class="hidden text-center py-32">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Your bag is empty.</h2>
            <a href="index.html" class="btn-sleek inline-block py-3 px-8 text-lg">Continue Shopping</a>
        </div>

        <!-- Success State -->
        <div id="success-state" class="hidden text-center py-20 fade-in">
            <svg class="h-20 w-20 text-gray-900 mx-auto mb-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-5xl font-extrabold text-gray-900 mb-6 tracking-tight leading-tight">Thank you.<br>Your order is confirmed.</h2>
            <p class="text-xl text-gray-500 mb-12 font-medium">We'll email you an order receipt and shipping confirmation.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="orders.html" class="btn-secondary py-3 px-8 text-lg">View Order History</a>
                <a href="index.html" class="btn-sleek py-3 px-8 text-lg">Continue Shopping</a>
            </div>
        </div>
    </main>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/api.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}?v={{ time() }}"></script>
    <!-- We don't need full main.js here to avoid double navbar injection -->
    <script>
        function formatPrice(price) { return '$' + parseFloat(price).toFixed(2); }

        $(document).ready(function() {
            

            const items = Cart.getItems();

            if (items.length === 0) {
                $('#empty-checkout').removeClass('hidden');
            } else {
                $('#checkout-container').removeClass('hidden');
                
                const list = $('#checkout-items');
                items.forEach(item => {
                    const price = parseFloat(item.prix_vente || item.prix || item.price || 0);
                    list.append(`
                        <li class="py-4 flex justify-between items-center">
                            <span class="text-gray-900 font-medium text-lg leading-tight w-2/3">${item.nom || item.name} <span class="text-gray-400 block text-sm mt-1">Qty ${item.quantity}</span></span>
                            <span class="text-gray-900 font-bold text-lg">${formatPrice(price * item.quantity)}</span>
                        </li>
                    `);
                });

                $('#checkout-total').text(formatPrice(Cart.getTotal()));
            }

            $('#checkout-form').submit(function(e) {
                e.preventDefault();
                
                const btn = $('#submit-btn');
                const spinner = $('#submit-spinner');
                
                btn.prop('disabled', true).css('opacity', '0.7');
                spinner.removeClass('hidden');
                
                const clientId = $('#client_id').val();
                const cartTotal = Cart.getTotal();
                const currentCartItems = Cart.getItems();
                
                console.log("SENDING CART:", currentCartItems);
                console.log("SENDING TOTAL:", cartTotal);

                if (cartTotal <= 0) {
                    alert('Your cart total is zero. Please try refreshing or re-adding your products.');
                    btn.prop('disabled', false).css('opacity', '1');
                    spinner.addClass('hidden');
                    return;
                }
                
                const requestData = {
                    client_id: clientId,
                    total: cartTotal,
                    cart: currentCartItems.map(item => ({
                        id: item.id,
                        quantity: parseInt(item.quantity)
                    }))
                };

                // Simulate slight network delay for premium feel
                setTimeout(() => {
                    api.post('/checkout', requestData, function(response) {
                        Cart.clear();
                        $('#checkout-container').addClass('hidden');
                        $('#success-state').removeClass('hidden');
                        window.scrollTo(0, 0);
                    }, function(err) {
                        btn.prop('disabled', false).css('opacity', '1');
                        spinner.addClass('hidden');
                        console.error(err);
                        
                        // Handle stale cart data (invalid product IDs due to DB refresh)
                        if (err.responseJSON && err.responseJSON.errors) {
                            const errors = err.responseJSON.errors;
                            let hasInvalidProduct = false;
                            for (let key in errors) {
                                if (key.includes('cart.') && key.includes('.id')) {
                                    hasInvalidProduct = true;
                                    break;
                                }
                            }
                            if (hasInvalidProduct) {
                                alert('Your cart contains outdated products that are no longer available. Your cart will be cleared automatically so you can shop again.');
                                Cart.clear();
                                window.location.href = 'index.html';
                                return;
                            }
                        }
                        
                        alert('Error placing order.');
                    });
                }, 800);
            });
        });
    </script>
</body>
</html>
