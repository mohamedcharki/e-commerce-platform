<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Lumière</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-[#fbfbfd]">

    @include('components.navbar')

    <main class="w-full">
        <!-- About Hero Section -->
        <section class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden bg-gray-900">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=2000" alt="Fashion Story" class="w-full h-full object-cover opacity-50 mix-blend-overlay">
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 text-center fade-in">
                <h2 class="text-sm font-bold tracking-[0.3em] uppercase text-gray-400 mb-4">Our Story</h2>
                <h1 class="text-5xl md:text-7xl font-serif text-white tracking-widest uppercase mb-6 drop-shadow-md">About Lumière</h1>
                <p class="text-xl md:text-2xl text-gray-200 font-light tracking-wide max-w-2xl mx-auto drop-shadow-sm">Redefining modern elegance through premium fashion.</p>
            </div>
        </section>

        <!-- The Story Section -->
        <section class="py-20 md:py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center fade-in">
                    <div>
                        <h2 class="text-3xl md:text-5xl font-serif text-gray-900 mb-8 leading-tight">A Legacy of <br>Style & Quality</h2>
                        <p class="text-lg text-gray-500 mb-6 leading-relaxed">
                            Founded in Paris, Lumière was born out of a desire to create clothing that empowers individuals to express their unique identity. We believe that fashion is not just about what you wear, but how it makes you feel.
                        </p>
                        <p class="text-lg text-gray-500 leading-relaxed">
                            Every piece in our collection is meticulously crafted with attention to detail, using only the finest materials sourced globally. From everyday essentials to statement pieces, our designs blend classic elegance with contemporary trends.
                        </p>
                    </div>
                    <div class="relative h-[500px] rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&q=80&w=1000" alt="Design Process" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Values Section -->
        <section class="py-20 bg-[#fbfbfd]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center fade-in">
                <h2 class="text-4xl font-serif text-gray-900 mb-16 uppercase tracking-widest">Our Core Values</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Premium Quality</h3>
                        <p class="text-gray-500">We never compromise on materials. Each garment is crafted to last, ensuring you look flawless season after season.</p>
                    </div>
                    
                    <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Fair Pricing</h3>
                        <p class="text-gray-500">Luxury shouldn't be inaccessible. We offer high-end fashion at honest prices by cutting out the traditional retail markup.</p>
                    </div>
                    
                    <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12A10 10 0 0 0 15 21.54A10 10 0 0 1 15 2.46A10 10 0 0 0 2 12Z"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Sustainability</h3>
                        <p class="text-gray-500">We care about the planet. Our production processes minimize waste and utilize eco-friendly materials whenever possible.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/api.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
</body>
</html>
