<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Department;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Image;

class CategoryController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Categories';
        $data['categories'] = 'm-menu__item--open m-menu__item--expanded';
        $data['category_list'] = 'm-menu__item--active';

        $category_search = $request->category_search;
        if ($category_search){
            $data['categories_list'] = Category::with('departments')->where('name', 'LIKE', '%' . $category_search . '%')
                ->latest()->paginate($this->pagination)->setPath(url()->current()."?category_search=".$category_search);

        }
        else{
            $data['categories_list'] = Category::with('departments')->latest()->paginate($this->pagination);
        }
        return view('admin.categories.categories')->with($data);
    }

    public function add()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Category'; // please use frontend name
        $data['categories'] = 'm-menu__item--open m-menu__item--expanded';
        $data['add_category'] = 'm-menu__item--active';
        $data['departments_list'] = Department::whereStatus(1)->latest()->get();
        return view('admin.categories.add')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('admin/categories/add')->withErrors($validator)->withInput();
        }
        $category = new Category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->description = $request->description;
        $category->department_id = $request->department_id;
        $category->save();
        if($request->hasfile('images'))
        {
            $i = 1;
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =$category->name.'-'.$i.'.'.$extension;
                $thumbnailImage = Image::make($file);
                if (!file_exists('assets/img/products/'.$category->id)) {
                    mkdir('assets/img/products/'.$category->id, 0777, true);
                }
                $thumbnailPath = 'assets/img/products/'.$category->id.'/';
                $thumbnailImage->resize(800,800);
                $thumbnailImage->save($thumbnailPath.$filename);

                $upload_path = 'assets/img/products/'.$category->id.'/'.$filename;

                $data = array(
                    'image_path'=>$upload_path,
                    'cat_id'=>$category->id
                    );
                $insert_image = DB::table('category_images')->insert($data);
                $i++;
            }
        }
        return redirect('admin/categories/')->with('message', 'Category created successfully');
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
        $data['category'] = Category::find($id);

        if ( $data['category'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Category Update - '.$data['category']->name; // please use frontend name
            $data['categories'] = 'm-menu__item--open m-menu__item--expanded';
            $data['category_list'] = 'm-menu__item--active';
            $data['departments_list'] = Department::whereStatus(1)->latest()->get();
            return view('admin.categories.edit')->with($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->department_id = $request->department_id;
        $category->save();

        if($request->hasfile('images'))
        {
                $file = $request->file('images');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =$category->name.'-'.time().'.'.$extension;
                $thumbnailImage = Image::make($file);
                if (!file_exists('assets/img/products/'.$category->id)) {
                    mkdir('assets/img/products/'.$category->id, 0777, true);
                }
                $thumbnailPath = 'assets/img/products/'.$category->id.'/';
                $thumbnailImage->resize(800,800);
                $thumbnailImage->save($thumbnailPath.$filename);

                $upload_path = 'assets/img/products/'.$category->id.'/'.$filename;

                $data = array(
                    'image_path'=>$upload_path,
                    'cat_id'=>$category->id
                );
                $insert_image = DB::table('category_images')->where('cat_id',$id)->update(['image_path'=>$data['image_path']]);
                if(!$insert_image){
                    $insert_images = DB::table('category_images')->insert($data);
                }
        }


        return redirect('admin/categories/')->with('message', 'Category Update successfully.');
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $category = Category::find($id);
            $category->delete();
            $data['categories_list'] = Category::latest()->paginate($this->pagination)->setPath(url('admin/categories')."?page=$request->page");
            return Response::json(View::make('admin.categories.render-categories', $data)->render());
        }
    }

    public function changeStatus(Request $request)
    {

        if($request->ajax()){
            $id = $request->get('id');
            $category = Category::find($id);
            if ($category->status == 1){
                $category->status = 2;
                $category->save();
            }
            else{
                $category->status = 1;
                $category->save();
            }
            $data['categories_list'] = Category::latest()->paginate($this->pagination)->setPath(url('admin/categories')."?page=$request->page");
            return Response::json(View::make('admin.categories.render-categories', $data)->render());
        }
    }
}
