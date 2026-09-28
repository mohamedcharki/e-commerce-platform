let basePath = window.location.pathname.indexOf('/public') !== -1 ? window.location.pathname.substring(0, window.location.pathname.indexOf('/public') + 7) : '';
const API_BASE_URL = window.location.origin + basePath + '/api';

const api = {
    getToken: function() {
        return localStorage.getItem('aura_token');
    },
    
    getHeaders: function() {
        const token = this.getToken();
        return token ? { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' } : { 'Accept': 'application/json' };
    },

    get: function(endpoint, successCallback, errorCallback) {
        $.ajax({
            url: API_BASE_URL + endpoint,
            method: 'GET',
            headers: this.getHeaders(),
            dataType: 'json',
            success: successCallback,
            error: errorCallback || defaultErrorHandler
        });
    },

    post: function(endpoint, data, successCallback, errorCallback) {
        $.ajax({
            url: API_BASE_URL + endpoint,
            method: 'POST',
            headers: Object.assign({}, this.getHeaders(), {'Content-Type': 'application/json'}),
            data: JSON.stringify(data),
            dataType: 'json',
            success: successCallback,
            error: errorCallback || defaultErrorHandler
        });
    },
    
    put: function(endpoint, data, successCallback, errorCallback) {
        $.ajax({
            url: API_BASE_URL + endpoint,
            method: 'PUT',
            headers: Object.assign({}, this.getHeaders(), {'Content-Type': 'application/json'}),
            data: JSON.stringify(data),
            dataType: 'json',
            success: successCallback,
            error: errorCallback || defaultErrorHandler
        });
    },
    
    delete: function(endpoint, successCallback, errorCallback) {
        $.ajax({
            url: API_BASE_URL + endpoint,
            method: 'DELETE',
            headers: this.getHeaders(),
            dataType: 'json',
            success: successCallback,
            error: errorCallback || defaultErrorHandler
        });
    }
};

function defaultErrorHandler(xhr, status, error) {
    console.error("API Error:", status, error);
    let msg = 'An error occurred while communicating with the server.';
    if(xhr.responseJSON && xhr.responseJSON.message) {
        msg = xhr.responseJSON.message;
    }
    
    // Auto-logout if token is invalid or expired
    if (xhr.status === 401) {
        localStorage.removeItem('aura_token');
        window.location.href = '/admin/login';
        return;
    }
    
    showNotification(msg, 'error');
}

function showNotification(message, type = 'success') {
    const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
    const container = $('#notification-container');
    
    if (container.length === 0) {
        $('body').append('<div id="notification-container" class="fixed top-20 right-4 z-[9999] flex flex-col gap-2"></div>');
    }
    
    const notification = $(`
        <div class="${bgColor} text-white px-6 py-3 rounded shadow-lg transform transition-all duration-300 translate-x-full opacity-0 flex items-center justify-between min-w-[250px]">
            <span>${message}</span>
            <button class="ml-4 text-white hover:text-gray-200" onclick="$(this).parent().remove()">&times;</button>
        </div>
    `);
    
    $('#notification-container').append(notification);
    
    setTimeout(() => { notification.removeClass('translate-x-full opacity-0'); }, 10);
    
    setTimeout(() => {
        notification.addClass('opacity-0 translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}
