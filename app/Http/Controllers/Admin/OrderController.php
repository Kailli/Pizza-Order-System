<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orderList(){
        $data= Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name as pizza_name', DB::raw( 'COUNT(orders.pizza_id) as count'))
                    ->join('users','users.id','orders.customer_id')
                    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                    ->groupBy('orders.customer_id','orders.pizza_id')
                    ->paginate(7);

        return view('admin.order.list')->with(['order'=>$data]);
    }

    public function searchOrder(Request $request){
        $data= Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name as pizza_name', DB::raw( 'COUNT(orders.pizza_id) as count'))
                    ->join('users','users.id','orders.customer_id')
                    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                    ->orwhere('users.name','like','%'.$request->searchData.'%')
                    ->orwhere('pizzas.pizza_name','like','%'.$request->searchData.'%')
                    ->groupBy('orders.customer_id','orders.pizza_id')
                    ->paginate(7);
        $data->append($request->all());
        return view('admin.order.list')->with(['order'=>$data]);
    }
}
