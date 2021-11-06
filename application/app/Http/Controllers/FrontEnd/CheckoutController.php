<?php

namespace App\Http\Controllers\FrontEnd;

use App\Department;
use App\Order;
use App\OrderDetail;
use App\Region;
use App\Shipping;
use App\ShippingCost;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\Types\Float_;
use Session;
use Cart;
use Unicodeveloper\Paystack\Facades\Paystack;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $departments = Department::with('categories')->latest()->get();
        $product_images = DB::table('product_images')
            ->groupBy('product_id')
            ->get();
        View::share('departments', $departments);
        View::share('product_images', $product_images);
    }

    public function index()
    {
        $data = array();
        $data['regions'] = Region::all();
        $data['status'] = NULL;
        return view('frontend.checkout')->with($data);
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $data = array();
            $id = $request->get('id');
            $cart_total = Cart::count();
            $cart_weight = Cart::weight();
            $cost_info = ShippingCost::whereRegionId($id)->first();
            if (empty($cost_info)) {
                Session::put('shipping_cost', 0);
            } else {
                $shipping_cost = $cost_info->cost;
                Session::put('shipping_cost', $shipping_cost);
            }
            if ($request->get('promo_code')) {
                $coupon_info = DB::table('promo_code')->where('code','=',$request->get('promo_code'))->where('status','=','1')->first();
                if ($request->get('shipping_charge') > 0) {
                    Session::put('shipping_cost', $request->get('shipping_charge'));
                } else {
                    Session::put('shipping_cost', 0);
                }
                if (empty($coupon_info)) {
                    Session::put('percentage', 0);
                    $data['status'] = 401;
                    return Response::json(View::make('frontend.render-checkout',$data)->render());
                } else if ($coupon_info) {
                    $percentage = $coupon_info->percent;
                    Session::put('percentage', $percentage);
                    $data['status'] = 200;
                    return Response::json(View::make('frontend.render-checkout',$data)->render());
                }
            } else {
                $data['status'] = NULL;
                return Response::json(View::make('frontend.render-checkout',$data)->render());
            }
        }
    }

    public function orderPlace(Request $request)
    {
        $shipping = new Shipping();
        $shipping->name = $request->name;
        $shipping->email = $request->email;
        $shipping->phone = $request->phone;
        $shipping->region_id = $request->region_id;
        $shipping->address = $request->address;
        $shipping->customer_notes = $request->customer_notes;
        $shipping->save();

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->shipping_id = $shipping->id;
        $shipping_charge = (int)Session::get('shipping_cost');
        $order->total_amount =(int)(str_replace(',','',Cart::subtotal()))+$shipping_charge;
//        dd($order);
//        exit();
        $order->save();

        $orderDetail = new OrderDetail();
        $cartProducts = Cart::content();
        foreach ($cartProducts as $cartProduct) {
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartProduct->id;
            $orderDetail->product_quantity = $cartProduct->qty;
            $orderDetail->save();
        }
        $data = array();
        $data['order_id'] = $order->id;
        $data['total_amouxnt'] = $order->total_amount * 100;
        $data['email'] = $shipping->email;
        $data['quantity'] = count(Cart::content());
        $data['reference'] = Paystack::genTranxRef();
        $payment = new Payment();
        $payment->reference = $data['reference'];
        $payment->order_id = $order->id;
        $payment->save();
        Session::put('payment_id', $payment->id);

        //-------------- cash on delivery ----------------->
        $datas = array();
        $datas['orders'] = Order::with( ['users','payments', 'shippings'=>function($q){
            $q->with('regions');
        },'orderdetails'=>function($query){
            $query->with('products');
        }])->find( $data['order_id']);

        if ( $datas['orders'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Order Completion';
            $data['order'] = 'm-menu__item--active';

            return view('frontend.order_complete_status');
        }
        //<-------- cash on delivery end here ----------------------->

//        return view('frontend.cash_on_delivery')->with($data);

    }


    public function trackIndex(){

        $id = Auth::id();
        $datas['order_list'] = Order::where("user_id","=",$id)->get();
        return view('frontend.track_order')->with($datas);
//        dd($datas['order_list']);
//        exit();
    }

    public function checkDetails($id){
        $data['order_id']=$id;
        $datas['orders'] = Order::with( ['users','payments', 'shippings'=>function($q){
            $q->with('regions');
        },'orderdetails'=>function($query){
            $query->with('products');
        }])->find($data['order_id']);
        return view('frontend.cash_on_delivery')->with($datas);

    }
}
