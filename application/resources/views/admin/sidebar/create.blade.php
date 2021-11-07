@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back!</h4>
                <span>Element</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Sidebar</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$title}}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sidebar Menu Create Form</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form class="form-valide" action="{{url('admin/sidebar-menus/add')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Menu Name <span class="text-danger">*</span></label>
                                    <input type="text" name="menu" class="form-control" placeholder="ex. Product">
                                    {!! $errors->first('menu', '<div class="invalid-feedback animated fadeInUp" style="display:block">:message</div>') !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Description (Optional)</label>
                                    <input type="text" name="description" class="form-control" placeholder="1234 Main St">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option selected>Choose...</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    {!! $errors->first('status', '<div class="invalid-feedback animated fadeInUp" style="display:block">:message</div>') !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Reference Menu</label>
                                    <select name="preference" class="form-control">
                                        <option disabled selected>Choose...</option>
                                        @forelse ($menu_list as $item)
                                            <option value="{{$item->id}}">{{$item->menu}}</option>
                                        @empty 
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Set Route <span class="text-danger">*</span></label>
                                    <select name="set_route" class="form-control">
                                        <option disabled selected>Choose...</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Routes</label>
                                    <select name="route" class="form-control">
                                        <option disabled selected>Choose...</option>
                                        @forelse ($route_list as $list)
                                            <option value="{{$list->uri()}}">{{$list->uri()}}</option>
                                        @empty 
                                        @endforelse
                                    </select>
                                    {!! $errors->first('route', '<div class="invalid-feedback animated fadeInUp" style="display:block">The route field is required when set route is Yes.</div>') !!}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection