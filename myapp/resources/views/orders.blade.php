<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Apple-like</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-[#fbfbfd]">

    @include('components.navbar')

    <main class="py-16 md:py-24 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-12 tracking-tight">Your Orders.</h1>
        
        <div id="orders-loading" class="loader"></div>
        
        <div id="orders-container" class="hidden space-y-8">
            <!-- Orders will be appended here -->
        </div>
        
        <div id="no-orders" class="hidden text-center py-20 bg-white rounded-[2rem] border border-gray-100 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">No recent orders</h2>
            <p class="text-gray-500 font-medium mb-8">When you order something, it will appear here.</p>
            <a href="index.html" class="btn-sleek inline-block py-3 px-8 text-lg">Continue Shopping</a>
        </div>
    </main>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/api.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>

    <script>
        $(document).ready(function() {
            api.get('/commands', function(response) {
                $('#orders-loading').hide();
                let orders = response.data || response;
                
                if (orders.length > 0) {
                    $('#orders-container').removeClass('hidden');
                    
                    orders.forEach(order => {
                        const date = new Date(order.created_at || order.date_comm).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                        const orderTotal = formatPrice(order.total_price || 0);
                        
                        let itemsHtml = '';
                        if (order.produits && order.produits.length > 0) {
                            itemsHtml = order.produits.map(p => `
                                <li class="py-4 flex flex-col sm:flex-row justify-between sm:items-center border-b border-gray-100 last:border-0 last:pb-0">
                                    <div class="flex items-center gap-4 mb-2 sm:mb-0">
                                        <div class="w-16 h-16 bg-gray-50 rounded-xl p-1 mix-blend-multiply flex-shrink-0">
                                            <img src="${p.image ? (API_BASE_URL.replace('/api', '/storage/') + p.image) : 'https://placehold.co/100x100?text=Item'}" class="w-full h-full object-contain">
                                        </div>
                                        <span class="text-gray-900 font-medium text-lg leading-tight">${p.nom || p.name} <span class="text-gray-400 block text-sm mt-1">Qty ${p.pivot ? p.pivot.quantite : 1}</span></span>
                                    </div>
                                    <span class="font-bold text-gray-900 text-lg">${formatPrice(p.pivot ? p.pivot.prix * p.pivot.quantite : p.prix)}</span>
                                </li>
                            `).join('');
                        } else {
                            itemsHtml = `<li class="py-4 text-gray-500 italic font-medium">Items details are not available.</li>`;
                        }
                        
                        $('#orders-container').append(`
                            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden slide-up">
                                <div class="bg-[#f5f5f7] px-8 py-6 border-b border-gray-200 flex flex-wrap items-center justify-between gap-6">
                                    <div class="flex items-center gap-8">
                                        <div>
                                            <p class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-1">Order Placed</p>
                                            <p class="text-base font-semibold text-gray-900">${date}</p>
                                        </div>
                                        <div>
                                            <p class="text-[12px] font-bold text-gray-500 uppercase tracking-widest mb-1">Order Number</p>
                                            <p class="text-base font-semibold text-gray-900">#${order.id}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold bg-green-100 text-green-800 tracking-tight">
                                            Confirmed
                                        </span>
                                    </div>
                                </div>
                                <div class="px-8 py-6">
                                    <ul class="mb-4">
                                        ${itemsHtml}
                                    </ul>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $('#no-orders').removeClass('hidden');
                }
            }, function(err) {
                $('#orders-loading').hide();
                $('#no-orders').removeClass('hidden').html(`
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Error loading orders</h3>
                    <p class="text-gray-500 font-medium">Please ensure the backend API is running.</p>
                `);
            });
        });
    </script>
</body>
</html>
