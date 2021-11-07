<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SidebarMenu;

class HomeController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'Admin Dashboard';
        $data['dashboard'] = 'm-menu__item--active';
        $data['sidebar_menus'] = SidebarMenu::whereStatus(1)->wherePreference(0)->get();
        return view('admin.dashboard.home')->with($data);
    }
}
