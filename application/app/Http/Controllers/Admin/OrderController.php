<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Orders';
        $data['order'] = 'm-menu__item--active';


        $data['orders_list'] = Order::with( ['users', 'shippings'=>function($q){
            $q->with('regions');
        },'orderdetails'=>function($query){
            $query->with('products');
        }])->latest()->paginate($this->pagination);

        return view('admin.orders.orders')->with($data);
    }

    public function details($id)
    {
        $data = array();
        $data['orders'] = Order::with( ['users','payments', 'shippings'=>function($q){
            $q->with('regions');
        },'orderdetails'=>function($query){
            $query->with('products');
        }])->find($id);

        if ( $data['orders'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Order Details';
            $data['order'] = 'm-menu__item--active';
            return view('admin.orders.detail')->with($data);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $brand = Order::find($id);
            $brand->delete();
            $data['orders_list'] = Order::with( ['users', 'shippings'=>function($q){
                $q->with('regions');
            },'orderdetails'=>function($query){
                $query->with('products');
            }])->latest()->paginate($this->pagination)->setPath(url('admin/orders')."?page=$request->page");
            return Response::json(View::make('admin.orders.render-orders', $data)->render());
        }
    }

    public function pendingStatus(Request $request)
    {

        if($request->ajax()){
            $id = $request->get('id');
            $order = Order::find($id);
            $order->order_status = 1;
            $order->save();

            $data['orders_list'] = Order::with( ['users', 'shippings'=>function($q){
                $q->with('regions');
            },'orderdetails'=>function($query){
                $query->with('products');
            }])->latest()->paginate($this->pagination)->setPath(url('admin/orders')."?page=$request->page");
            return Response::json(View::make('admin.orders.render-orders', $data)->render());
        }
    }

    public function completeStatus(Request $request)
    {

        if($request->ajax()){
            $id = $request->get('id');
            $order = Order::find($id);
            $order->order_status = 2;
            $order->save();
            $data['orders_list'] = Order::with( ['users', 'shippings'=>function($q){
                $q->with('regions');
            },'orderdetails'=>function($query){
                $query->with('products');
            }])->latest()->paginate($this->pagination)->setPath(url('admin/orders')."?page=$request->page");
            return Response::json(View::make('admin.orders.render-orders', $data)->render());
        }
    }

    public function cancelStatus(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $order = Order::find($id);
            $order->order_status = 3;
            $order->save();
            $data['orders_list'] = Order::with( ['users', 'shippings'=>function($q){
                $q->with('regions');
            },'orderdetails'=>function($query){
                $query->with('products');
            }])->latest()->paginate($this->pagination)->setPath(url('admin/orders')."?page=$request->page");
            return Response::json(View::make('admin.orders.render-orders', $data)->render());
        }
    }
}
