<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Swiper CSS pour le Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-slide-thumb-active img {
            border: 2px solid black;
            opacity: 1;
        }
        .thumbsSwiper .swiper-slide {
            opacity: 0.6;
            transition: opacity 0.3s;
        }
        .thumbsSwiper .swiper-slide:hover {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-[#fbfbfd]">

    @include('components.navbar')

    <main class="w-full md:py-20">
        <!-- Loader -->
        <div id="loading" class="loader mx-auto mt-20"></div>
        
        <div id="product-container" class="hidden w-full max-w-[1280px] px-4 md:px-8 mx-auto">
            <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-start">
                
                <!-- GAUCHE : Carousel (Images de la BD) -->
                <div class="w-full lg:w-[60%] min-w-0">
                    <div class="sticky top-[50px]">
                        <!-- Main Swiper -->
                        <div class="swiper mainSwiper mb-3 bg-gray-100 rounded-lg overflow-hidden">
                            <div class="swiper-wrapper" id="main-slider-wrapper">
                                <!-- Slides seront injectés ici via jQuery -->
                            </div>
                        </div>
                        <!-- Thumbs Swiper -->
                        <div class="swiper thumbsSwiper">
                            <div class="swiper-wrapper" id="thumbs-slider-wrapper">
                                <!-- Thumbs seront injectés ici via jQuery -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DROITE : Détails du Produit -->
                <div class="w-full lg:w-[40%] min-w-0 py-3">
                    <div class="sticky top-[50px]">
                        
                        <h1 id="product-name" class="text-3xl md:text-4xl font-bold mb-2 leading-tight"></h1>
                        <h2 id="product-desc" class="text-lg font-semibold mb-6 text-gray-500 line-clamp-2"></h2>

                        <div class="flex items-baseline mb-2">
                            <p id="product-price" class="text-2xl font-bold"></p>
                        </div>
                        <div class="text-sm font-medium text-gray-400 mb-10">
                            incl. of taxes
                            <br />
                            (Also includes applicable duties)
                        </div>

                        <!-- Sélecteur de Taille -->
                        <div class="mb-10">
                            <div class="flex justify-between mb-4">
                                <div class="text-md font-semibold">Select Size</div>
                                <div class="text-md font-medium text-gray-500 cursor-pointer hover:text-black transition-colors">
                                    Size Guide
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-3" id="size-container">
                                <!-- Boutons de tailles seront injectés via jQuery -->
                            </div>

                            <!-- Message d'erreur -->
                            <div id="size-error" class="hidden text-red-600 mt-3 text-sm font-medium">
                                Size selection is required
                            </div>
                        </div>

                        <!-- Sélecteur de Couleur -->
                        <div class="mb-10" id="color-selection-section">
                            <div class="text-md font-semibold mb-4">Select Color</div>
                            <div class="flex flex-wrap gap-4" id="color-container">
                                <!-- Swatches seront injectés ici via jQuery -->
                            </div>
                            <div id="selected-color-name" class="mt-3 text-sm text-gray-500 font-medium capitalize"></div>
                        </div>

                        <!-- Quantité (Cachée, on laisse 1 par défaut) -->
                        <input type="hidden" id="quantity" value="1">

                        <!-- Boutons d'Action -->
                        <div class="flex flex-col gap-4">
                            <button id="add-to-cart-btn" class="w-full py-4 rounded-full bg-black text-white text-lg font-medium transition-transform active:scale-95 hover:opacity-80">
                                Add to Cart
                            </button>
                            <button id="buy-now-btn" class="w-full py-4 rounded-full border border-black text-lg font-medium transition-transform active:scale-95 hover:bg-gray-50 flex items-center justify-center gap-2">
                                Buy Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="error-container" class="hidden text-center py-32">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">The product you're looking for can't be found.</h2>
            <a href="index.html" class="text-blue-600 hover:underline font-medium text-lg">Search the store &rarr;</a>
        </div>
    </main>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/api.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>

    <script>
        let currentProduct = null;
        let selectedSize = null;
        let selectedColor = null;
        let swiperMain = null;
        let swiperThumbs = null;

        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id');

            if (!productId) {
                $('#loading').hide();
                $('#error-container').removeClass('hidden');
                return;
            }

            // Récupérer le Produit via API AJAX
            api.get(`/products/${productId}`, function(response) {
                $('#loading').hide();
                let product = response.data || response;
                currentProduct = product;
                
                $('#product-name').text(product.nom || product.name);
                $('#product-price').text((product.prix_vente || product.prix || product.price) + ' MAD');
                $('#product-desc').text(product.description || "Premium Women's Fashion"); // Fallback description
                
                // Gérer les Images
                let images = [];
                try {
                    images = typeof product.images === 'string' ? JSON.parse(product.images) : product.images;
                } catch (e) {
                    if (product.image) images = [product.image];
                }

                if (!images || images.length === 0) {
                    images = ['https://placehold.co/800x800?text=No+Image'];
                }

                // Remplir les slides Swiper (Main et Thumbs)
                let mainSlides = '';
                let thumbSlides = '';

                images.forEach((imgUrl, index) => {
                    const formattedUrl = imgUrl.startsWith('http') ? imgUrl : API_BASE_URL.replace('/api', '/storage/') + imgUrl;
                    
                    mainSlides += `
                        <div class="swiper-slide">
                            <img src="${formattedUrl}" alt="Vue ${index+1}" class="w-full object-cover rounded-lg aspect-square">
                        </div>`;
                        
                    thumbSlides += `
                        <div class="swiper-slide cursor-pointer" style="width: 60px;">
                            <img src="${formattedUrl}" alt="Thumb ${index+1}" class="w-[60px] h-[60px] object-cover rounded-md">
                        </div>`;
                });

                $('#main-slider-wrapper').html(mainSlides);
                $('#thumbs-slider-wrapper').html(thumbSlides);

                // Initialiser Swiper (Carousel)
                // NOTE: loop is disabled so slideToLoop index matches exactly
                swiperThumbs = new Swiper(".thumbsSwiper", {
                    spaceBetween: 10,
                    slidesPerView: "auto",
                    freeMode: true,
                    watchSlidesProgress: true,
                    on: {
                        // When user clicks a thumb, sync the color swatch selection
                        click: function(swiper, event) {
                            const clickedIndex = swiper.clickedIndex;
                            if (typeof clickedIndex === 'undefined') return;
                            // Select matching color swatch
                            const $swatch = $(`.color-swatch[data-index="${clickedIndex}"]`);
                            if ($swatch.length) {
                                $swatch.trigger('click');
                            } else {
                                // No color for this index, just slide main
                                if (swiperMain) swiperMain.slideTo(clickedIndex);
                            }
                        }
                    }
                });
                
                swiperMain = new Swiper(".mainSwiper", {
                    spaceBetween: 10,
                    loop: false, // Disabled so slideTo(index) maps correctly
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    thumbs: {
                        swiper: swiperThumbs,
                    },
                });

                // Générer les Couleurs
                const productColors = product.colors || [];
                if (productColors.length > 0) {
                    productColors.forEach((color, index) => {
                        $('#color-container').append(`
                            <button type="button" class="color-swatch group relative w-10 h-10 rounded-full border-2 border-transparent transition-all duration-300 hover:scale-110 flex items-center justify-center p-0.5" 
                                    data-color="${color}" data-index="${index}" title="${color}">
                                <span class="w-full h-full rounded-full border border-gray-100 shadow-sm" style="background-color: ${color};"></span>
                                <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-black rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            </button>
                        `);
                    });
                    
                    // Sélectionner la première couleur par défaut après un court délai
                    setTimeout(() => {
                        $('.color-swatch').first().click();
                    }, 100);
                } else {
                    $('#color-selection-section').hide();
                }

                // Générer les Tailles (XS to XL)
                const sizes = ['XS', 'S', 'M', 'L', 'XL'];
                sizes.forEach(size => {
                    $('#size-container').append(`
                        <button type="button" class="size-btn border border-gray-300 rounded-md text-center py-3 font-medium transition-all hover:border-black text-gray-800" data-size="${size}">
                            ${size}
                        </button>
                    `);
                });

                // Event : Sélectionner une taille
                $('.size-btn').click(function() {
                    $('.size-btn').removeClass('border-black bg-black text-white').addClass('border-gray-300 text-gray-800');
                    $(this).removeClass('border-gray-300 text-gray-800').addClass('border-black bg-black text-white');
                    selectedSize = $(this).data('size');
                    $('#size-error').addClass('hidden'); // Cacher l'erreur si on sélectionne
                });

                // Event : Sélectionner une couleur
                $(document).on('click', '.color-swatch', function() {
                    $('.color-swatch').removeClass('border-black scale-110').addClass('border-transparent');
                    $(this).removeClass('border-transparent').addClass('border-black scale-110');
                    selectedColor = $(this).data('color');
                    $('#selected-color-name').html(`Selected: <span class="text-gray-900 font-bold">${selectedColor}</span>`);
                    
                    // Slide main image to match the selected color index
                    const colorIndex = $(this).data('index');
                    if (swiperMain && typeof colorIndex !== 'undefined') {
                        swiperMain.slideTo(colorIndex);
                    }
                });

                $('#product-container').removeClass('hidden');
            }, function() {
                $('#loading').hide();
                $('#error-container').removeClass('hidden');
            });

            // Event : Ajouter au panier
            $('#add-to-cart-btn').click(function() {
                if (!selectedSize) {
                    $('#size-error').removeClass('hidden');
                    return;
                }
                if (currentProduct) {
                    let productToAdd = { ...currentProduct, size: selectedSize, color: selectedColor };
                    Cart.addItem(productToAdd, $('#quantity').val());
                    showNotification(`Added to cart — ${selectedColor}, Size ${selectedSize}`);
                }
            });

            // Event : Buy Now (add to cart + go to checkout)
            $('#buy-now-btn').click(function() {
                if (!selectedSize) {
                    $('#size-error').removeClass('hidden');
                    return;
                }
                if (currentProduct) {
                    let productToAdd = { ...currentProduct, size: selectedSize, color: selectedColor };
                    Cart.addItem(productToAdd, $('#quantity').val());
                    window.location.href = '{{ url("/checkout.html") }}';
                }
            });
        });
    </script>
</body>
</html>
