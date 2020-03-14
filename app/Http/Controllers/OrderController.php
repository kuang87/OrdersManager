<?php

namespace App\Http\Controllers;

use App\Mail\OrderCompleted;
use App\Order;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(50);
        return view('main.order.index', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('main.order.form', [
            'order' => $order,
            'partners' => Partner::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'email' => 'required|email',
            'partner' => 'required|exists:partners,id',
            'status' => 'required|in:0,10,20',
        ]);

        $data = $request->all();

        $order->client_email =$data['email'];
        $order->partner_id = $data['partner'];
        $order->status = $data['status'];
        $order->save();


        if ($order->status == 20){
            foreach ($order->products as $product){
                $vendors[] = $product->vendor->email;
            }

            Mail::to($order->partner->email)
                ->cc($vendors ?? '')
                ->queue(new OrderCompleted($order));
        }

        return redirect()->route('orders.index')->with('message', 'Order edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
