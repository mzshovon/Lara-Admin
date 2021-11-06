<?php

namespace App\Http\Controllers\FrontEnd;

use App\Department;
use App\Product;
use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CartController extends Controller
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

            public function addCart(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $quantity = $request->get('quantity');
            $productById = Product::find($id);
            Cart::add([
                'id'=>$id,
                'name'=>$productById->name,
                'price'=>$productById->new_price,
                'qty'=>$quantity,
                'weight'=>$productById->weight,
            ]);
            $data = array();
            $data['cart_list'] = Cart::content();
            return Response::json(View::make('frontend.layouts.includes.cart', $data)->render());
        }
    }

    public function index()
    {
        return view('frontend.cart');
    }

    public function delete(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($rowId);
        Session::forget('percentage');
        return redirect('/cart-list');

    }

    public function update(Request $request)
    {
        $rowId = $request->rowId;
        Cart::update($rowId, $request->quantity);
        return redirect('/cart-list');
    }

    public function setDiscount(Request $request)
    {
       $rowId = $request->rowId;
       $tax =Cart::priceTotal($decimals = 0, $decimalPoint = null, $thousandSeperator = '');
       $main = (int)$tax+1000;
       return redirect('/cart-list');
    }

    public function paymentForm()
    {
        return view('frontend.payment');
    }
}
