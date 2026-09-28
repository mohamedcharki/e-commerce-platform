// Admin Dashboard SPA Logic
let revenueChartInstance = null;
$(document).ready(function() {
    // Navigation
    $('.nav-link').click(function(e) {
        e.preventDefault();
        $('.nav-link').removeClass('active bg-white/10 text-white').addClass('text-gray-400');
        $(this).addClass('active bg-white/10 text-white').removeClass('text-gray-400');
        
        const target = $(this).data('target');
        $('.view-section').addClass('hidden');
        $('#' + target).removeClass('hidden').addClass('fade-in');

        loadView(target);
    });

    // Init
    loadView('dashboard');
});

function loadView(view) {
    if(view === 'dashboard') loadDashboard();
    if(view === 'products') loadProducts();
    if(view === 'orders') loadOrders();
    if(view === 'categories') loadCategories();
    if(view === 'customers') loadCustomers();
    if(view === 'archives') loadArchives();
}

// --- Dashboard ---
function loadDashboard() {
    api.get('/admin/stats', function(res) {
        $('#stat-revenue').text('$' + parseFloat(res.revenue).toFixed(2));
        $('#stat-orders').text(res.total_orders);
        $('#stat-products').text(res.total_products);
        
        let html = '';
        res.latest_orders.forEach(o => {
            html += `<tr class="border-b border-white/10">
                <td class="py-3 px-4">${o.reference}</td>
                <td class="py-3 px-4">${o.client ? o.client.nom : 'Guest'}</td>
                <td class="py-3 px-4 text-emerald-400 font-medium">${o.statut}</td>
                <td class="py-3 px-4 text-right">$${parseFloat(o.items.reduce((sum, i) => sum + (i.prix_vente * i.qte), 0)).toFixed(2)}</td>
            </tr>`;
        });
        $('#latest-orders-tbody').html(html);

        // Render Chart
        renderRevenueChart(res.revenue);
    });
}

function renderRevenueChart(currentRevenue) {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    if (revenueChartInstance) {
        revenueChartInstance.destroy();
    }

    // Mock data leading up to the current revenue
    const dataPoints = [
        currentRevenue * 0.1,
        currentRevenue * 0.25,
        currentRevenue * 0.4,
        currentRevenue * 0.55,
        currentRevenue * 0.75,
        currentRevenue * 0.9,
        currentRevenue
    ].map(v => parseFloat(v).toFixed(2));

    revenueChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Revenue ($)',
                data: dataPoints,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#8b5cf6',
                pointBorderColor: '#fff',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(255, 255, 255, 0.05)' },
                    ticks: { color: '#94a3b8' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' }
                }
            }
        }
    });
}

// --- Products ---
function loadProducts() {
    api.get('/products', function(res) {
        let products = Array.isArray(res) ? res : res.data;
        let html = '';
        products.forEach(p => {
            html += `
            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                <td class="py-3 px-4 font-medium">${p.nom}</td>
                <td class="py-3 px-4">${p.category ? p.category.nom : '-'}</td>
                <td class="py-3 px-4">$${parseFloat(p.prix_vente).toFixed(2)}</td>
                <td class="py-3 px-4">${p.qte}</td>
                <td class="py-3 px-4 text-right">
                    <button class="text-blue-400 hover:text-blue-300 mr-3" onclick='editProduct(${JSON.stringify(p).replace(/'/g, "&apos;")})'><i class="fa-solid fa-pen"></i></button>
                    <button class="text-red-400 hover:text-red-300" onclick="deleteProduct(${p.id})"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>`;
        });
        $('#products-tbody').html(html);
    });
    
    // Load categories for the form select
    api.get('/categories', function(res) {
        let cats = Array.isArray(res) ? res : res.data;
        let opts = '<option value="">Select Category</option>';
        cats.forEach(c => { opts += `<option value="${c.id}">${c.nom}</option>`; });
        $('#product-category_id').html(opts);
    });
}

function openProductModal() {
    $('#product-form')[0].reset();
    $('#product-id').val('');
    $('#product-modal').removeClass('hidden');
}

function closeProductModal() {
    $('#product-modal').addClass('hidden');
}

function saveProduct() {
    const id = $('#product-id').val();
    const data = {
        nom: $('#product-nome').val(),
        prix_vente: $('#product-prix').val(),
        qte: $('#product-qte').val(),
        categorie_id: $('#product-category_id').val(),
        description: $('#product-desc').val(),
        images: [$('#product-img').val()]
    };
    
    if(id) {
        api.put('/admin/products/' + id, data, () => {
            closeProductModal(); loadProducts(); showNotification('Product updated');
        });
    } else {
        api.post('/admin/products', data, () => {
            closeProductModal(); loadProducts(); showNotification('Product added');
        });
    }
}

function editProduct(p) {
    $('#product-id').val(p.id);
    $('#product-nome').val(p.nom);
    $('#product-prix').val(p.prix_vente);
    $('#product-qte').val(p.qte);
    $('#product-category_id').val(p.categorie_id);
    $('#product-desc').val(p.description);
    $('#product-img').val(p.images && p.images.length ? p.images[0] : '');
    $('#product-modal').removeClass('hidden');
}

function deleteProduct(id) {
    if(confirm('Are you sure you want to delete this product?')) {
        api.delete('/admin/products/' + id, () => {
            loadProducts();
            showNotification('Product deleted');
        });
    }
}

// --- Orders ---
function loadOrders() {
    api.get('/admin/orders', function(res) {
        let html = '';
        res.forEach(o => {
            let total = o.items.reduce((sum, i) => sum + (i.prix_vente * i.qte), 0);
            html += `
            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                <td class="py-3 px-4 font-mono text-sm">${o.reference}</td>
                <td class="py-3 px-4">${o.client ? o.client.nom : 'Guest'}</td>
                <td class="py-3 px-4 font-bold">$${total.toFixed(2)}</td>
                <td class="py-3 px-4">
                    <select class="bg-black/20 border border-white/20 rounded px-2 py-1 text-sm outline-none" onchange="updateOrderStatus(${o.id}, this.value)">
                        <option value="pending" ${o.statut === 'pending'?'selected':''}>Pending</option>
                        <option value="paid" ${o.statut === 'paid'?'selected':''}>Paid</option>
                        <option value="delivered" ${o.statut === 'delivered'?'selected':''}>Delivered</option>
                        <option value="canceled" ${o.statut === 'canceled'?'selected':''}>Canceled</option>
                    </select>
                </td>
            </tr>`;
        });
        $('#orders-tbody').html(html);
    });
}

function updateOrderStatus(id, status) {
    api.put('/admin/orders/' + id + '/status', { statut: status }, () => {
        showNotification('Order status updated');
    });
}

// --- Categories ---
function loadCategories() {
    api.get('/categories', function(res) {
        let cats = Array.isArray(res) ? res : res.data;
        let html = '';
        cats.forEach(c => {
            html += `
            <tr class="border-b border-white/5">
                <td class="py-3 px-4">${c.id}</td>
                <td class="py-3 px-4 font-medium">${c.nom}</td>
                <td class="py-3 px-4 text-right">
                    <button class="text-red-400 hover:text-red-300" onclick="deleteCategory(${c.id})"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>`;
        });
        $('#categories-tbody').html(html);
    });
}

function saveCategory() {
    const data = { nom: $('#cat-nom').val() };
    api.post('/admin/categories', data, () => {
        $('#cat-nom').val('');
        loadCategories();
        showNotification('Category added');
    });
}

function deleteCategory(id) {
    if(confirm('Delete category?')) {
        api.delete('/admin/categories/' + id, () => { loadCategories(); showNotification('Deleted'); });
    }
}

// --- Customers ---
function loadCustomers() {
    api.get('/admin/users', function(res) {
        let html = '';
        res.forEach(c => {
            html += `
            <tr class="border-b border-white/5">
                <td class="py-3 px-4">${c.id}</td>
                <td class="py-3 px-4 font-bold text-white">${c.nom}</td>
                <td class="py-3 px-4 text-gray-400">${c.email}</td>
            </tr>`;
        });
        $('#customers-tbody').html(html);
    });
}

// --- Archives ---
function loadArchives() {
    api.get('/admin/products/archived', function(res) {
        let html = '';
        res.forEach(p => {
            html += `
            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                <td class="py-3 px-4 font-medium">${p.nom}</td>
                <td class="py-3 px-4">${p.category ? p.category.nom : '-'}</td>
                <td class="py-3 px-4 text-sm text-gray-400">${new Date(p.deleted_at).toLocaleDateString()}</td>
                <td class="py-3 px-4 text-right">
                    <button class="bg-emerald-600/20 text-emerald-400 hover:bg-emerald-600/40 px-3 py-1 rounded-lg text-xs font-bold transition-colors" onclick="restoreProduct(${p.id})">
                        <i class="fa-solid fa-rotate-left mr-1"></i> Restore
                    </button>
                </td>
            </tr>`;
        });
        $('#archives-tbody').html(html || '<tr><td colspan="4" class="py-8 text-center text-gray-500 text-sm italic">No archived items found.</td></tr>');
    });
}

function restoreProduct(id) {
    if(confirm('Restore this product?')) {
        api.post('/admin/products/' + id + '/restore', {}, function() {
            loadArchives();
            showNotification('Product restored successfully');
        });
    }
}
