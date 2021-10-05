<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\Order as ResourcesOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        
        if($order->save()) {
            return new ResourcesOrder($order);
        }
    }

    public function getMyOrders()
    {
        $user_orders = Order::where('user_id', Auth::user()->id)->get();
        return ResourcesOrder::collection($user_orders);
    }
}
