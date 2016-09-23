<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Order;
use Datatables;
use App\Detail;
use App\Status;
use App\Product;
use App\Task;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('inc/order/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('inc.order.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $re)
    {
        $order = new Order;
        $order->code = $re->code;
        $order->customer = $re->customer;
        $order->phone = $re->phone;
        $order->address = $re->address;
        $order->orderDate = $re->orderDate;
        $order->email = $re->email;
        $order->class = $re->class;
        $order->shipping = $re->shippingfee;
        $order->total = $re->total;
        $order->deposit = $re->deposit;
        $order->payment = $re->payment;
        $order->note = $re->orderNote;
        $order->status_id = 1;
        $order->user_id = 1;
        $order->save();

        $products = $re->item;
        $quantity = $re->quantity;
        $price = $re->price;
        foreach( $products as $cot => $sp  ){
            if($quantity[$cot] != 0)
            {
                $detail = new Detail;
                $detail->name = $sp;
                $detail->price = $price[$cot];
                $detail->quantity = $quantity[$cot];
                $order->detail()->save($detail);
            }
        }
        Task::create(array(
            'user_id' => \Auth::user()->id,
            'log' => 'Add a new order. Code: '.$order->code,
            ));
        return redirect('order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('status')->where('id','=', $id)->get();
        return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order->load('status','detail','user');
        $products = Product::all();
        return view('inc.order.edit', compact('order','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $re,Order $order)
    {
        $order->update($re->all());
        $details = $re->detail;
        $detail = array();
        foreach($details as $item){
            $detail[] = Detail::findOrFail($item);
        }
        foreach($detail as $item){
            $item->update(array(1,2));
        }
        // if(empty($detail))return 1; else return 2;
        // $products = $re->item;
        // $quantity = $re->quantity;
        // $price = $re->price;
        // foreach( $products as $cot => $sp  ){
        //     if($quantity[$cot] != 0)
        //     {
        //         $flag = false;
        //         foreach( $details as $de){
        //             if($item->name == $sp) $flag = true;
        //         }
        //         $detail = new Detail;
        //         $detail->name = $sp;
        //         $detail->price = $price[$cot];
        //         $detail->quantity = $quantity[$cot];
        //         $order->detail()->save($detail);
        //     }
        // }
                Task::create(array(
            'user_id' => \Auth::user()->id,
            'log' => 'Updated '.$order->code.' order.',
            ));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getOrderData() {
        $order = Order::with('detail', 'status', 'user')->get();
        return Datatables::of($order)->make(true);
    }

    public function getOrderStatus($id){
        $order[] = Status::get();
        $order[] = Order::where('id','=',$id)->get();
        return $order;
    }

    public function updateOrderStatus(request $re, $id){
        $order = Order::findOrFail($id);
        $order->status_id = $re->statusnew;
        $order->save();
        return back();
    }
    public function destroy($id)
    {
        //
    }
}
