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
use App\SidebarMenu;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Image;
use Session;
class UtilityController extends Controller
{
    public $pagination = 10;

    public function __construct()
    {
        $sidebar_menus = SidebarMenu::whereStatus(1)->wherePreference(0)->get();
        View::share('sidebar_menus',$sidebar_menus);
    }
   
    public function view_side_menus()
    {
        $data = array();
        $data['title'] = 'Sidebar List | Admin';
        $data['sidebar_open'] = 'm-menu__item--open m-menu__item--expanded';
        $data['sidebar_active_menu'] = 'm-menu__item--active';
        $data['sidebar_menus_lists'] = SidebarMenu::orderBy('menu','ASC')->get();
        return view('admin.sidebar.view')->with($data);
    }

    public function add_side_menus()
    {
        $data = array();
        $data['title'] = 'Add New Sidebar Menu'; // please use frontend name
        $data['sidebar_open'] = 'm-menu__item--open m-menu__item--expanded';
        $data['sidebar_add_active_menu'] = 'm-menu__item--active';
        $data['menu_list'] = SidebarMenu::all();
        $data['route_list'] = Route::getRoutes();
        return view('admin.sidebar.create')->with($data);
    }

    public function insert_side_menus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu' => 'required|max:255',
            'status' => 'required|in:0,1',
            'route' => 'required_if:set_route,==,1',
        ]);

        if ($validator->fails()) {
            return redirect('admin/sidebar-menus/add')->withErrors($validator)->withInput();
        }
        if (SidebarMenu::whereRaw("UPPER(menu) =(?)",[strtoupper($request->menu)])->first()) {
            Session::flash('error_message','Sidebar with name '.$request->menu.' already exists');
            return redirect('admin/sidebar-menus/add'); 
        }
        if ($request->route) {
            if (SidebarMenu::whereRaw("UPPER(route) =(?)",[strtoupper($request->route)])->first()) {
                Session::flash('error_message','Sidebar with route '.$request->route.' already exists');
                return redirect('admin/sidebar-menus/add'); 
            } 
        }
        $sidebar = new SidebarMenu();
        $sidebar->menu = $request->menu;
        $sidebar->status = $request->status;
        $sidebar->preference = $request->preference ?? 0;
        $sidebar->description = $request->description ?? null;
        $sidebar->set_route = $request->set_route ?? 0;
        $sidebar->route = $request->route ?? null;
        // dd($sidebar);
        if ($sidebar->save()) {
            Session::flash('success_message','Sidebar with name '.$request->menu.' created successfully');
            return redirect('admin/sidebar-menus/add');
        }
    }

    public function edit_side_menus($id)
    {
        $data = array();
        $data['menu'] = SidebarMenu::find($id);
        if ( $data['menu'] == null){
            return back();
        }
        else{
            $data['title'] = $data['menu']->menu;
            $data['menu_list'] = SidebarMenu::all();
            $data['route_list'] = Route::getRoutes();
            return view('admin.sidebar.edit')->with($data);
        }
    }

    public function update_side_menus(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'menu' => 'required|max:255',
            'status' => 'required|in:0,1',
            'route' => 'required_if:set_route,==,1',
        ]);

        if ($validator->fails()) {
            return redirect('admin/sidebar-menus/edit/'.$id)->withErrors($validator)->withInput();
        }
        if (SidebarMenu::whereRaw("UPPER(menu) =(?)",[strtoupper($request->menu)])->whereNotIn('id',[$id])->first()) {
            Session::flash('error_message','Sidebar with name '.$request->menu.' already exists');
            return redirect('admin/sidebar-menus/edit/'.$id); 
        }
        if ($request->route) {
            if (SidebarMenu::whereRaw("UPPER(route) =(?)",[strtoupper($request->route)])->whereNotIn('id',[$id])->first()) {
                Session::flash('error_message','Sidebar with route '.$request->route.' already exists');
                return redirect('admin/sidebar-menus/edit/'.$id); 
            } 
        }
        $sidebar = SidebarMenu::find($id);
        $sidebar->menu = $request->menu;
        $sidebar->status = $request->status;
        $sidebar->preference = $request->preference ?? 0;
        $sidebar->description = $request->description ?? null;
        $sidebar->set_route = $request->set_route ?? 0;
        $sidebar->route = $request->route ?? null;
        // dd($sidebar);
        if ($sidebar->save()) {
            Session::flash('success_message','Sidebar with name '.$request->menu.' updated successfully');
            return redirect('admin/sidebar-menus/edit/'.$id);
        }
    }

    public function delete_side_menus(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $sidebar = SidebarMenu::find($id);
            // $sidebar->delete();
            $data['sidebar_menus_lists'] = SidebarMenu::orderBy('menu','ASC')->get();
            return Response::json(View::make('admin.sidebar.render-view', $data)->render());
        }
    }

}
