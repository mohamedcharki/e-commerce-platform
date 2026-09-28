// Cart logic using LocalStorage
const Cart = {
    key: 'ecommerce_cart',
    
    getItems: function() {
        const items = localStorage.getItem(this.key);
        return items ? JSON.parse(items) : [];
    },
    
    saveItems: function(items) {
        localStorage.setItem(this.key, JSON.stringify(items));
        updateCartCount();
    },
    
    addItem: function(product, quantity = 1) {
        const items = this.getItems();
        const existingItem = items.find(item => item.id == product.id);
        
        let qty = parseInt(quantity);
        if (existingItem) {
            existingItem.quantity += qty;
        } else {
            // Store standardized attributes only
            items.push({
                id: product.id,
                nom: product.nom,
                prix_vente: parseFloat(product.prix_vente),
                images: product.images,
                quantity: qty
            });
        }
        
        this.saveItems(items);
        showNotification('Item added to cart!');
    },
    
    removeItem: function(productId) {
        let items = this.getItems();
        items = items.filter(item => item.id != productId);
        this.saveItems(items);
        showNotification('Item removed from cart.', 'error');
    },
    
    updateQuantity: function(productId, quantity) {
        const items = this.getItems();
        const item = items.find(i => i.id == productId);
        if (item) {
            item.quantity = parseInt(quantity);
            if (item.quantity <= 0) {
                this.removeItem(productId);
                return;
            }
            this.saveItems(items);
        }
    },
    
    clear: function() {
        localStorage.removeItem(this.key);
        updateCartCount();
    },
    
    getTotal: function() {
        const items = this.getItems();
        return items.reduce((total, item) => {
            const price = parseFloat(item.prix_vente) || 0;
            return total + (price * item.quantity);
        }, 0);
    }
};

function updateCartCount() {
    const items = Cart.getItems();
    const count = items.reduce((total, item) => total + item.quantity, 0);
    const badge = $('#cart-count');
    
    if (count > 0) {
        badge.text(count).removeClass('hidden');
    } else {
        badge.addClass('hidden').text(0);
    }
}
