<?php

namespace App\Events;

use App\Models\Products\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductUnavailableEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;
    public $id;
    public $product;
    public $message;

    public function __construct($type, $id, Product $product)
    {
        $this->type = $type;
        $this->id = $id;
        $this->product = $product;
        $this->message = "El producto {$product->name} ya no se encuentra disponible.";
    }

    public function broadcastOn()
    {
        return new Channel("{$this->type}.{$this->id}");
    }

    public function broadcastAs()
    {
        return 'product.unavailable';
    }
}