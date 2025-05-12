<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Return paginated orders with selected fields for frontend
        $orders = Order::select('id', 'order_number', 'created_at', 'pack_type', 'price', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['shippingType', 'variants.article'])->findOrFail($id);

        $data = [
            'name' => $order->name,
            'email' => $order->email,
            'city' => $order->city,
            'address' => $order->address,
            'apartment_floor' => $order->comment ?? '',
            'phone' => $order->phone,
            'postal_code' => '', // Not present in model
            'total_order' => $order->totalPrice(),
            'delivery_mode' => $order->shippingType ? $order->shippingType->name : '',
            'payment_type' => '', // Not present in model
            'payment_code' => '', // Not present in model
            'order_info' => $order, // Include full order info for "Commande Info" tab
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate status input
        $validated = $request->validate([
            'status' => 'required|string|in:En attente,Confirmé,Annulé',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}
