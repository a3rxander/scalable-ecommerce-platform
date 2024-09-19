<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        
        // Acceder al usuario autenticado que se añadió en el middleware
        $user = $request->auth_user;
        
        // Obtener las órdenes del usuario
        $orders = Order::where('user_id', $user->id)->get();

        return response()->json($orders);
    }

    public function store(OrderRequest $request)
    {
        // Crear un nuevo pedido
        $order = Order::create($request->validated());
        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        // Mostrar un pedido específico
        return response()->json($order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        // Actualizar un pedido
        $order->update($request->validated());
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        // Eliminar un pedido
        $order->delete();
        return response()->json(null, 204);
    }
}
 
