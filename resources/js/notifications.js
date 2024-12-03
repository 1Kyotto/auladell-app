import Swal from 'sweetalert2';

// Función para manejar notificaciones de productos
function handleProductNotifications() {
    const productId = document.querySelector('meta[name="product-id"]')?.content;
    console.log('Product ID encontrado:', productId);
    
    if (productId) {
        // Verificar si estamos en la página de detalle del producto
        const isProductPage = window.location.pathname.includes(`/jewelry/product/${productId}`);
        console.log('¿Es página de producto?:', isProductPage);
        
        window.Echo.channel('product-availability')
            .listen('ProductAvailabilityChanged', (e) => {
                console.log('Evento ProductAvailabilityChanged recibido:', e);
                console.log('Comparando productId:', e.productId, 'con', productId);
                console.log('isAvailable:', e.isAvailable);

                if (e.productId == productId && !e.isAvailable) {
                    console.log('Producto coincide y no está disponible');
                    showUnavailableNotification(true);
                }
            });
    }
}

// Mostrar notificación de producto no disponible
function showUnavailableNotification(shouldReload = false) {
    console.log('Mostrando notificación de producto no disponible, shouldReload:', shouldReload);
    return Swal.fire({
        title: 'Producto no disponible',
        text: 'Este producto ya no está disponible.',
        icon: 'warning',
        confirmButtonText: 'Entendido',
        confirmButtonColor: '#006C55',
        allowOutsideClick: false
    }).then((result) => {
        console.log('Usuario hizo clic en Entendido');
        if (shouldReload) {
            console.log('Recargando página...');
            window.location.reload();
        }
    });
}

// Mostrar notificación tipo toast
function showToastNotification(message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    return Toast.fire({
        icon: 'warning',
        title: message
    });
}

// Función para actualizar el estado del botón de pago
function updatePaymentButton(hasUnavailableProducts) {
    const paymentButton = document.getElementById('payment-button');
    if (!paymentButton) return;

    if (hasUnavailableProducts) {
        paymentButton.classList.remove('bg-[#008769]', 'text-cwhite-500');
        paymentButton.classList.add('bg-gray-300', 'cursor-not-allowed', 'text-gray-500');
        paymentButton.setAttribute('onclick', 'return false;');
    } else {
        paymentButton.classList.remove('bg-gray-300', 'cursor-not-allowed', 'text-gray-500');
        paymentButton.classList.add('bg-[#008769]', 'text-cwhite-500');
        paymentButton.removeAttribute('onclick');
    }
}

// Función para verificar productos no disponibles
function checkUnavailableProducts() {
    const cartItems = document.querySelectorAll('input[name="is_active"]');
    let hasUnavailableProducts = false;

    cartItems.forEach(item => {
        if (item.value === "0") {
            hasUnavailableProducts = true;
        }
    });

    return hasUnavailableProducts;
}

// Función para manejar el modal de eliminación de productos del carrito
window.openDeleteModal = function(button) {
    const form = button.closest('form');
    const isActive = form.querySelector('input[name="is_active"]').value === "1";
    
    let message = isActive ? 
        '¿Estás seguro de que deseas eliminar este producto del carrito?' : 
        'Este producto no está disponible. Debes eliminarlo para continuar con la compra.';
    
    Swal.fire({
        title: isActive ? 'Eliminar producto' : 'Producto no disponible',
        text: message,
        icon: isActive ? 'question' : 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.onsubmit = null;
            form.submit();
        }
    });
}

// Función para manejar notificaciones del carrito
function handleCartNotifications() {
    // Verificar estado inicial del botón
    updatePaymentButton(checkUnavailableProducts());

    window.Echo.channel('product-availability')
        .listen('ProductAvailabilityChanged', (e) => {
            console.log('Evento ProductAvailabilityChanged recibido en carrito:', e);
            const productId = e.productId;
            const isAvailable = e.isAvailable;
            
            // Verificar si estamos en la página del carrito
            const cartItems = document.querySelectorAll('input[name="product_id"]');
            if (cartItems.length === 0) {
                console.log('No estamos en la página del carrito');
                return;
            }

            // Verificar si el producto está en el carrito
            let productInCart = false;
            cartItems.forEach(item => {
                if (item.value == productId) {
                    productInCart = true;
                }
            });

            console.log('¿Producto en carrito?:', productInCart);
            console.log('¿Producto no disponible?:', !isAvailable);

            if (productInCart && !isAvailable) {
                console.log('Mostrando notificación de carrito');
                Swal.fire({
                    title: 'Producto no disponible',
                    text: 'Uno o más productos en tu carrito ya no están disponibles. Por favor, elimínalos para continuar con la compra.',
                    icon: 'warning',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#006C55',
                    allowOutsideClick: false
                }).then(() => {
                    console.log('Recargando página del carrito...');
                    window.location.reload();
                });
            }
        });
}

// Inicializar las notificaciones cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM cargado, inicializando notificaciones');
    console.log('window.Echo disponible:', !!window.Echo);
    
    if (window.Echo) {
        handleProductNotifications();
        handleCartNotifications();
    } else {
        console.log('Echo no está disponible');
    }
});