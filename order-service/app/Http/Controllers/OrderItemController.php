<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    // Listar ítems de una orden específica
    public function index($orderId)
    {
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        return response()->json($orderItems);
    }

    // Crear un nuevo ítem en una orden
    public function store(Request $request, $orderId)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Asegurarse de que la orden existe
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $orderItem = new OrderItem();
        $orderItem->order_id = $orderId;
        $orderItem->product_id = $request->product_id;
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $request->price;
        $orderItem->save();

        return response()->json($orderItem, 201);
    }
}
