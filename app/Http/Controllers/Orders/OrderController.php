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
}
