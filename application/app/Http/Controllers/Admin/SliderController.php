<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Image;
class SliderController extends Controller
{
    public $pagination = 10;

    public function SliderIndex()
    {
        $data = array();
        $data['pageTitle'] = 'Slider | Admin';
        $data['sliders'] = 'm-menu__item--open m-menu__item--expanded';
        $data['sliders_list'] = 'm-menu__item--active';
        $data['slider'] = DB::table('sliders')->paginate($this->pagination);
        return view('admin.sliders.slider')->with($data);
    }


    public function SliderAdd()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Slider'; // please use frontend name
        $data['sliders'] = 'm-menu__item--open m-menu__item--expanded';
        $data['sliders_list_add'] = 'm-menu__item--active';
//        $data['products_list'] = Product::latest()->get();
        return view('admin.sliders.add')->with($data);
    }

    public function SliderStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
//            'title' => 'required|max:255',
//                'sub_font' => 'required',
            'image' => 'required|mimes:jpeg,png',
        ]);

        if ($validator->fails()) {
            return redirect('admin/sliders/add')->withErrors($validator)->withInput();
        }
        $slider = new Slider();
        $slider->title = $request->title;

//        dd($banner);
//        exit();
//        $banner->save();

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename = $slider->ads_name . '-' . time() . '.' . $extension;
        $thumbnailImage = Image::make($file);
        $thumbnailPath = 'assets/banner/';
//            $thumbnailImage->resize(800, 800);
        $thumbnailImage->save($thumbnailPath . $filename);
        $upload_path = 'assets/banner/' . $filename;
        $slider->image = $upload_path;
        $slider->save();
        return redirect('admin/slider/')->with('message', 'Slider created Successfully');
    }

    public function SliderEdit($id)
    {
        $data = array();
        $data['slider'] = Slider::find($id);

        if ($data['slider'] == null) {
            return back();
        } else {
            $data['pageTitle'] = 'Slider Ad Update - ' . $data['slider']->title; // please use frontend name
            $data['sliders'] = 'm-menu__item--open m-menu__item--expanded';
            $data['sliders_list'] = 'm-menu__item--active';
//            $data['products_list'] = Product::latest()->get();
            return view('admin.sliders.edit')->with($data);
        }
    }

    public function SliderUpdate(Request $request)
    {
        $id = $request->id;


        $validator = Validator::make($request->all(), [
//            'title' => 'required|max:255',
//            'sub_font' => 'required',
            'image' => 'required|mimes:jpeg,png',
        ]);


        $slider = Slider::find($id);
        $slider->title = $request->title;
//        $banner->details = $request->details;
//        $banner->sub_font = $request->sub_font;
//        dd($banner);
        $slider->save();
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = $slider->title . '-' . time() . '.' . $extension;
            $thumbnailImage = Image::make($file);
            $thumbnailPath = 'assets/banner/';
//            $thumbnailImage->resize(800, 800);
            $thumbnailImage->save($thumbnailPath . $filename);
            $upload_path = 'assets/banner/' . $filename;
            $slider->image = $upload_path;
            $slider->save();
        }
        return redirect('admin/slider/')->with('message', 'Selected Slider Update successfully.');
    }

    public function SliderDelete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $slider = Slider::find($id);
            $slider->delete();
            $data['slider'] = DB::table('sliders')->latest()->paginate($this->pagination)->setPath(url('admin/banner') . "?page=$request->page");
            return Response::json(View::make('admin.sliders.render-slider', $data)->render());
        }
    }

}
