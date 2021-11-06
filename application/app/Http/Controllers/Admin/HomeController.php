<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'Admin Dashboard';
        $data['dashboard'] = 'm-menu__item--active';
        return view('admin.dashboard.home')->with($data);
    }
}
