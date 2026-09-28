<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Lumière Fashion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        /* Hide scrollbar for category pills wrapper */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="relative overflow-x-hidden pt-16">
    <div class="ambient-glow"></div>

    @include('components.navbar')

    <main class="flex-1 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-8 text-center tracking-tight">Shop by Category.</h1>
            
            <div class="flex flex-col gap-10">
                <!-- Top Pill Navigation -->
                <div class="w-full flex justify-center">
                    <div class="bg-gray-100 p-1.5 rounded-full inline-flex overflow-x-auto no-scrollbar max-w-full shadow-inner border border-gray-200">
                        <div id="categories-loading" class="text-sm font-medium text-gray-500 px-6 py-2">Loading...</div>
                        <ul id="categories-list" class="flex whitespace-nowrap hidden gap-1">
                            <li>
                                <button class="category-link btn-sleek px-6 py-2 text-sm transition-all" data-id="all">
                                    All
                                </button>
                            </li>
                            <!-- Categories appended here -->
                        </ul>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="flex-1 w-full">
                    <div id="products-loading" class="loader"></div>
                    <div id="products-grid" class="hidden grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 lg:grid-cols-3 gap-6 xl:gap-10">
                        <!-- Products appended here -->
                    </div>
                    <div id="no-products" class="hidden text-center py-20 bg-white/50 backdrop-blur-xl rounded-3xl border border-gray-100">
                        <p class="text-xl text-gray-500 font-medium">No items found.</p>
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
        let allProducts = [];

        function renderProducts(products) {
            const grid = $('#products-grid');
            grid.empty();
            
            if (products.length > 0) {
                grid.removeClass('hidden');
                $('#no-products').addClass('hidden');
                products.forEach((product, idx) => {
                    const html = getProductCardHTML(product);
                    const delay = (idx % 4) * 0.05;
                    grid.append(`<div class="slide-up" style="animation-delay: ${delay}s">${html}</div>`);
                });
            } else {
                grid.addClass('hidden');
                $('#no-products').removeClass('hidden');
            }
        }

        $(document).ready(function() {
            api.get('/categories', function(response) {
                $('#categories-loading').hide();
                let categories = response.data || response;
                
                $('#categories-list').removeClass('hidden');
                categories.forEach(cat => {
                    $('#categories-list').append(`
                        <li>
                            <button class="category-link px-6 py-2 text-sm text-gray-600 font-medium rounded-full hover:bg-gray-200 transition-colors" data-id="${cat.id}">
                                ${cat.nom || cat.name}
                            </button>
                        </li>
                    `);
                });
            });

            api.get('/products', function(response) {
                $('#products-loading').hide();
                allProducts = response.data || response;
                renderProducts(allProducts);
            }, function() {
                $('#products-loading').hide();
                $('#no-products').removeClass('hidden').text('Error fetching products.');
            });

            $(document).on('click', '.category-link', function(e) {
                e.preventDefault();
                
                $('.category-link').removeClass('btn-sleek').addClass('text-gray-600 hover:bg-gray-200');
                
                $(this).removeClass('text-gray-600 hover:bg-gray-200').addClass('btn-sleek');
                
                const catId = $(this).data('id');
                
                if (catId === 'all') {
                    renderProducts(allProducts);
                } else {
                    const filtered = allProducts.filter(p => p.categorie_id == catId || (p.category && p.category.id == catId));
                    renderProducts(filtered);
                }
            });
        });
    </script>
</body>
</html>
