$(document).ready(function() {
    const loadComponents = async () => {
        try {
            await $.get('components/navbar.html', function(data) {
                $('#navbar-placeholder').html(data);
            });
            await $.get('components/footer.html', function(data) {
                $('#footer-placeholder').html(data);
            });
        } catch (e) {
            console.error("Error loading components", e);
        }
    };

    loadComponents();

    // Init cart & mini cart (navbar is server-side rendered via Blade)
    updateCartCount();
    initMiniCart();

    $(document).on('click', '#mobile-menu-button', function() {
        $('#mobile-menu').removeClass('hidden');
    });

    $(document).on('click', '#close-mobile-menu', function() {
        $('#mobile-menu').addClass('hidden');
    });
});

/* ── Mini Cart ─────────────────────────────── */
function initMiniCart() {
    // Toggle on cart button click
    $(document).on('click', '#mini-cart-btn', function(e) {
        e.stopPropagation();
        const $dropdown = $('#mini-cart-dropdown');
        if ($dropdown.hasClass('hidden')) {
            renderMiniCart();
            $dropdown.removeClass('hidden').addClass('mini-cart-open');
        } else {
            $dropdown.addClass('hidden').removeClass('mini-cart-open');
        }
    });

    // Close when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#mini-cart-wrapper').length) {
            $('#mini-cart-dropdown').addClass('hidden').removeClass('mini-cart-open');
        }
    });

    // Remove item from mini cart
    $(document).on('click', '.mini-cart-remove', function() {
        const id = $(this).data('id');
        Cart.removeItem(id);
        renderMiniCart();
        updateCartCount();
    });
}

function renderMiniCart() {
    const items = Cart.getItems();
    const $itemsContainer = $('#mini-cart-items');
    const $empty = $('#mini-cart-empty');
    const $footer = $('#mini-cart-footer');
    const $countLabel = $('#mini-cart-count-label');
    const $total = $('#mini-cart-total');

    // Remove previously rendered items (keep empty state)
    $itemsContainer.find('.mini-cart-item').remove();

    if (items.length === 0) {
        $empty.removeClass('hidden');
        $footer.addClass('hidden');
        $countLabel.text('0 items');
        return;
    }

    $empty.addClass('hidden');
    $footer.removeClass('hidden');

    const totalQty = items.reduce((s, i) => s + i.quantity, 0);
    $countLabel.text(totalQty + (totalQty === 1 ? ' item' : ' items'));
    $total.text(parseFloat(Cart.getTotal()).toFixed(2) + ' MAD');

    items.forEach(function(item) {
        let images = [];
        try { images = typeof item.images === 'string' ? JSON.parse(item.images) : (item.images || []); } catch(e){}
        const imgSrc = (images && images.length > 0 && images[0].startsWith('http'))
            ? images[0]
            : 'https://placehold.co/80x80?text=?';

        const html = `
            <div class="mini-cart-item flex items-center gap-3 py-3">
                <img src="${imgSrc}" alt="${item.nom}" class="w-14 h-14 rounded-xl object-cover bg-gray-50 flex-shrink-0 border border-gray-100">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">${item.nom}</p>
                    <p class="text-xs text-gray-400 mt-0.5">${parseFloat(item.prix_vente).toFixed(2)} MAD</p>
                    <span class="inline-block mt-1 text-[11px] font-bold text-gray-500 bg-gray-100 rounded-full px-2 py-0.5">x${item.quantity}</span>
                </div>
                <button class="mini-cart-remove w-7 h-7 flex items-center justify-center rounded-full hover:bg-red-50 text-gray-300 hover:text-red-400 transition-colors flex-shrink-0" data-id="${item.id}" title="Remove">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>`;
        $itemsContainer.append(html);
    });
}

function formatPrice(price) {
    return '$' + parseFloat(price).toFixed(2);
}

function getProductCardHTML(product, index = 0) {
    let images = [];
    try {
        images = typeof product.images === 'string' ? JSON.parse(product.images) : product.images;
    } catch (e) {
        if (product.image) images = [product.image];
    }
    
    let firstImage = (images && images.length > 0) ? images[0] : 'https://placehold.co/400x400?text=No+Image';
    const imageUrl = firstImage.startsWith('http') ? firstImage : API_BASE_URL.replace('/api', '/storage/') + firstImage;
    
    const price = product.prix_vente || product.prix || product.price || 0;
    
    // Logic for badges based on index or product properties
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

    return `
        <div class="product-card group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full border border-gray-100">
            ${badgeHTML}
            <a href="product.html?id=${product.id}" class="p-6 pb-2 flex-shrink-0 relative block bg-gray-50/50 group-hover:bg-white transition-colors duration-300">
                <div class="product-img-wrapper relative z-10 w-full aspect-[4/3] flex items-center justify-center overflow-hidden rounded-xl">
                    <img src="${imageUrl}" alt="${product.nom || product.name}" class="group-hover:scale-110 transition-transform duration-500 object-contain h-full w-full drop-shadow-md mix-blend-multiply">
                </div>
            </a>
            <div class="p-6 flex flex-col flex-1 items-center text-center relative z-10 bg-white">
                ${starsHTML}
                <div class="text-[10px] font-bold text-gray-400 mb-2 uppercase tracking-[0.2em]">${product.categorie?.nom || product.category?.name || 'Tech Gear'}</div>
                <a href="product.html?id=${product.id}" class="block mb-2">
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-1 tracking-tight">${product.nom || product.name}</h3>
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
}

