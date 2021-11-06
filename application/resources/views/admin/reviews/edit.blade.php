@extends('admin.layouts.app')
@section('styles')
@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Edit Reviews</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Edit Reviews</span>
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
                  method="POST" action="{{url('admin/reviews/edit')}}" enctype="multipart/form-data">
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
                                                <h3 class="m-form__heading-title mb-0">Reviews Details</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" {{ $errors->has('title') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Reviewer name: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="name" value="{{old('title', @$reviews->customer_name)}}" class="form-control m-input" placeholder="" required>
{{--                                            {!! $errors->first('reviews', '<p class="help-block" style="color: red;">:message</p>') !!}--}}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('title') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Reviewer email: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="email" name="email" value="{{old('title', @$reviews->email)}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('ads_name', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{@$errors->has('sub_font') ? 'has-error' : ''}}>
                                        <label for="brand_id" class="col-xl-3 col-lg-3 col-form-label text-right">Rating: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select name="rating" id="sub_id" class="plxSelect2 form-control" required>

                                                <option value="1" {{(old ('rating', @$reviews->rating) == '1') ? 'selected' : ''}}>{{'1 star'}}</option>
                                                <option value="2" {{(old ('rating', @$reviews->rating) == '2') ? 'selected' : ''}}>{{'2 star'}}</option>
                                                <option value="3" {{(old ('rating', @$reviews->rating) == '3') ? 'selected' : ''}}>{{'3 star'}}</option>
                                                <option value="4" {{(old ('rating', @$reviews->rating) == '4') ? 'selected' : ''}}>{{'4 star'}}</option>
                                                <option value="5" {{(old ('rating', @$reviews->rating) == '5') ? 'selected' : ''}}>{{'5 star'}}</option>

                                            </select>
                                            {!! $errors->first('banner_id', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>



                                    <div class="form-group m-form__group row">
                                        <label for="description" class="col-xl-3 col-lg-3 col-form-label text-right">
                                            Review details:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="reviews"  class="form-control"
                                                      rows="3">{{old('review',@$reviews->review) }}</textarea>
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
                                        <input type="hidden" name="id" value="{{@$reviews->id}}">
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
        });

    </script>
@endsection
