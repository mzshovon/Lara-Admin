<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Department;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Image;

class ProductController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Products';
        $data['products'] = 'm-menu__item--open m-menu__item--expanded';
        $data['product_list'] = 'm-menu__item--active';

        $product_search = $request->product_search;
        if ($product_search){
            $data['products_list'] = Product::with('categories', 'brands')->where('name', 'LIKE', '%' . $product_search . '%')
                ->latest()->paginate($this->pagination)->setPath(url()->current()."?product_search=".$product_search);

        }
        else{
            $data['products_list'] = Product::with('categories', 'brands')->latest()->paginate($this->pagination);
        }
        return view('admin.products.products')->with($data);
    }

    public function add()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Product'; // please use frontend name
        $data['products'] = 'm-menu__item--open m-menu__item--expanded';
        $data['add_product'] = 'm-menu__item--active';
        $data['categories_list'] = Category::whereStatus(1)->latest()->get();
        $data['brands_list'] = Brand::whereStatus(1)->latest()->get();
        return view('admin.products.add')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'sku' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'old_price' => 'nullable|digits_between:1,8',
            'new_price' => 'required|digits_between:1,8',
            'quantity' => 'required|digits_between:1,4',
            'weight' => 'nullable|between:0,10000.99',
            'category_id' => 'required',
            'brand_id' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($validator->fails()) {
            return redirect('admin/products/add')->withErrors($validator)->withInput();
        }
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->old_price = $request->old_price;
        $product->new_price = $request->new_price;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();
        if($request->hasfile('images'))
        {
            $i = 1;
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =$product->name.'-'.$i.'.'.$extension;
                $thumbnailImage = Image::make($file);
                if (!file_exists('assets/img/products/'.$product->id)) {
                    mkdir('assets/img/products/'.$product->id, 0777, true);
                }
                $thumbnailPath = 'assets/img/products/'.$product->id.'/';
                $thumbnailImage->resize(800,800);
                $thumbnailImage->save($thumbnailPath.$filename);

                $upload_path = 'assets/img/products/'.$product->id.'/'.$filename;
                $products_image = new ProductImage();
                $products_image->image_path = $upload_path;
                $products_image->product_id = $product->id;
                $products_image->save();
                $i++;
            }
        }
        return redirect('admin/products/')->with('message', 'Product created successfully');
    }

    public function details($id)
    {
        $data = array();
        $data['product'] = Product::with('categories', 'brands', 'productimages')->find($id);

        if ( $data['product'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Product Details - '.$data['product']->name; // please use department name
            $data['products'] = 'm-menu__item--open m-menu__item--expanded';
            $data['product_list'] = 'm-menu__item--active';
            return view('admin.products.detail')->with($data);
        }
    }

    public function edit($id)
    {
        $data = array();
        $data['product'] = Product::with('categories', 'brands', 'productimages')->find($id);

        if ( $data['product'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Product Update - '.$data['product']->name; // please use frontend name
            $data['products'] = 'm-menu__item--open m-menu__item--expanded';
            $data['product_list'] = 'm-menu__item--active';
            $data['categories_list'] = Category::whereStatus(1)->latest()->get();
            $data['brands_list'] = Brand::whereStatus(1)->latest()->get();
            return view('admin.products.edit')->with($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate( [
            'name' => 'required|max:255',
            'sku' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'old_price' => 'nullable|digits_between:1,8',
            'new_price' => 'required|digits_between:1,8',
            'quantity' => 'required|digits_between:1,4',
            'weight' => 'nullable|between:0,10000.99',
            'category_id' => 'required',
            'brand_id' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->old_price = $request->old_price;
        $product->new_price = $request->new_price;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->save();
        if($request->hasfile('images'))
        {
            ProductImage::whereProductId($request->id)->delete();
            $i = 1;
            foreach($request->file('images') as $file)
            {
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =$product->name.'-'.$i.'.'.$extension;
                $thumbnailImage = Image::make($file);
                if (!file_exists('assets/img/products/'.$product->id)) {
                    mkdir('assets/img/products/'.$product->id, 0777, true);
                }
                $thumbnailPath = 'assets/img/products/'.$product->id.'/';
                $thumbnailImage->resize(800,800);
                $thumbnailImage->save($thumbnailPath.$filename);

                $upload_path = 'assets/img/products/'.$product->id.'/'.$filename;
                $products_image = new ProductImage();
                $products_image->image_path = $upload_path;
                $products_image->product_id = $product->id;
                $products_image->save();
                $i++;
            }
        }
        return redirect('admin/products/')->with('message', 'Product Update successfully.');
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            ProductImage::whereProductId($id)->delete();
            Product::find($id)->delete();

            $data['products_list'] = Product::with('categories', 'brands')->latest()->paginate($this->pagination)->setPath(url('admin/products')."?page=$request->page");
            return Response::json(View::make('admin.products.render-products', $data)->render());
        }
    }

    public function changeStatus(Request $request)
    {

        if($request->ajax()){
            $id = $request->get('id');
            $product = Product::find($id);
            if ($product->status == 1){
                $product->status = 2;
                $product->save();
            }
            else{
                $product->status = 1;
                $product->save();
            }
            $data['products_list'] = Product::with('categories','brands')->latest()->paginate($this->pagination)->setPath(url('admin/products')."?page=$request->page");
            return Response::json(View::make('admin.products.render-products', $data)->render());
        }
    }
}
