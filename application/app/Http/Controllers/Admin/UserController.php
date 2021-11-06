<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Department;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Users';
        $data['users'] = 'm-menu__item--open m-menu__item--expanded';
        $data['user_list'] = 'm-menu__item--active';

        $user_search = $request->user_search;
        if ($user_search){
            $data['users_list'] = User::with('orders')->where('name', 'LIKE', '%' . $user_search . '%')
                ->latest()->paginate($this->pagination)->setPath(url()->current()."?user_search=".$user_search);

        }
        else{
            $data['users_list'] = User::with('orders')->latest()->paginate($this->pagination);
        }
        return view('admin.users.users')->with($data);
    }

    public function details($id)
    {
        $data = array();
        $data['user'] = User::with('orders')->find($id);

        if ( $data['user'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Department Details - '.$data['user']->name; // please use department name
            $data['users'] = 'm-menu__item--open m-menu__item--expanded';
            $data['user_list'] = 'm-menu__item--active';
            return view('admin.users.detail')->with($data);
        }
    }

    public function edit($id)
    {
        $data = array();
        $data['user'] = User::find($id);

        if ( $data['user'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'User Update - '.$data['user']->name; // please use frontend name
            $data['users'] = 'm-menu__item--open m-menu__item--expanded';
            $data['user_list'] = 'm-menu__item--active';
            return view('admin.users.edit')->with($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->save();
        return redirect('admin/users/')->with('message', 'User Update successfully.');
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $user = User::find($id);
            $user->delete();
            $data['users_list'] = User::with('orders')->latest()->paginate($this->pagination)->setPath(url('admin/users')."?page=$request->page");
            return Response::json(View::make('admin.users.render-users', $data)->render());
        }
    }
}
