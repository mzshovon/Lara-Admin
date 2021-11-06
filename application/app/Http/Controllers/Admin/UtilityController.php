<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\MonthlyAd;
use App\Product;
use App\PromoCode;
use App\Review;
use App\GetCoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Image;


class UtilityController extends Controller
{
    public $pagination = 10;

    public function couponIndex()
    {
        $data = array();
        $data['pageTitle'] = 'Coupons List | Admin';
        $data['coupons'] = 'm-menu__item--open m-menu__item--expanded';
        $data['coupon_list'] = 'm-menu__item--active';
        $data['coupons_list'] = GetCoupon::with('products')->latest()->paginate($this->pagination);
        return view('admin.coupons.coupons')->with($data);
    }

    public function couponAdd()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Coupon'; // please use frontend name
        $data['coupons'] = 'm-menu__item--open m-menu__item--expanded';
        $data['coupon_list'] = 'm-menu__item--active';
        $data['products_list'] = Product::latest()->get();
        return view('admin.coupons.add')->with($data);
    }

    public function couponStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_name' => 'required|max:255',
            'coupon_number' => 'required|digits_between:1,8',
            'coupon_price' => 'required|digits_between:1,8',
            'expire_date' => 'required',
            'image' => 'required|mimes:jpeg,png',
            'product_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/coupons/add')->withErrors($validator)->withInput();
        }
        $coupon = new GetCoupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_number = $request->coupon_number;
        $coupon->coupon_price = $request->coupon_price;
        $coupon->expire_date = $request->expire_date;
        $coupon->product_id = $request->product_id;
        $coupon->save();

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename =$coupon->coupon_name.'-'.time().'.'.$extension;
        $thumbnailImage = Image::make($file);
        $thumbnailPath = 'assets/img/coupons/';
        $thumbnailImage->resize(800,800);
        $thumbnailImage->save($thumbnailPath.$filename);
        $upload_path = 'assets/img/coupons/'.$filename;
        $coupon->image_path = $upload_path;
        $coupon->save();
        return redirect('admin/coupons/')->with('message', 'Coupon created successfully');
    }

    public function couponEdit($id)
    {
        $data = array();
        $data['coupon'] = GetCoupon::find($id);

        if ( $data['coupon'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Coupon Update - '.$data['coupon']->coupons_name; // please use frontend name
            $data['coupons'] = 'm-menu__item--open m-menu__item--expanded';
            $data['coupon_list'] = 'm-menu__item--active';
            $data['products_list'] = Product::latest()->get();
            return view('admin.coupons.edit')->with($data);
        }
    }

    public function couponUpdate(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'coupon_name' => 'required|max:255',
            'coupon_number' => 'required|digits_between:1,8',
            'coupon_price' => 'required|digits_between:1,8',
            'expire_date' => 'required',
            'image' => 'mimes:jpeg,png',
            'product_id' => 'required',
        ]);

        $coupon = GetCoupon::find($id);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_number = $request->coupon_number;
        $coupon->coupon_price = $request->coupon_price;
        $coupon->expire_date = $request->expire_date;
        $coupon->product_id = $request->product_id;
        $coupon->save();
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =$coupon->coupon_name.'-'.time().'.'.$extension;
            $thumbnailImage = Image::make($file);
            $thumbnailPath = 'assets/img/coupons/';
            $thumbnailImage->resize(800,800);
            $thumbnailImage->save($thumbnailPath.$filename);
            $upload_path = 'assets/img/coupons/'.$filename;
            $coupon->image_path = $upload_path;
            $coupon->save();
        }
        return redirect('admin/coupons/')->with('message', 'Selected Coupon Update successfully.');
    }

    public function couponDelete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $coupon = GetCoupon::find($id);
            $coupon->delete();
            $data['coupons_list'] = GetCoupon::with('products')->latest()->paginate($this->pagination)->setPath(url('admin/coupons')."?page=$request->page");
            return Response::json(View::make('admin.coupons.render-coupons', $data)->render());
        }
    }

    public function promoIndex()
    {
        $data = array();
        $data['pageTitle'] = 'Promos List | Admin';
        $data['promos'] = 'm-menu__item--open m-menu__item--expanded';
        $data['promo_lists'] = 'm-menu__item--active';
        $data['promo_list'] = PromoCode::latest()->paginate($this->pagination);
        return view('admin.promo_codes.promo-codes')->with($data);
    }

    public function promoAdd()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Coupon'; // please use frontend name
        $data['promos'] = 'm-menu__item--open m-menu__item--expanded';
        $data['add_promo'] = 'm-menu__item--active';
        return view('admin.promo_codes.add')->with($data);
    }

    public function promoStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'required|max:255',
            'status' => 'required',
            'percent' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/coupons/add')->withErrors($validator)->withInput();
        }
        $promo = new PromoCode();
        $promo->code = $request->promo_code;
        $promo->status = $request->status;
        $promo->percent = $request->percent;
        $promo->save();
        return redirect('admin/promos/')->with('message', 'Coupon created successfully');
    }

    public function promoEdit($id)
    {
        $data = array();
        $data['promo_list'] = PromoCode::find($id);

        if ( $data['promo_list'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Promo Update - '.$data['promo_list']->code; // please use frontend name
            $data['promo'] = 'm-menu__item--open m-menu__item--expanded';
            $data['promo_lists'] = 'm-menu__item--active';
            return view('admin.promo_codes.edit')->with($data);
        }
    }

    public function promoUpdate(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'promo_code' => 'required|max:255',
            'status' => 'required',
            'percent' => 'required',
        ]);

        $promo = PromoCode::find($id);
        $promo->code = $request->promo_code;
        $promo->status = $request->status;
        $promo->percent = $request->percent;
        $promo->save();
        return redirect('admin/promos/')->with('message', 'Selected Coupon Update successfully.');
    }

    public function promoDelete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $coupon = PromoCode::find($id);
            $coupon->delete();
            $data['promo_list'] = GetCoupon::latest()->paginate($this->pagination)->setPath(url('admin/promo_codes')."?page=$request->page");
            return Response::json(View::make('admin.promo_codes.render-promo-codes', $data)->render());
        }
    }

    public function monthlyAdIndex()
    {
        $data = array();
        $data['pageTitle'] = 'Monthly Ad | Admin';
        $data['ads'] = 'm-menu__item--open m-menu__item--expanded';
        $data['ad_list'] = 'm-menu__item--active';
        $data['ads_list'] = MonthlyAd::with('products')->latest()->paginate($this->pagination);
        return view('admin.monthly-ads.monthly-ads')->with($data);
    }

    public function monthlyAdAdd()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Category'; // please use frontend name
        $data['ads'] = 'm-menu__item--open m-menu__item--expanded';
        $data['ad_list'] = 'm-menu__item--active';
        $data['products_list'] = Product::latest()->get();
        return view('admin.monthly-ads.add')->with($data);
    }

    public function monthlyAdStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|mimes:jpeg,png',
            'product_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/monthly-ads/add')->withErrors($validator)->withInput();
        }
        $ads = new MonthlyAd();
        $ads->ads_name = $request->name;
        $ads->product_id = $request->product_id;
        $ads->save();

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename =$ads->ads_name.'-'.time().'.'.$extension;
        $thumbnailImage = Image::make($file);
        $thumbnailPath = 'assets/img/monthly-ads/';
        $thumbnailImage->resize(800,800);
        $thumbnailImage->save($thumbnailPath.$filename);
        $upload_path = 'assets/img/monthly-ads/'.$filename;
        $ads->image_path = $upload_path;
        $ads->save();
        return redirect('admin/monthly-ads/')->with('message', 'Monthly Ad created successfully');
    }

    public function monthlyAdEdit($id)
    {
        $data = array();
        $data['ad'] = MonthlyAd::find($id);

        if ( $data['ad'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Monthly Ad Update - '.$data['ad']->ads_name; // please use frontend name
            $data['ads'] = 'm-menu__item--open m-menu__item--expanded';
            $data['ad_list'] = 'm-menu__item--active';
            $data['products_list'] = Product::latest()->get();
            return view('admin.monthly-ads.edit')->with($data);
        }
    }

    public function monthlyAdUpdate(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'ads_name' => 'required|max:255',
            'image' => 'mimes:jpeg,png',
            'product_id' => 'required',
        ]);

        $ads = MonthlyAd::find($id);
        $ads->ads_name = $request->ads_name;
        $ads->product_id = $request->product_id;
        $ads->save();
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =$ads->ads_name.'-'.time().'.'.$extension;
            $thumbnailImage = Image::make($file);
            $thumbnailPath = 'assets/img/monthly-ads/';
            $thumbnailImage->resize(800,800);
            $thumbnailImage->save($thumbnailPath.$filename);
            $upload_path = 'assets/img/monthly-ads/'.$filename;
            $ads->image_path = $upload_path;
            $ads->save();
        }
        return redirect('admin/monthly-ads/')->with('message', 'Selected Ad Update successfully.');
    }

    public function monthlyAdDelete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $ads = MonthlyAd::find($id);
            $ads->delete();
            $data['ads_list'] = MonthlyAd::with('products')->latest()->paginate($this->pagination)->setPath(url('admin/monthly-ads')."?page=$request->page");
            return Response::json(View::make('admin.monthly-ads.render-monthly-ads', $data)->render());
        }
    }

    public function utilitiesIndex()
    {
        $data = array();
        $data['pageTitle'] = 'Utility Details | Admin';
        $data['utility'] = 'm-menu__item--active';
        $data['utilities'] = DB::table('utilities')->find(1);
        return view('admin.utilities.utilities')->with($data);
    }

    public function utilitiesEdit()
    {
        $data = array();
        $data['pageTitle'] = 'Utility Details | Admin';
        $data['utility'] = 'm-menu__item--active';
        $data['utilities'] = DB::table('utilities')->find(1);
        return view('admin.utilities.edit')->with($data);
    }

    public function utilitiesUpdate(Request $request)
    {
        DB::table('utilities')
            ->where('id', 1)
            ->limit(1)
            ->update(array('about_us' => $request->about_us,
                'privacy_statement' => $request->privacy_statement,
                'terms_conditions' => $request->terms_conditions,
                'shipment_policy' => $request->shipment_policy,
                'return_policy' => $request->return_policy,
                'how_to_return' => $request->how_to_return
            ));
        return redirect('admin/utilities/')->with('message', 'Utilities Update successfully.');
    }


    public function reviewsIndex(){
        $data = array();
        $data['pageTitle'] = 'Reviews Details | Admin';
        $data['review'] = 'm-menu__item--active';

        $data['reviews'] = Review::with('products')->paginate(20);

        return view('admin.reviews.reviews')->with($data);
    }


    public function reviewsEdit($id)
    {
        $data = array();
        $data['reviews'] = Review::find($id);

        if ($data['reviews'] == null) {
            return back();
        } else {
            $data['pageTitle'] = 'Reviews Update - ' . $data['reviews']->title; // please use frontend name
            $data['review'] = 'm-menu__item--open m-menu__item--expanded';
            $data['reviews_list'] = 'm-menu__item--active';
//            $data['products_list'] = Product::latest()->get();
            return view('admin.reviews.edit')->with($data);
        }
    }

    public function reviewsUpdate(Request $request)
    {
        $id = $request->id;


        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|max:255',
            'email' => 'required',
            'rating' => 'required',
        ]);


        $reviewss = Review::find($id);
        $reviewss->customer_name = $request->name;
        $reviewss->email = $request->email;
        $reviewss->rating = $request->rating;
        $reviewss->review = $request->reviews;

//        dd($reviewss);
// exit();
        $reviewss->save();
        return redirect('admin/reviews/')->with('message', 'Selected Review Update successfully.');
    }

    public function reviewsDelete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $banner = Review::find($id);
            $banner->delete();
            $data['reviews'] = Review::with('products')->paginate(20)->setPath(url('admin/reviews') . "?page=$request->page");
            return Response::json(View::make('admin.reviews.render-reviews', $data)->render());
        }
    }

}
