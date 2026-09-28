<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumière - Premium Women's Fashion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .hero-title {
            font-size: clamp(3.5rem, 10vw, 7rem);
            line-height: 1.05;
            letter-spacing: -0.05em;
            font-weight: 700;
        }
        
        .fade-up-text {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .fade-up-text.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mini Cart Dropdown */
        .mini-cart-dropdown {
            transform-origin: top right;
            animation: mini-cart-in 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes mini-cart-in {
            from { opacity: 0; transform: scale(0.95) translateY(-8px); }
            to   { opacity: 1; transform: scale(1)   translateY(0); }
        }
        #mini-cart-items::-webkit-scrollbar { width: 4px; }
        #mini-cart-items::-webkit-scrollbar-track { background: transparent; }
        #mini-cart-items::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 4px; }
    </style>
</head>
<body class="relative overflow-x-hidden bg-white">
    
    @include('components.navbar')

    <main class="flex-1">
        <!-- Hero Section -->
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <div id="hero-bg-container" class="hero-bg-container"></div>
            <div class="hero-overlay"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
                <h2 class="text-sm font-bold tracking-[0.3em] uppercase text-gray-500 mb-4 fade-up-text">Premium Collection</h2>
                <h1 id="hero-text" class="hero-title text-gray-900 mb-6 fade-up-text text-white drop-shadow-lg">
                    Elevate Your Style.
                </h1>
                <p id="hero-subtext" class="mt-6 max-w-2xl mx-auto text-xl md:text-2xl text-gray-200 font-medium fade-up-text drop-shadow-md" style="transition-delay: 0.2s;">
                    Discover the latest trends in modern fashion.
                </p>
                <div id="hero-btn-container" class="mt-12 fade-up-text" style="transition-delay: 0.4s;">
                    <a href="#products" class="btn-sleek inline-flex items-center justify-center px-10 py-4 text-lg bg-white text-black hover:bg-gray-100 border-none">
                        Shop Now
                    </a>
                </div>
            </div>
        </section>

        <!-- Shop By Category (NEW PREMIUM SECTION) -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-4">Curated Categories</h2>
                    <p class="text-xl text-gray-500">Explore our exclusive collections tailored for every occasion.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 reveal" style="transition-delay: 0.2s;">
                    <!-- Large Card (Left) -->
                    <a href="categories.html?category=Robes" class="group relative h-[500px] md:h-[600px] rounded-[2rem] overflow-hidden block">
                        <img src="https://images.unsplash.com/photo-1495385794356-15371f348c31?auto=format&fit=crop&q=80&w=1000" alt="Robes" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-10 left-10 text-white">
                            <h3 class="text-3xl font-bold mb-2">Elegant Dresses</h3>
                            <p class="text-gray-200 text-lg mb-4">Discover the new summer collection.</p>
                            <span class="inline-flex items-center font-semibold text-white group-hover:underline">
                                Shop Collection <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                    </a>
                    
                    <!-- Stacked Cards (Right) -->
                    <div class="flex flex-col gap-6 h-[500px] md:h-[600px]">
                        <!-- Top Right Card -->
                        <a href="categories.html?category=Vestes" class="group relative flex-1 rounded-[2rem] overflow-hidden block">
                            <img src="https://images.unsplash.com/photo-1551028719-00167b16eac5?auto=format&fit=crop&q=80&w=1000" alt="Vestes" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 text-white">
                                <h3 class="text-2xl font-bold mb-1">Premium Jackets</h3>
                                <span class="inline-flex items-center font-medium text-white group-hover:underline">Shop Now <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </div>
                        </a>
                        
                        <!-- Bottom Right Card -->
                        <a href="categories.html?category=T-Shirts" class="group relative flex-1 rounded-[2rem] overflow-hidden block">
                            <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&q=80&w=1000" alt="T-Shirts" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 text-white">
                                <h3 class="text-2xl font-bold mb-1">Essential Basics</h3>
                                <span class="inline-flex items-center font-medium text-white group-hover:underline">Shop Now <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Promotional Mockup Banner -->
        <section class="relative py-24 md:py-32 overflow-hidden flex flex-col items-center justify-center min-h-[800px] bg-[#dca855]">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&q=80&w=2000" alt="Fashion Promo" class="w-full h-full object-cover opacity-60 mix-blend-multiply">
            </div>

            <!-- Content -->
            <div class="relative z-10 w-full max-w-7xl mx-auto px-4 flex flex-col items-center text-center reveal">
                <h2 class="text-white text-5xl md:text-7xl font-serif tracking-widest uppercase mb-12 leading-tight drop-shadow-md">
                    Fashion Store<br>
                    E-Commerce<br>
                    Template
                </h2>
                
                <!-- Laptop Mockup container -->
                <div class="relative w-full max-w-3xl mx-auto mb-16 group">
                    <div class="relative transform transition-transform duration-700 ease-out shadow-2xl">
                        <!-- Screen -->
                        <div class="bg-black p-3 md:p-4 rounded-t-2xl border-2 border-gray-800 shadow-2xl relative mx-auto w-full aspect-[16/10] overflow-hidden flex items-center justify-center">
                            <!-- Inner Screen Image (Store Mockup) -->
                            <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&q=80&w=1200" alt="Website preview" class="w-full h-full object-cover rounded-sm border border-gray-800">
                        </div>
                        <!-- Laptop Base -->
                        <div class="w-[115%] -ml-[7.5%] h-4 md:h-6 bg-gray-200 rounded-b-2xl shadow-[0_20px_40px_rgba(0,0,0,0.4)] flex justify-center relative z-20 border-t border-gray-300">
                            <div class="w-1/4 h-2 bg-gray-300 rounded-b-md mt-0"></div>
                        </div>
                    </div>
                </div>

                <a href="#products" class="bg-white text-gray-900 font-serif tracking-[0.2em] uppercase px-12 md:px-24 py-4 md:py-6 text-xl md:text-2xl hover:bg-gray-100 hover:scale-105 transition-all shadow-xl w-[90%] md:w-auto text-center">
                    Checkout Today
                </a>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20 reveal">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-4">Why Choose Us</h2>
                    <p class="text-xl text-gray-500">The ultimate fashion experience, curated for you.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="feature-card reveal" style="transition-delay: 0.1s;">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M5 12h14m-7-7 7 7-7 7"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Fast Delivery</h3>
                        <p class="text-gray-500">Get your favorite clothes delivered to your doorstep in record time.</p>
                    </div>
                    <div class="feature-card reveal" style="transition-delay: 0.2s;">
                        <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.27 1.27L3 12l5.813 1.912a2 2 0 0 1 1.27 1.27L12 21l1.912-5.813a2 2 0 0 1 1.27-1.27L21 12l-5.813-1.912a2 2 0 0 1-1.27-1.27L12 3Z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Premium Quality</h3>
                        <p class="text-gray-500">Only the highest quality fabrics and exclusive designs.</p>
                    </div>
                    <div class="feature-card reveal" style="transition-delay: 0.3s;">
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">24/7 Support</h3>
                        <p class="text-gray-500">Our styling team is here to help you anytime, anywhere.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Nouveautés Section -->
        <section id="nouveautes" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative mb-16 bg-white rounded-[40px] shadow-sm border border-gray-100">
            <div class="text-center mb-16 reveal">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight mb-4">Nouveautés</h2>
                <p class="text-xl text-gray-500">La pointe de la mode. Entre vos mains.</p>
            </div>
            
            <div id="nouveautes-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10">
                <!-- Products injected via JS -->
            </div>
            
            <!-- Pagination Slider -->
            <div class="mt-16 flex justify-center items-center gap-3" id="nouveautes-pagination">
                <!-- Pagination injected via JS -->
            </div>
        </section>

        <!-- Nouveautés Section -->

        <!-- Mini About Section -->
        <section class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center reveal">
                    <div class="relative h-[400px] rounded-[2rem] overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=1000" alt="Lumière Fashion" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/10"></div>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h2 class="text-sm font-bold tracking-[0.3em] uppercase text-gray-500 mb-4">Our Story</h2>
                        <h3 class="text-4xl md:text-5xl font-serif text-gray-900 mb-6 leading-tight">Redefining Modern <br>Elegance</h3>
                        <p class="text-lg text-gray-500 mb-8 leading-relaxed">
                            Founded in Paris, Lumière was born out of a desire to create premium clothing that empowers individuals to express their unique identity. We blend classic elegance with contemporary trends, using only the finest materials.
                        </p>
                        <a href="about.html" class="inline-flex items-center text-gray-900 font-bold uppercase tracking-widest hover:text-blue-600 transition-colors">
                            Discover Our Story
                            <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-24 bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
                <h2 class="text-sm font-bold tracking-[0.3em] uppercase text-gray-500 mb-4">Testimonials</h2>
                <h3 class="text-4xl md:text-5xl font-serif text-gray-900 mb-16 leading-tight">What Our Clients Say</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Review 1 -->
                    <div class="bg-[#fbfbfd] p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-shadow duration-300 relative text-left">
                        <div class="text-yellow-400 flex mb-6">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-lg text-gray-700 italic mb-8">"The quality is absolutely unmatched. The packaging was beautiful and the jacket fits perfectly. Lumière is my new favorite fashion brand."</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden mr-4">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=150" alt="Sarah L." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Sarah L.</h4>
                                <span class="text-sm text-gray-500">Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Review 2 -->
                    <div class="bg-[#fbfbfd] p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-shadow duration-300 relative text-left">
                        <div class="text-yellow-400 flex mb-6">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-lg text-gray-700 italic mb-8">"Fast shipping and incredible customer service. The silk dress I ordered is absolutely stunning and feels incredibly premium."</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden mr-4">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=150" alt="Emma W." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Emma W.</h4>
                                <span class="text-sm text-gray-500">Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Review 3 -->
                    <div class="bg-[#fbfbfd] p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-shadow duration-300 relative text-left">
                        <div class="text-yellow-400 flex mb-6">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-lg text-gray-700 italic mb-8">"I love the minimalist aesthetic. Finally a premium clothing brand that delivers true quality and fits so well. Highly recommended."</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden mr-4">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=150" alt="David M." class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">David M.</h4>
                                <span class="text-sm text-gray-500">Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mini Contact Section -->
        <section class="py-24 bg-[#fbfbfd] border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
                <h2 class="text-4xl md:text-5xl font-serif text-gray-900 mb-6">Visit Our Store</h2>
                <p class="text-xl text-gray-500 mb-12 max-w-2xl mx-auto">Experience the Lumière collection in person or reach out to our styling team for personalized advice.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <!-- Location -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <svg class="w-10 h-10 text-gray-900 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10c0 7.142-7.5 11.25-7.5 11.25S4.5 17.142 4.5 10a7.5 7.5 0 1115 0z"/></svg>
                        <h4 class="font-bold text-lg mb-2">Location</h4>
                        <p class="text-gray-500">Avenue des Champs-Élysées<br>75008 Paris, France</p>
                    </div>
                    
                    <!-- Contact -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <svg class="w-10 h-10 text-gray-900 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-4.08-7.074-6.97l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        <h4 class="font-bold text-lg mb-2">Contact</h4>
                        <p class="text-gray-500">contact@lumiere-store.com<br>+33 1 23 45 67 89</p>
                    </div>
                    
                    <!-- Hours -->
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <svg class="w-10 h-10 text-gray-900 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <h4 class="font-bold text-lg mb-2">Hours</h4>
                        <p class="text-gray-500">Mon - Sat: 10AM - 8PM<br>Sunday: Closed</p>
                    </div>
                </div>
                
                <div class="mt-12">
                    <a href="contact.html" class="btn-sleek inline-flex items-center px-10 py-4 text-sm font-bold uppercase tracking-widest bg-gray-900 text-white rounded-full hover:bg-black transition-colors shadow-lg">
                        Get In Touch
                    </a>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-24 bg-gray-50 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
            <div class="max-w-4xl mx-auto px-4 text-center relative z-10 reveal">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Join the Lumière Club</h2>
                <p class="text-lg text-gray-600 mb-10">Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto" onsubmit="event.preventDefault(); alert('Subscribed successfully!');">
                    <input type="email" placeholder="Enter your email address" required class="flex-1 px-6 py-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent text-sm bg-white shadow-sm">
                    <button type="submit" class="px-8 py-4 bg-gray-900 text-white rounded-full font-medium hover:bg-black transition-colors shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-1">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-6">
                        <path d="M20.38 3.46L16 2a4 4 0 01-8 0L3.62 3.46a2 2 0 00-1.34 2.23l.58 3.47a1 1 0 00.99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 002-2V10h2.15a1 1 0 00.99-.84l.58-3.47a2 2 0 00-1.34-2.23z"/>
                    </svg>
                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Experience the best of fashion with our curated collection of premium apparel.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-gray-900 transition-colors">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900 transition-colors">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975-.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07m0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.058-1.281.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.058-1.689-.072-4.948-.072zM12 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4.01 4.01 0 1 1 0-8.019A4.01 4.01 0 0 1 12 16zm7.846-10.405a1.441 1.441 0 1 1-2.882 0 1.441 1.441 0 0 1 2.882 0z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-sm">Collection</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="footer-link">T-Shirts</a></li>
                        <li><a href="#" class="footer-link">Pantalons</a></li>
                        <li><a href="#" class="footer-link">Vestes</a></li>
                        <li><a href="#" class="footer-link">Robes</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-sm">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="footer-link">Contact Us</a></li>
                        <li><a href="#" class="footer-link">Return Policy</a></li>
                        <li><a href="#" class="footer-link">Shipping Info</a></li>
                        <li><a href="#" class="footer-link">Size Guide</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-sm">Quick Links</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="footer-link">About Us</a></li>
                        <li><a href="#" class="footer-link">Store Locations</a></li>
                        <li><a href="#" class="footer-link">Terms of Service</a></li>
                        <li><a href="#" class="footer-link">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-400">&copy; 2026 Lumière Store. All rights reserved. Designed for excellence.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/api.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
    
    <script>
        $(document).ready(function() {
            // 1. Hero Animations
            setTimeout(() => {
                $('.fade-up-text').addClass('visible');
            }, 100);

            // 2. Dynamic Hero Background (8s rotation)
            const heroImages = [
                'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&q=80&w=1920', // Fashion Model 1
                'https://images.unsplash.com/photo-1469334031218-e382a71b716b?auto=format&fit=crop&q=80&w=1920', // Fashion Model 2
                'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=1920', // Fashion Model 3
                'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&q=80&w=1920'  // Fashion Model 4
            ];

            const container = $('#hero-bg-container');
            heroImages.forEach((img, index) => {
                const div = $('<div>').addClass('hero-bg-image');
                if (index === 0) div.addClass('active');
                div.css('background-image', `url(${img})`);
                container.append(div);
            });

            let currentImg = 0;
            setInterval(() => {
                const imgs = $('.hero-bg-image');
                imgs.eq(currentImg).removeClass('active');
                currentImg = (currentImg + 1) % imgs.length;
                imgs.eq(currentImg).addClass('active');
            }, 8000);

            // 3. Scroll Reveal & Navbar
            const revealOnScroll = () => {
                const windowHeight = window.innerHeight;
                $('.reveal').each(function() {
                    const top = this.getBoundingClientRect().top;
                    if (top < windowHeight - 100) {
                        $(this).addClass('active');
                    }
                });

                if ($(window).scrollTop() > 50) {
                    $('#main-nav').addClass('nav-scrolled');
                } else {
                    $('#main-nav').removeClass('nav-scrolled');
                }
            };

            $(window).on('scroll', revealOnScroll);
            revealOnScroll(); // Initial check

            // 4. Fetch Products with better grid logic
            api.get('/products', function(response) {
                $('#loading').hide();
                let products = Array.isArray(response) ? response : (response.data || []);
                
                if (products.length > 0) {
                    $('#products-grid').removeClass('hidden').empty();
                    products.forEach(function(product, index) {
                        const html = getProductCardHTML(product, index);
                        $('#products-grid').append(`<div class="reveal active">${html}</div>`);
                    });
                    
                    // Populate Nouveautés
                    nouveautesData = products;
                    renderNouveautes(1);
                } else {
                    $('#no-products').removeClass('hidden');
                }
            }, function() {
                $('#loading').hide();
                $('#no-products').text('Failed to load products.').removeClass('hidden');
            });
            // 5. Nouveautés Section Logic (Mock Data & Pagination)
            let nouveautesData = [];

            const ITEMS_PER_PAGE = 6;
            let currentPage = 1;

            function renderNouveautes(page) {
                if (nouveautesData.length === 0) return;
                const start = (page - 1) * ITEMS_PER_PAGE;
                const end = start + ITEMS_PER_PAGE;
                const productsToShow = nouveautesData.slice(start, end);

                const grid = $('#nouveautes-grid');
                grid.empty();

                productsToShow.forEach((product, index) => {
                    let images = [];
                    try {
                        images = typeof product.images === 'string' ? JSON.parse(product.images) : product.images;
                    } catch (e) {}
                    let firstImage = (images && images.length > 0) ? images[0] : 'https://placehold.co/400x400?text=No+Image';
                    const imageUrl = firstImage.startsWith('http') ? firstImage : API_BASE_URL.replace('/api', '/storage/') + firstImage;
                    const price = product.prix_vente || product.prix || product.price || 0;
                    const nom = product.nom || product.name;
                    
                    // Add tech badges and stars
                    let badgeHTML = '';
                    if (index % 5 === 0) badgeHTML = '<span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider z-20 shadow-sm">New</span>';
                    else if (index % 4 === 0) badgeHTML = '<span class="absolute top-4 left-4 bg-red-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider z-20 shadow-sm">Sale</span>';
                    else if (index % 3 === 0) badgeHTML = '<span class="absolute top-4 left-4 bg-gray-900 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider z-20 shadow-sm">Best Seller</span>';

                    const starsHTML = `
                        <div class="flex items-center justify-center gap-1 mb-3">
                            <div class="flex text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-4 h-4 text-gray-200" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">(120)</span>
                        </div>
                    `;

                    const cardHTML = `
                        <div class="product-card group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full border border-gray-100">
                            ${badgeHTML}
                            <a href="product.html?id=${product.id}" class="p-6 pb-2 flex-shrink-0 relative block bg-gray-50/50 group-hover:bg-white transition-colors duration-300">
                                <div class="product-img-wrapper relative z-10 w-full aspect-[4/3] flex items-center justify-center overflow-hidden rounded-xl">
                                    <img src="${imageUrl}" alt="${nom}" class="group-hover:scale-110 transition-transform duration-500 object-cover h-full w-full drop-shadow-md">
                                </div>
                            </a>
                            <div class="p-6 flex flex-col flex-1 items-center text-center relative z-10 bg-white">
                                ${starsHTML}
                                <div class="text-[10px] font-bold text-gray-400 mb-2 uppercase tracking-[0.2em]">${product.categorie?.nom || product.category?.name || 'Exclusive Fashion'}</div>
                                <a href="product.html?id=${product.id}" class="block mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1 tracking-tight">${nom}</h3>
                                </a>
                                <span class="text-xl font-bold font-mono text-gray-900 mb-6">${price} MAD</span>
                                
                                <div class="mt-auto w-full">
                                    <button onclick='Cart.addItem(${JSON.stringify(product).replace(/'/g, "&apos;")})' class="w-full py-3.5 text-sm font-bold tracking-wide bg-gradient-to-r from-gray-900 to-black text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2 group/btn">
                                        <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        ADD TO CART
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    grid.append(`<div class="fade-in">${cardHTML}</div>`);
                });

                renderPagination();
            }

            function renderPagination() {
                const totalPages = Math.ceil(nouveautesData.length / ITEMS_PER_PAGE);
                const paginationContainer = $('#nouveautes-pagination');
                paginationContainer.empty();

                for (let i = 1; i <= totalPages; i++) {
                    const isActive = i === currentPage;
                    const btnClass = isActive 
                        ? 'bg-blue-600 text-white shadow-md scale-105 border-blue-600' 
                        : 'bg-white text-gray-600 hover:bg-gray-50 hover:text-blue-600 border-gray-200';
                    
                    const btn = `<button class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm transition-all duration-300 border ${btnClass}" data-page="${i}">
                        ${i}
                    </button>`;
                    
                    paginationContainer.append(btn);
                }

                // Attach click event
                $('#nouveautes-pagination button').on('click', function() {
                    const newPage = parseInt($(this).data('page'));
                    if (newPage !== currentPage) {
                        currentPage = newPage;
                        renderNouveautes(currentPage);
                    }
                });
            }

            // Initialize
            renderNouveautes(currentPage);
        });
    </script>
</body>
</html>
