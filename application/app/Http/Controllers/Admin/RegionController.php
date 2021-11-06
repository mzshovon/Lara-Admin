<?php

namespace App\Http\Controllers\Admin;

use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class RegionController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Regions';
        $data['regions'] = 'm-menu__item--open m-menu__item--expanded';
        $data['region_list'] = 'm-menu__item--active';

        $region_search = $request->region_search;
        if ($region_search){
            $data['regions_list'] = Region::where('name', 'LIKE', '%' . $region_search . '%')
                ->latest()->paginate($this->pagination)->setPath(url()->current()."?region_search=".$region_search);

        }
        else{
            $data['regions_list'] = Region::latest()->paginate($this->pagination);
        }
        return view('admin.regions.regions')->with($data);
    }

    public function add()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Region'; // please use frontend name
        $data['regions'] = 'm-menu__item--open m-menu__item--expanded';
        $data['add_region'] = 'm-menu__item--active';
        return view('admin.regions.add')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('admin/regions/add')->withErrors($validator)->withInput();
        }
        $region = new Region();
        $region->name = $request->name;
        $region->code = $request->code;
        $region->save();
        return redirect('admin/regions/')->with('message', 'Region created successfully');
    }

    public function edit($id)
    {
        $data = array();
        $data['region'] = Region::find($id);

        if ( $data['region'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Region Update - '.$data['region']->name; // please use frontend name
            $data['regions'] = 'm-menu__item--open m-menu__item--expanded';
            $data['region_list'] = 'm-menu__item--active';
            return view('admin.regions.edit')->with($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $region = Region::find($id);
        $region->name = $request->name;
        $region->code = $request->code;
        $region->save();
        return redirect('admin/regions/')->with('message', 'Region Update successfully.');
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $region = Region::find($id);
            $region->delete();
            $data['regions_list'] = Region::latest()->paginate($this->pagination)->setPath(url('admin/regions')."?page=$request->page");
            return Response::json(View::make('admin.regions.render-regions', $data)->render());
        }
    }
}
