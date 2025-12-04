/**
 * Cart functionality for adding items with AJAX and showing notifications
 */

document.addEventListener('DOMContentLoaded', function() {
    // Handle all add-to-cart forms
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');
    
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const button = form.querySelector('button[type="submit"]');
            const originalText = button.textContent;
            
            // Disable button and show loading state
            button.disabled = true;
            button.textContent = 'Ajout...';
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count in header
                    updateCartCount(data.cartCount);
                    
                    // Show success notification
                    showNotification(data.message, 'success');
                    
                    // Visual feedback on button
                    button.textContent = '✓ Ajouté !';
                    button.classList.add('btn-success-temp');
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.classList.remove('btn-success-temp');
                        button.disabled = false;
                    }, 1500);
                } else {
                    showNotification(data.message || 'Une erreur est survenue', 'error');
                    button.textContent = originalText;
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Une erreur est survenue', 'error');
                button.textContent = originalText;
                button.disabled = false;
            });
        });
    });
    
    /**
     * Update cart count badge in header
     */
    function updateCartCount(count) {
        const cartBadges = document.querySelectorAll('.cart-count');
        cartBadges.forEach(badge => {
            badge.textContent = count;
            
            // Add animation
            badge.classList.add('cart-count-updated');
            setTimeout(() => {
                badge.classList.remove('cart-count-updated');
            }, 300);
        });
    }
    
    /**
     * Show notification toast
     */
    function showNotification(message, type = 'success') {
        // Remove existing notifications
        const existingNotification = document.querySelector('.cart-notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `cart-notification cart-notification-${type}`;
        notification.innerHTML = `
            <div class="cart-notification-content">
                <span class="cart-notification-icon">${type === 'success' ? '✓' : '✗'}</span>
                <span class="cart-notification-message">${message}</span>
                <a href="/panier" class="cart-notification-link">Voir le panier</a>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Trigger animation
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
});
