@extends('admin.layouts.app')
@section('styles')
@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Add Banners</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Add Banners</span>
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
                  method="POST" action="{{url('admin/banner/add/')}}" enctype="multipart/form-data">
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
                                                <h3 class="m-form__heading-title mb-0">Banner details</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row" {{ $errors->has('title') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Banner Title: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="text" name="title" value="{{old('title')}}" class="form-control m-input" placeholder="" required>
                                            {!! $errors->first('title', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>



                                    <div class="form-group m-form__group row" {{@$errors->has('product_id') ? 'has-error' : ''}}>
                                        <label for="brand_id" class="col-xl-3 col-lg-3 col-form-label text-right">Placement: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <select name="sub_font" id="sub_id" class="plxSelect2 form-control" onchange="getPlace()" required>
                                                <option value="">--Select--</option>
                                                <option value="1">Left</option>
                                                <option value="2">Right</option>

                                            </select>
                                            {!! $errors->first('product_id', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>


                                    <div class="form-group m-form__group row" {{ $errors->has('details') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Banner details: </label>
                                        <div class="col-xl-9 col-lg-9">
                                            <textarea name="details" class="form-control" rows="3">{{old('details')}}</textarea>
                                            {!! $errors->first('details', '<p class="help-block" style="color: red;">:message</p>') !!}
                                        </div>
                                    </div>


                                    <div class="form-group m-form__group row" {{ $errors->has('image') ? 'has-error' : ''}}>
                                        <label class="col-xl-3 col-lg-3 col-form-label text-right">Image: <span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <input type="file" name="image" class="form-control m-input" placeholder="" required>
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

        function getPlace() {
            var getVal = $('#sub_id').find(":selected").val();
            var url = "{{url('/admin/banner/getJson')}}";
            $.ajax({
                type: 'post',
                url:url,
                data: {
                    place: getVal,
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    var jsonData = JSON.parse(response);
                    if(jsonData == 201){
                        swal("Ooops!", "Your placement already taken!", "error");
                    }

                }
            });


        }

    </script>
@endsection
