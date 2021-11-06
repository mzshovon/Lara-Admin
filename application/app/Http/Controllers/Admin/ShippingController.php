<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Region;
use App\ShippingCost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ShippingController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Shipping Cost';
        $data['shipping_costs'] = 'm-menu__item--open m-menu__item--expanded';
        $data['shipping_cost_list'] = 'm-menu__item--active';

        $shipping_cost_search = $request->shipping_cost_search;
        if ($shipping_cost_search){
            $data['shipping_costs_list'] = ShippingCost::with('regions')->where('region_name', 'LIKE', '%' . $shipping_cost_search . '%')
                ->latest()->paginate($this->pagination)->setPath(url()->current()."?shipping_cost_search=".$shipping_cost_search);

        }
        else{
            $data['shipping_costs_list'] = ShippingCost::with('regions')->latest()->paginate($this->pagination);
        }
        return view('admin.shipping.shipping')->with($data);
    }

    public function add()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Shipping Cost'; // please use frontend name
        $data['shipping_costs'] = 'm-menu__item--open m-menu__item--expanded';
        $data['add_shipping_costs'] = 'm-menu__item--active';
        $data['regions'] = Region::all();
        return view('admin.shipping.add')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'region_id' => 'required',
//            'weight_range' => 'required|integer|between:1,5000',
            'cost' => 'required|between:1,99999.99',
        ]);

        if ($validator->fails()) {
            return redirect('admin/shipping/add')->withErrors($validator)->withInput();
        }
        $shipping = new ShippingCost();
        $shipping->region_id = $request->region_id;
        $shipping->weight_range = $request->weight_range;
        $shipping->cost = $request->cost;
        $shipping->save();
        return redirect('admin/shipping/')->with('message', 'Shipping created successfully');
    }

    public function edit($id)
    {
        $data = array();
        $data['shipping'] = ShippingCost::with('regions')->find($id);
        $data['regions'] = Region::all();

        if ( $data['shipping'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Shipping Cost Update - '.$data['shipping']->region_name; // please use frontend name
            $data['shipping_costs'] = 'm-menu__item--open m-menu__item--expanded';
            $data['shipping_cost_list'] = 'm-menu__item--active';
            return view('admin.shipping.edit')->with($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'region_id' => 'required',
            'weight_range' => 'required|integer|between:1,5000',
            'cost' => 'required|between:1,99999.99',
        ]);

        $shipping = ShippingCost::find($id);
        $shipping->region_id = $request->region_id;
        $shipping->weight_range = $request->weight_range;
        $shipping->cost = $request->cost;
        $shipping->save();
        return redirect('admin/shipping/')->with('message', 'Shipping Cost Update successfully.');
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $shipping = ShippingCost::find($id);
            $shipping->delete();
            $data['shipping_costs_list'] = ShippingCost::latest()->paginate($this->pagination)->setPath(url('admin/shipping')."?page=$request->page");
            return Response::json(View::make('admin.shipping.render-shipping', $data)->render());
        }
    }
}
