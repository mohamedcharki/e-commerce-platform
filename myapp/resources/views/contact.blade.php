<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Aura Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-[#fbfbfd]">

    @include('components.navbar')

    <main class="w-full">
        <!-- Contact Hero Section -->
        <section class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden bg-gray-900">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&q=80&w=2000" alt="Lumiere Store Interior" class="w-full h-full object-cover opacity-40">
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 text-center fade-in">
                <h2 class="text-sm font-bold tracking-[0.3em] uppercase text-gray-400 mb-4">Contact Us</h2>
                <h1 class="text-5xl md:text-7xl font-serif text-white tracking-widest uppercase mb-6 drop-shadow-md">Get In Touch</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light tracking-wide max-w-2xl mx-auto">We're here to help. Reach out to our dedicated styling team.</p>
            </div>
        </section>

        <!-- Contact Content -->
        <section class="py-20 md:py-32 bg-white">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 fade-in">
                
                <!-- Contact Info (Left) -->
                <div class="lg:col-span-5 flex flex-col justify-center space-y-12 pr-0 lg:pr-8">
                    <div>
                        <h3 class="text-3xl font-serif text-gray-900 mb-4 tracking-wide uppercase">Client Services</h3>
                        <p class="text-gray-500 text-lg leading-relaxed mb-4">Our advisors are available 24/7 to assist you with order inquiries, styling advice, and technical assistance.</p>
                        <a href="mailto:contact@lumiere-store.com" class="text-gray-900 font-medium text-lg hover:text-blue-600 transition-colors border-b border-gray-900 pb-1 inline-block">contact@lumiere-store.com</a>
                    </div>
                    
                    <div class="h-px bg-gray-100 w-full"></div>

                    <div>
                        <h3 class="text-3xl font-serif text-gray-900 mb-4 tracking-wide uppercase">Headquarters</h3>
                        <p class="text-gray-500 text-lg leading-relaxed">
                            Lumière Maison de Couture<br>
                            Avenue des Champs-Élysées<br>
                            75008 Paris, France
                        </p>
                        <p class="text-gray-900 font-medium mt-4 text-lg tracking-wide">+33 1 23 45 67 89</p>
                    </div>
                </div>

                <!-- Form (Right) -->
                <div class="lg:col-span-7">
                    <div class="bg-[#fbfbfd] p-8 md:p-12 rounded-[2rem] shadow-xl border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8">Send us a message</h3>
                        <form id="contact-form" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">First Name</label>
                                    <input type="text" required class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors text-gray-900 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Last Name</label>
                                    <input type="text" required class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors text-gray-900 shadow-sm">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Email Address</label>
                                <input type="email" required class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors text-gray-900 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Message</label>
                                <textarea rows="5" required class="w-full bg-white border border-gray-200 rounded-xl px-4 py-4 focus:outline-none focus:border-gray-900 focus:ring-1 focus:ring-gray-900 transition-colors text-gray-900 shadow-sm resize-none"></textarea>
                            </div>
                            <button type="submit" class="btn-sleek w-full py-5 text-lg font-bold tracking-widest uppercase mt-4">Send Message</button>
                            <p id="contact-success" class="hidden text-green-600 text-center mt-6 font-medium bg-green-50 py-3 rounded-lg border border-green-100">Your message has been sent successfully. We will get back to you shortly.</p>
                        </form>
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
    <script>
        $(document).ready(function() {
            $('#contact-form').submit(function(e) {
                e.preventDefault();
                $(this).find('button').text('Sending...').prop('disabled', true);
                setTimeout(() => {
                    $(this).find('button').text('Send Message').prop('disabled', false);
                    $(this)[0].reset();
                    $('#contact-success').removeClass('hidden');
                    setTimeout(() => $('#contact-success').addClass('hidden'), 5000);
                }, 1000);
            });
        });
    </script>
</body>
</html>
