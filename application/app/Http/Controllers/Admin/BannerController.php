<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\MonthlyAd;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Image;


class BannerController extends Controller
{
    public $pagination = 10;

    public function BannerIndex()
    {
        $data = array();
        $data['pageTitle'] = 'Banner | Admin';
        $data['banners'] = 'm-menu__item--open m-menu__item--expanded';
        $data['banners_list'] = 'm-menu__item--active';
        $data['banner'] = DB::table('banners')->paginate($this->pagination);
        return view('admin.banners.banner')->with($data);
    }


//Check the place already taken
    public function getJson(Request $request)
    {
        $getJsonData = $request->place;
        $checkData = Banner::where('sub_font', $getJsonData)->first();
        if ($checkData) {
            $message = '201';
            return \response()->json($message);
        } else {
            $message = '200';
            return \response()->json($message);
        }

    }

//end

    public function BannerAdd()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Banner'; // please use frontend name
        $data['banners'] = 'm-menu__item--open m-menu__item--expanded';
        $data['banners_list_add'] = 'm-menu__item--active';
//        $data['products_list'] = Product::latest()->get();
        return view('admin.banners.add')->with($data);
    }

    public function BannerStore(Request $request)
    {
        $checkRow = Banner::all();
        $getCount = $checkRow->count();

//        print_r($getCount);
//        exit();
        if ($getCount >= 2) {
            return redirect('admin/banner/')->with('error', 'More than two banner not acceptable!');
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'sub_font' => 'required',
                'image' => 'required|mimes:jpeg,png',
            ]);

            if ($validator->fails()) {
                return redirect('admin/banner/add')->withErrors($validator)->withInput();
            }
            $banner = new Banner();
            $banner->title = $request->title;
            $banner->sub_font = $request->sub_font;
            $banner->details = $request->details;
//        dd($banner);
//        exit();
//        $banner->save();

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = $banner->ads_name . '-' . time() . '.' . $extension;
            $thumbnailImage = Image::make($file);
            $thumbnailPath = 'assets/banner/';
            $thumbnailImage->resize(800, 800);
            $thumbnailImage->save($thumbnailPath . $filename);
            $upload_path = 'assets/banner/' . $filename;
            $banner->image = $upload_path;
            $banner->save();
            return redirect('admin/banner/')->with('message', 'Banner created Successfully');
        }


    }

    public function BannerEdit($id)
    {
        $data = array();
        $data['banner'] = Banner::find($id);

        if ($data['banner'] == null) {
            return back();
        } else {
            $data['pageTitle'] = 'Banner Ad Update - ' . $data['banner']->title; // please use frontend name
            $data['ads'] = 'm-menu__item--open m-menu__item--expanded';
            $data['ad_list'] = 'm-menu__item--active';
//            $data['products_list'] = Product::latest()->get();
            return view('admin.banners.edit')->with($data);
        }
    }

            public function BannerUpdate(Request $request)
            {
                $id = $request->id;


                $validator = Validator::make($request->all(), [
                    'title' => 'required|max:255',
                    'sub_font' => 'required',
                    'image' => 'required|mimes:jpeg,png',
                ]);


                $banner = Banner::find($id);
                $banner->title = $request->title;
                $banner->details = $request->details;
                $banner->sub_font = $request->sub_font;
        //        dd($banner);
                $banner->save();
                if ($request->hasfile('image')) {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $filename = $banner->title . '-' . time() . '.' . $extension;
                    $thumbnailImage = Image::make($file);
                    $thumbnailPath = 'assets/banner/';
                    $thumbnailImage->resize(800, 800);
                    $thumbnailImage->save($thumbnailPath . $filename);
                    $upload_path = 'assets/banner/' . $filename;
                    $banner->image = $upload_path;
                    $banner->save();
                }
                return redirect('admin/banner/')->with('message', 'Selected Banner Update successfully.');
            }

    public function BannerDelete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $banner = Banner::find($id);
            $banner->delete();
            $data['banner'] = DB::table('banners')->latest()->paginate($this->pagination)->setPath(url('admin/banner') . "?page=$request->page");
            return Response::json(View::make('admin.banners.render-banner', $data)->render());
        }
    }
}
