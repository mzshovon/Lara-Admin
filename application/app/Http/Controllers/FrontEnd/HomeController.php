<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\GetCoupon;
use App\MonthlyAd;
use Carbon\Carbon;
use Cart;
use App\Department;
use App\Product;
use App\OrderDetail;
use App\Banner;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public $pagination = 20;
    public function __construct()
    {
        $cart_list = Cart::content();
        View::share('cart_list', $cart_list);
    }

    public function index()
    {
        $data = array();
        $data['departments'] = Department::with('categories')->latest()->get();
        $data['banners'] = DB::table('banners')->get();
        $data['sliders'] = DB::table('sliders')->get();
        $data['products'] = Product::with('categories', 'brands', 'productimages')->whereStatus(1)->limit(8)->latest()->get();
        $top_sales = DB::table('order_details')->latest()->get();
        $data['top_saling'] = array();
        foreach ($top_sales as $top_sale) {
            $data['tops'] = Product::with('categories', 'brands', 'productimages')->whereId($top_sale->product_id)->whereStatus(1)->first();
            array_push($data['top_saling'], $data['tops']);
        }
        $data['top_sales'] = array_unique($data['top_saling']);
        $data['categories'] = DB::table('categories')->get();
        return view('frontend.home')->with($data);
    }


    public function featuredProducts()
    {
        $data = array();
        $data['departments'] = Department::with('categories')->latest()->get();
        $data['banners'] = DB::table('banners')->get();
        $data['sliders'] = DB::table('sliders')->get();
        $data['products'] = Product::with('categories', 'brands', 'productimages')->whereStatus(1)->latest()->paginate($this->pagination);
        $top_sales = DB::table('order_details')->latest()->get();
        $data['top_saling'] = array();
        foreach ($top_sales as $top_sale) {
            $data['tops'] = Product::with('categories', 'brands', 'productimages')->whereId($top_sale->product_id)->whereStatus(1)->first();
            array_push($data['top_saling'], $data['tops']);
        }
        $data['top_sales'] = array_unique($data['top_saling']);
        return view('frontend.show_more_featured')->with($data);
    }
    public function featured_categories()
    {
        $data['departments'] = Department::with('categories')->latest()->get();
        $data['banners'] = DB::table('banners')->get();
        $data['sliders'] = DB::table('sliders')->get();
        $data['categories'] = DB::table('categories')->join('category_images','categories.id','=','category_images.cat_id')->limit(8)->get();
        return view('frontend.show_more_featured_categories')->with($data);
    }


    public function searchProducts(Request $request)
    {

        $product = $request->get('product_name');

        $data['products'] = Product::with('categories', 'brands', 'productimages')->whereStatus(1)->where('name', 'LIKE',  '%' . $product . '%')
            ->get();
        $data['departments'] = Department::with('categories')->latest()->get();
        return view('frontend.search_product')->with($data);
    }

    public function productDetails($id)
    {
        $data = array();
        $data['product'] = Product::with('categories', 'brands', 'productimages')->find($id);
        $data['products'] = Product::with('categories', 'brands', 'productimages')->where('id', '!=', $id)->whereStatus(1)->whereCategoryId($data['product']->category_id)->latest()->get();
        $data['departments'] = Department::with('categories')->latest()->get();
        $data['reviews'] = DB::table('reviews')->where('product_id',$id)->get();
        $data['coupons'] = GetCoupon::whereDate('expire_date','>=','CURDATE()');
        if ($data['product'] == null || @$data['product']->status == 2) {
            return back();
        } else {
            $data['pageTitle'] = 'Product Details - ' . $data['product']->name; // please use department name
            return view('frontend.product-details')->with($data);
        }
        return view('frontend.product-details')->with($data);
    }

    public function categoryProduct($id)
    {
        $data = array();
        $data['pageTitle'] = 'Specific Category Product';
        $data['products'] = Product::with('categories', 'brands', 'productimages')->whereStatus(1)->whereCategoryId($id)->latest()->get();
        $data['departments'] = Department::with('categories')->latest()->get();
        return view('frontend.category-products')->with($data);
    }

    public function newItem()
    {
        $data = array();
        $data['pageTitle'] = 'New Product';
        $data['products'] = Product::with('categories', 'brands', 'productimages')->whereStatus(1)->where('created_at', '>=', Carbon::now()->subDays(7)->startOfDay())->latest()->get();
        $data['departments'] = Department::with('categories')->latest()->get();
        return view('frontend.new-items')->with($data);
    }

    public function getCoupon()
    {
        $data = array();
        $data['pageTitle'] = 'Specific Category Product';
        $data['products'] = Product::with('categories', 'brands', 'productimages')->whereStatus(1)->latest()->get();
        $data['departments'] = Department::with('categories')->latest()->get();
        return view('frontend.category-products')->with($data);
    }

    public function monthlyAd()
    {
        $data = array();
        $data['pageTitle'] = 'Monthly Ad Product';
        $data['ads'] = MonthlyAd::with('products')->where('created_at', '>=', Carbon::now()->startOfMonth())->latest()->get();
        $data['departments'] = Department::with('categories')->latest()->get();
        return view('frontend.monthly-ads')->with($data);
    }
    public function store_review(Request $request)
    {

        $data = new Review();
        $data['customer_name'] = $request->customer_name;
        $data['email'] = $request->email;
        $data['product_id'] = $request->product_id;
        $data['rating'] = $request->rating;
        $data['review'] = $request->review;
        $data->save();
//        $data['pageTitle'] = 'Monthly Ad Product';
//        $data['ads'] = MonthlyAd::with('products')->where('created_at', '>=', Carbon::now()->startOfMonth())->latest()->get();
//        $data['departments'] = Department::with('categories')->latest()->get();
        return redirect()->to('product/'.$data['product_id']);
    }

}
