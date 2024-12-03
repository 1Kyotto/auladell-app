<?php

namespace App\Http\Controllers\Orders;

use App\Models\Orders\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController
{
    public function orderNumber()
    {
        return view('order.order-status');
    }

    public function status(Request $request)
    {
        $validated = $request->validate([
            'order-num' => 'required|string|max:10'
        ]);

        $order = Order::where('order_num', $validated['order-num'])
            ->with('shippingAddress')
            ->first();

        $statuses = ['Waiting', 'Production', 'Packaging', 'Shipped'];
        $currentStatus = $order->status;
        $filteredStatuses = array_slice($statuses, 0, array_search($currentStatus, $statuses) + 1);

        $status = $order->status;
        $city = $order->shippingAddress->city;
        $locality = $order->shippingAddress->locality;
        $address = $order->shippingAddress->address;
        $orderNumber = $order->order_num;

        return view('order.status', compact('status', 'city', 'locality', 'address', 'orderNumber', 'filteredStatuses'));
    }

    public function index()
    {
        $orders = Order::with(['user', 'products'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('dashboard.order', compact('orders'));
    }

    public function show(Order $order)
    {
        try {
            $order->load([
                'user',
                'guest',
                'products' => function($query) {
                    $query->with(['customizations']);
                },
                'products.customizationSelections' => function($query) use ($order) {
                    $query->whereHas('orderProduct', function($q) use ($order) {
                        $q->where('order_id', $order->id);
                    });
                },
                'products.customizationSelections.customizationOption.customization'
            ]);

            // Debug información
            Log::info('Order:', ['order' => $order->toArray()]);
            
            // Transformar los datos solo si hay productos
            if ($order->products) {
                $order->products->transform(function ($product) {
                    // Obtener las personalizaciones desde customizationSelections
                    $customizations = $product->customizationSelections;
                    Log::info('CustomizationSelections for product ' . $product->id . ':', [
                        'selections' => $customizations->toArray()
                    ]);
                    
                    return $product;
                });
            }

            return response()->json($order);
        } catch (\Exception $e) {
            // Log detallado del error
            Log::error('Error en OrderController@show: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Order ID: ' . $order->id);
            
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:Waiting,Production,Packaging,Shipped,Fulfilled,Cancelled'
            ]);

            $order->update([
                'status' => $validated['status']
            ]);

            return redirect()->route('admin.orders');
        } catch (\Exception $e) {
            Log::error('Error actualizando estado del pedido: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
