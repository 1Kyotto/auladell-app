<?php

namespace App\Http\Controllers\Orders;

use App\Models\Orders\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    public function orderNumber()
    {
        return view('order.order-status');
    }

    public function status(Request $request)
    {
        $validated = $request->validate([
            'order_num' => 'required|string|min:10|max:10|exists:orders,order_num',
        ],[
            'order_num.required' => 'El número de orden es obligatorio.',
            'order_num.string' => 'El número de orden debe ser un texto.',
            'order_num.min' => 'El número de orden debe tener al menos :min caracteres.',
            'order_num.max' => 'El número de orden no puede tener más de :max caracteres.',
            'order_num.exists' => 'El número de orden ingresado no existe en nuestros registros.',
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
}
