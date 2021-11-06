@extends('admin.layouts.app')
@section('styles')
@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Add Product</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Add Product</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    {{----}}
                </div>
            </div>
        </div>
        <!-- END: Subheader -->

        <div class="m-content">
            <!--begin::Portlet-->
            <form class="m-portlet m-portlet--last m-portlet--head m-portlet--responsive-mobile"
                  method="POST" action="{{url('admin/products/add/')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="m-form m-form--label-align-left- m-form--state-" id="m_form">
                    <!--begin: Form Body -->
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="m-form__section m-form__section--first">
                                    <div class="row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">&nbsp;</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="m-form__heading mb-0">
                                                <h3 class="m-form__heading-title mb-0">Product Details</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" {{ $errors->has('name') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Name: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="name" value="{{old('name')}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('name', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('sku') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">SKU: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="sku" value="{{old('sku')}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('sku', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="bio" class="col-xl-3 col-lg-3 col-form-label text-right">Short Description:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="short_description" id="short_description" class="form-control" rows="3">{{old('short_description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="bio" class="col-xl-3 col-lg-3 col-form-label text-right">Long Description:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="long_description" id="long_description" class="form-control" rows="3">{{old('long_description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{@$errors->has('category_id') ? 'has-error' : ''}}>
                                        <label for="category_id" class="col-xl-3 col-lg-3 col-form-label text-right">Category: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select name="category_id" id="category_id" class="plxSelect2 form-control" required>
                                                <option value="">--Select--</option>
                                                @forelse($categories_list as $category)
                                                <option value="{{@$category->id}}" {{(old ('category_id') == @$category->id) ? 'selected' : ''}}>{{@$category->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            {!! $errors->first('category_id', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" {{@$errors->has('brand_id') ? 'has-error' : ''}}>
                                        <label for="brand_id" class="col-xl-3 col-lg-3 col-form-label text-right">Brand: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select name="brand_id" id="brand_id" class="plxSelect2 form-control" required>
                                                <option value="">--Select--</option>
                                                @forelse($brands_list as $brand)
                                                <option value="{{@$brand->id}}" {{(old ('brand_id') == @$brand->id) ? 'selected' : ''}}>{{@$brand->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            {!! $errors->first('brand_id', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('old_price') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Previous Price: </label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="number" name="old_price" value="{{old('old_price')}}" class="form-control m-input" placeholder="">
                                            {!! $errors->first('old_price', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('new_price') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Current Price: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="number" name="new_price" value="{{old('new_price')}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('new_price', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('quantity') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Available Quantity: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="number" name="quantity" value="{{old('quantity')}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('quantity', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('weight') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Per Quantity Weight: </label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="weight" value="{{old('weight')}}" class="form-control m-input" placeholder="">
                                            {!! $errors->first('weight', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" {{ $errors->has('images') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Images: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="file" name="images[]" class="form-control m-input" placeholder="" multiple required>
                                            {!! $errors->first('images', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{@$errors->has('status') ? 'has-error' : ''}}>
                                        <label for="merchant" class="col-xl-3 col-lg-3 col-form-label text-right">Status: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select name="status" id="status" class="plxSelect2 form-control" required>
                                                <option value="">--Select--</option>
                                                <option value="1" {{(old ('status') == 1) ? 'selected' : ''}}>Active</option>
                                                <option value="2" {{(old ('status') == 2) ? 'selected' : ''}}>InActive</option>
                                            </select>
                                            {!! $errors->first('status', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="col-xl-8 offset-xl-2">
                            <div class="m-form__actions m-form__actions">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <button type="submit" class="btn btn-brand"><i class="la la-save"></i> &nbsp; Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Portlet-->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            'use strict';
            $('.plx_datepicker').datepicker();
        });
        $('.plxSelect2').select2({
            placeholder: "--Select--"
        })
    </script>
@endsection
