<?php

namespace App\Observers;

use App\Models\Carts\Cart;
use App\Models\Orders\Order;
use App\Models\Products\Product;
use Illuminate\Support\Facades\Log;
use App\Events\ProductUnavailableEvent;

class ProductObserver
{
    public function updating(Product $product): void
    {
        Log::info('ProductObserver: Producto siendo actualizado', [
            'product_id' => $product->id,
            'is_active_dirty' => $product->isDirty('is_active'),
            'new_is_active' => $product->is_active,
            'old_is_active' => $product->getOriginal('is_active')
        ]);

        if ($product->isDirty('is_active') && !$product->is_active) {
            Log::info('ProductObserver: Producto desactivado, buscando carritos y órdenes afectados');

            // Broadcast para todos los invitados
            broadcast(new ProductUnavailableEvent('guest', 'all', $product));
            Log::info('ProductObserver: Enviado broadcast para todos los invitados');

            $activeCartsWithProduct = Cart::whereHas('products', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })->get();
    
            $activeOrdersWithProduct = Order::whereHas('products', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })->whereIn('status', ['Waiting', 'Production'])->get();
    
            Log::info('ProductObserver: Carritos y órdenes encontrados', [
                'carritos' => $activeCartsWithProduct->count(),
                'ordenes' => $activeOrdersWithProduct->count()
            ]);

            if ($activeCartsWithProduct->count() > 0 || $activeOrdersWithProduct->count() > 0) {
                foreach ($activeCartsWithProduct as $cart) {
                    if ($cart->user_id) {
                        broadcast(new ProductUnavailableEvent('user', $cart->user_id, $product));
                        Log::info('ProductObserver: Notificación enviada a usuario', ['user_id' => $cart->user_id]);
                    } elseif ($cart->guest_id) {
                        broadcast(new ProductUnavailableEvent('guest', $cart->guest_id, $product));
                        Log::info('ProductObserver: Notificación enviada a invitado', ['guest_id' => $cart->guest_id]);
                    }
                }
    
                foreach ($activeOrdersWithProduct as $order) {
                    if ($order->user_id) {
                        broadcast(new ProductUnavailableEvent('user', $order->user_id, $product));
                        Log::info('ProductObserver: Notificación enviada a usuario con orden', ['user_id' => $order->user_id]);
                    } elseif ($order->guest_id) {
                        broadcast(new ProductUnavailableEvent('guest', $order->guest_id, $product));
                        Log::info('ProductObserver: Notificación enviada a invitado con orden', ['guest_id' => $order->guest_id]);
                    }
                }
            }
        }
    }
}