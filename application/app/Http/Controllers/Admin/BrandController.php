<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class BrandController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Brands';
        $data['brands'] = 'm-menu__item--open m-menu__item--expanded';
        $data['brand_list'] = 'm-menu__item--active';

        $brand_search = $request->brand_search;
        if ($brand_search){
            $data['brands_list'] = Brand::with('departments')->where('name', 'LIKE', '%' . $brand_search . '%')
                ->latest()->paginate($this->pagination)->setPath(url()->current()."?brand_search=".$brand_search);

        }
        else{
            $data['brands_list'] = Brand::with('departments')->latest()->paginate($this->pagination);
        }
        return view('admin.brands.brands')->with($data);
    }

    public function add()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Brand'; // please use frontend name
        $data['brands'] = 'm-menu__item--open m-menu__item--expanded';
        $data['add_brand'] = 'm-menu__item--active';
        $data['departments_list'] = Department::whereStatus(1)->latest()->get();
        return view('admin.brands.add')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('admin/brands/add')->withErrors($validator)->withInput();
        }
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->description = $request->description;
        $brand->department_id = $request->department_id;
        $brand->save();
        return redirect('admin/brands/')->with('message', 'Brand created successfully');
    }

    public function details($id)
    {
        $data = array();
        $data['department'] = Department::find($id);

        if ( $data['department'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Department Details - '.$data['department']->name; // please use department name
            $data['departments'] = 'm-menu__item--open m-menu__item--expanded';
            $data['department_list'] = 'm-menu__item--active';
            return view('admin.departments.detail')->with($data);
        }
    }

    public function edit($id)
    {
        $data = array();
        $data['brand'] = Brand::find($id);

        if ( $data['brand'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Brand Update - '.$data['brand']->name; // please use frontend name
            $data['brands'] = 'm-menu__item--open m-menu__item--expanded';
            $data['brand_list'] = 'm-menu__item--active';
            $data['departments_list'] = Department::whereStatus(1)->latest()->get();
            return view('admin.brands.edit')->with($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->department_id = $request->department_id;
        $brand->save();
        return redirect('admin/brands/')->with('message', 'Brand Update successfully.');
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $brand = Brand::find($id);
            $brand->delete();
            $data['brands_list'] = Brand::latest()->paginate($this->pagination)->setPath(url('admin/brands')."?page=$request->page");
            return Response::json(View::make('admin.brands.render-brands', $data)->render());
        }
    }

    public function changeStatus(Request $request)
    {

        if($request->ajax()){
            $id = $request->get('id');
            $brand = Brand::find($id);
            if ($brand->status == 1){
                $brand->status = 2;
                $brand->save();
            }
            else{
                $brand->status = 1;
                $brand->save();
            }
            $data['brands_list'] = Brand::latest()->paginate($this->pagination)->setPath(url('admin/brands')."?page=$request->page");
            return Response::json(View::make('admin.brands.render-brands', $data)->render());
        }
    }
}
