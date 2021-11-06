@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Edit Utilities</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Edit Utilities</span>
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
                  method="POST" action="{{url('admin/utilities/edit')}}" enctype="multipart/form-data">
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
                                                <h3 class="m-form__heading-title mb-0">Utilities Details</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="about_us" class="col-xl-3 col-lg-3 col-form-label text-right">About Us:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="about_us" id="about_us" class="form-control"
                                                      rows="3">{{old('about_us',@$utilities->about_us) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="privacy_statement" class="col-xl-3 col-lg-3 col-form-label text-right">Privacy Statement:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="privacy_statement" id="privacy_statement" class="form-control"
                                                      rows="3">{{old('privacy_statement',@$utilities->privacy_statement) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="terms_conditions" class="col-xl-3 col-lg-3 col-form-label text-right">Terms Conditions:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="terms_conditions" id="terms_conditions" class="form-control"
                                                      rows="3">{{old('terms_conditions',@$utilities->terms_conditions) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="shipment_policy" class="col-xl-3 col-lg-3 col-form-label text-right">Shipment Policy:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="shipment_policy" id="shipment_policy" class="form-control"
                                                      rows="3">{{old('shipment_policy',@$utilities->shipment_policy) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="return_policy" class="col-xl-3 col-lg-3 col-form-label text-right">Return Policy:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="return_policy" id="return_policy" class="form-control"
                                                      rows="3">{{old('return_policy',@$utilities->return_policy) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <label for="how_to_return" class="col-xl-3 col-lg-3 col-form-label text-right">How To Return:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="how_to_return" id="how_to_return" class="form-control"
                                                      rows="3">{{old('how_to_return',@$utilities->how_to_return) }}</textarea>
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
                                        <input type="hidden" name="id" value="{{@$utilities->id}}">
                                        <button type="submit" class="btn btn-brand"><i class="la la-save"></i> &nbsp;
                                            Update
                                        </button>
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

