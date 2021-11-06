<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class DepartmentController extends Controller
{
    public $pagination = 10;
    public function index(Request $request)
    {
        $data = array();
        $data['pageTitle'] = 'Departments';
        $data['departments'] = 'm-menu__item--open m-menu__item--expanded';
        $data['department_list'] = 'm-menu__item--active';

        $department_search = $request->department_search;
        if ($department_search){
            $data['departments_list'] = Department::where('name', 'LIKE', '%' . $department_search . '%')
                ->paginate($this->pagination)->setPath(url()->current()."?department_search=".$department_search);

        }
        else{
            $data['departments_list'] = Department::paginate($this->pagination);
        }
        return view('admin.departments.departments')->with($data);
    }

    public function add()
    {
        $data = array();
        $data['pageTitle'] = 'Add New Department'; // please use frontend name
        $data['departments'] = 'm-menu__item--open m-menu__item--expanded';
        $data['add_department'] = 'm-menu__item--active';
        return view('admin.departments.add')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('admin/departments/add')->withErrors($validator)->withInput();
        }
        $department = new Department();
        $department->name = $request->name;
        $department->status = $request->status;
        $department->description = $request->description;
        $department->save();

        /*if ($request->file('image')) {
            $user_id = $frontend->id; // frontend id
            $image = $request->file('image'); //image call from request
            $imageName = time() . $image->getClientOriginalName(); //get image original name
            $uploadPath = 'assets/users_image/' . $user_id . '/'; //upload path in variable
            $image->move($uploadPath, $imageName); //image move into the directory
            $image_url = $uploadPath . $imageName; //concrete image url
            $frontend->image_url = $image_url; // image url upload in database
            $frontend->save();
        }*/
        return redirect('admin/departments/')->with('message', 'Department created successfully');
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
        $data['department'] = Department::find($id);

        if ( $data['department'] == null){
            return back();
        }
        else{
            $data['pageTitle'] = 'Department Details - '.$data['department']->name; // please use frontend name
            $data['departments'] = 'm-menu__item--open m-menu__item--expanded';
            $data['department_list'] = 'm-menu__item--active';
            return view('admin.departments.edit')->with($data);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $department = Department::find($id);
        $department->name = $request->name;
        $department->description = $request->description;

        $department->save();
        return redirect('admin/departments/')->with('message', 'Department Update successfully.');
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $department = Department::find($id);
            $department->delete();
            $data['departments_list'] = Department::paginate($this->pagination)->setPath(url('admin/departments')."?page=$request->page");
            return Response::json(View::make('admin.departments.render-departments', $data)->render());
        }
    }

    public function changeStatus(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            $department = Department::find($id);
            if ($department->status == 1){
                $department->status = 2;
                $department->save();
            }
            else{
                $department->status = 1;
                $department->save();
            }
            $data['departments_list'] = Department::paginate($this->pagination)->setPath(url('admin/departments')."?page=$request->page");
            return Response::json(View::make('admin.departments.render-departments', $data)->render());
        }
    }
}
