@extends('admin.layouts.app')
@section('styles')
@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Edit Coupons</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Edit Coupons</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->

        <div class="m-content">
            <!--begin::Portlet-->
            <form class="m-portlet m-portlet--last m-portlet--head m-portlet--responsive-mobile"
                  method="POST" action="{{url('admin/coupons/edit/')}}" enctype="multipart/form-data">
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
                                                <h3 class="m-form__heading-title mb-0">Coupons Details</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('coupon_name') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Coupon Name: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="coupon_name" value="{{old('coupon_name', @$coupon->coupon_name)}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('coupon_name', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('coupon_number') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Coupon Number: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="coupon_number" value="{{old('coupon_number', @$coupon->coupon_number)}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('coupon_number', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('coupon_price') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Coupon Price: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="coupon_price" value="{{old('coupon_price', @$coupon->coupon_price)}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('coupon_price', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('expire_date') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Coupon Expire Date: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="expire_date" value="{{old('expire_date', @$coupon->expire_date)}}" class="form-control m-input plx_datepicker" placeholder="" required>
                                            {!! $errors->first('expire_date', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{@$errors->has('product_id') ? 'has-error' : ''}}>
                                        <label for="brand_id" class="col-xl-3 col-lg-3 col-form-label text-right">Product: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select name="product_id" id="product_id" class="plxSelect2 form-control" required>
                                                @forelse($products_list as $product)
                                                    <option value="{{@$product->id}}" {{(old ('product_id', @$coupon->product_id) == @$product->id) ? 'selected' : ''}}>{{@$product->name}}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            {!! $errors->first('product_id', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('image') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Image: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <img src="{{@$coupon->image_path}}" alt="Monthly Image" height="70px" width="100px">
                                            <input type="file" name="image" class="form-control m-input" placeholder="">
                                            {!! $errors->first('image', '<p class="help-block" style="color: red;">:message</p>') !!}
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
                                        <input type="hidden" name="id" value="{{@$coupon->id}}">
                                        <button type="submit" class="btn btn-brand"><i class="la la-save"></i> &nbsp; Update</button>
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
