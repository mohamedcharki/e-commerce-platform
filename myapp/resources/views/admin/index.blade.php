<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        // Store Sanctum API token from Laravel session into localStorage for JS API calls
        @if($apiToken)
            localStorage.setItem('aura_token', '{{ $apiToken }}');
        @endif
    </script>
    <style>
        body {
            background-color: #0f172a;
            color: #f8fafc;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
        }
        .input-dark {
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
        }
        .input-dark:focus {
            border-color: #6366f1;
            outline: none;
        }
        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 flex-shrink-0 glass-panel m-4 flex flex-col h-[calc(100vh-2rem)] shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-600"></div>
        <div class="p-6">
            <h2 class="text-xl font-extrabold tracking-tight"><i class="fa-solid fa-bolt text-indigo-500 mr-2"></i>AURA ADMIN</h2>
        </div>
        <nav class="flex-1 px-4 space-y-2 font-medium">
            <a href="#" data-target="dashboard" class="nav-link active bg-white/10 text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors">
                <i class="fa-solid fa-chart-line w-5"></i> Dashboard
            </a>
            <a href="#" data-target="products" class="nav-link text-gray-400 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors">
                <i class="fa-solid fa-box w-5"></i> Products
            </a>
            <a href="#" data-target="orders" class="nav-link text-gray-400 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors">
                <i class="fa-solid fa-shopping-cart w-5"></i> Orders
            </a>
            <a href="#" data-target="categories" class="nav-link text-gray-400 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors">
                <i class="fa-solid fa-tags w-5"></i> Categories
            </a>
            <a href="#" data-target="customers" class="nav-link text-gray-400 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors">
                <i class="fa-solid fa-users w-5"></i> Customers
            </a>
            <a href="#" data-target="archives" class="nav-link text-gray-400 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors">
                <i class="fa-solid fa-archive w-5"></i> Archives
            </a>
            <a href="#" data-target="settings" class="nav-link text-gray-400 hover:text-white flex items-center gap-3 px-4 py-3 rounded-xl transition-colors">
                <i class="fa-solid fa-cog w-5"></i> Settings
            </a>
        </nav>
        <div class="p-4 border-t border-white/10">
            <form id="logout-form" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-gray-400 hover:text-red-400 px-4 py-2 w-full transition-colors font-medium">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-4 pr-8 relative">
        <header class="flex justify-between items-center py-4 mb-4">
            <h1 class="text-2xl font-bold">Admin Platform</h1>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center font-bold shadow-lg">A</div>
            </div>
        </header>

        <!-- DASHBOARD VIEW -->
        <section id="dashboard" class="view-section fade-in">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="glass-panel p-6">
                    <div class="text-sm text-gray-400 font-medium mb-1">Total Revenue</div>
                    <div class="text-3xl font-bold text-white" id="stat-revenue">$0.00</div>
                </div>
                <div class="glass-panel p-6">
                    <div class="text-sm text-gray-400 font-medium mb-1">Total Orders</div>
                    <div class="text-3xl font-bold text-white" id="stat-orders">0</div>
                </div>
                <div class="glass-panel p-6">
                    <div class="text-sm text-gray-400 font-medium mb-1">Total Products</div>
                    <div class="text-3xl font-bold text-white" id="stat-products">0</div>
                </div>
            </div>
            
            <div class="glass-panel p-6 mb-8">
                <h3 class="text-lg font-bold mb-4">Revenue Overview</h3>
                <div class="w-full h-64">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
            
            <div class="glass-panel p-6">
                <h3 class="text-lg font-bold mb-4">Latest Orders</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm border-b border-white/10">
                                <th class="pb-3 px-4">Order Ref</th>
                                <th class="pb-3 px-4">Customer</th>
                                <th class="pb-3 px-4">Status</th>
                                <th class="pb-3 px-4 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="latest-orders-tbody">
                            <!-- JS loaded -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- PRODUCTS VIEW -->
        <section id="products" class="view-section hidden">
            <div class="glass-panel p-6 h-full min-h-[500px]">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Inventory Management</h3>
                    <button class="bg-indigo-600 hover:bg-indigo-500 px-4 py-2 rounded-lg font-medium shadow-lg transition-colors" onclick="openProductModal()">
                        <i class="fa-solid fa-plus mr-2"></i> Add Product
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm border-b border-white/10">
                                <th class="pb-3 px-4">Product Name</th>
                                <th class="pb-3 px-4">Category</th>
                                <th class="pb-3 px-4">Price</th>
                                <th class="pb-3 px-4">Stock</th>
                                <th class="pb-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ORDERS VIEW -->
        <section id="orders" class="view-section hidden">
            <div class="glass-panel p-6 h-full min-h-[500px]">
                <h3 class="text-xl font-bold mb-6">Order Fulfillment</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead>
                            <tr class="text-gray-400 border-b border-white/10">
                                <th class="pb-3 px-4">Reference</th>
                                <th class="pb-3 px-4">Customer</th>
                                <th class="pb-3 px-4">Total</th>
                                <th class="pb-3 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody id="orders-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- CATEGORIES VIEW -->
        <section id="categories" class="view-section hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass-panel p-6 md:col-span-1 h-fit">
                    <h3 class="text-lg font-bold mb-4">Add Category</h3>
                    <div class="space-y-4">
                        <input type="text" id="cat-nom" placeholder="Category Name" class="input-dark w-full px-4 py-2 rounded-lg">
                        <button class="bg-indigo-600 w-full rounded-lg py-2 font-medium" onclick="saveCategory()">Save Category</button>
                    </div>
                </div>
                <div class="glass-panel p-6 md:col-span-2 min-h-[400px]">
                    <h3 class="text-lg font-bold mb-4">Categories</h3>
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm border-b border-white/10">
                                <th class="pb-3 px-4">ID</th>
                                <th class="pb-3 px-4">Name</th>
                                <th class="pb-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categories-tbody"></tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- CUSTOMERS VIEW -->
        <section id="customers" class="view-section hidden">
            <div class="glass-panel p-6 h-full min-h-[500px]">
                <h3 class="text-xl font-bold mb-6">Customer Directory</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-sm border-b border-white/10">
                            <th class="pb-3 px-4">ID</th>
                            <th class="pb-3 px-4">Name</th>
                            <th class="pb-3 px-4">Email</th>
                        </tr>
                    </thead>
                    <tbody id="customers-tbody"></tbody>
                </table>
            </div>
        </section>

        <!-- ARCHIVES VIEW -->
        <section id="archives" class="view-section hidden">
            <div class="glass-panel p-6 h-full min-h-[500px]">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Archived Products</h3>
                    <p class="text-sm text-gray-400">Items here will be permanently deleted after 30 days.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm border-b border-white/10">
                                <th class="pb-3 px-4">Product Name</th>
                                <th class="pb-3 px-4">Category</th>
                                <th class="pb-3 px-4">Deleted At</th>
                                <th class="pb-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="archives-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- SETTINGS VIEW -->
        <section id="settings" class="view-section hidden">
            <div class="glass-panel p-6 max-w-2xl">
                <h3 class="text-xl font-bold mb-6">Site Configuration</h3>
                <div class="space-y-6 text-gray-300">
                    <div>
                        <label class="block text-sm mb-1">Site Name</label>
                        <input type="text" value="Aura Premium" class="input-dark w-full rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Support Email</label>
                        <input type="email" value="support@aurapremium.com" class="input-dark w-full rounded-lg px-4 py-2">
                    </div>
                    <button class="bg-emerald-600 hover:bg-emerald-500 px-6 py-2 rounded-lg text-white font-medium shadow" onclick="showNotification('Settings updated (Mocked)')">Save Changes</button>
                </div>
            </div>
        </section>

    </main>

    <!-- Product Modal -->
    <div id="product-modal" class="modal fixed inset-0 z-50 flex items-center justify-center hidden p-4">
        <div class="glass-panel w-full max-w-xl p-8 bg-[#0f172a] shadow-2xl relative">
            <button class="absolute top-4 right-4 text-gray-400 hover:text-white" onclick="closeProductModal()"><i class="fa-solid fa-xmark text-xl"></i></button>
            <h3 class="text-2xl font-bold mb-6 text-white">Product Details</h3>
            <form id="product-form" onsubmit="event.preventDefault(); saveProduct();" class="space-y-4">
                <input type="hidden" id="product-id">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Name</label>
                        <input type="text" id="product-nome" required class="input-dark w-full rounded pl-3 pr-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Category</label>
                        <select id="product-category_id" required class="input-dark w-full rounded pl-3 pr-3 py-2 text-gray-300"></select>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Price</label>
                        <input type="number" step="0.01" id="product-prix" required class="input-dark w-full rounded pl-3 pr-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Stock Qty</label>
                        <input type="number" id="product-qte" required class="input-dark w-full rounded pl-3 pr-3 py-2">
                    </div>
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Image URL</label>
                    <input type="url" id="product-img" placeholder="https://unsplash.com/..." class="input-dark w-full rounded pl-3 pr-3 py-2">
                </div>
                <div>
                    <label class="block text-sm text-gray-400 mb-1">Description</label>
                    <textarea id="product-desc" rows="3" class="input-dark w-full rounded pl-3 pr-3 py-2"></textarea>
                </div>
                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 px-6 py-2 rounded-lg font-bold text-white transition-colors">Save Product</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/api.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/admin.js') }}?v={{ time() }}"></script>
</body>
</html>
