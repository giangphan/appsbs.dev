<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use Datatables;
use App\Detail;
use App\Status;
use App\Product;

class DatatablesController extends Controller
{
    public function dataOrders() {
        $order = Order::with('detail', 'status', 'user')->get();
        return Datatables::of($order)->make(true);
    }
}
