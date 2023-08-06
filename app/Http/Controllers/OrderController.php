<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $q = $request->q;
        $pagination = $request->has('pagination') ? $request->pagination : 10;
        if ($q) {
            $orders = Order::where('title', 'like', '%' . $q . '%')->paginate($pagination);
        } else {
            $orders = Order::paginate($pagination);
        }
        // return $heroes;
        return view('pages.order', compact('orders', 'q', 'pagination'));


        // $array = [
        //     'nama' => 'jokowi',
        //     'jabatan' => 'presiden dulu',
        //     'negara' => 'indonesia raya',
        // ];
        // return $array;
        // // return response()->json($array); bisa kek ini 
    }

    /**
     * Show the form for creating a new resource.
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
