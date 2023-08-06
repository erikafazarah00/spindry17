<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Promotion;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = 1;
        $orders = Order::where('user_id', $user_id)->with(['promotion', 'service'])->get();
        $data = [
            'status' => 'success',
            'message' => 'Berikut data order',
            'data' => $orders
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource. // API TIDAK PUNYA BLADEKARNA FORM ADA ID BLADE 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'service_id' => 'required',
            'weight' => 'required|numeric',
            'date' => 'required',
        ]);
        
        $promo = Promotion::where('id', $request->promo_id)->first();
        $discount = $promo ? $promo->discount : 0;
        $service = Service::where('id', $request->service_id)->first();
        $total_price = ($request->weight * $service->price) * (100 - $discount)/100;
        
        $order = Order::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'promo_id' => $promo ? $request->promo_id : NULL,
            'weight' => $request->weight,
            'date' => $request->date,
            'total_price' => $total_price,
        ]);

        $data = [
            'status' => 'seccess',
            'message' => 'Data order berhasil ditambahkan',
            'data' => $order
        ];
        return response()->json($data);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        $data = [
            'status' => 'seccess',
            'message' => 'Data order berhasil dihapus',
            'data' => $order
        ];
        return response()->json($data);
    }
}
