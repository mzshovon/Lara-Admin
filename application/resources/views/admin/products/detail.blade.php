@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Product Details</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Product Details</span>
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
            <div class="m-portlet">
                {{--<div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                User List
                            </h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">

                    </div>
                </div>--}}

                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-8 post-details">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td width="150">Name</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$product->name}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">SKU</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$product->sku}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Old Price</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$product->old_price}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">New Price</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$product->new_price}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Quantity</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$product->quantity}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Short Description</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$product->short_description}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Long Description</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$product->long_description}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Created Date</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@ date('d/m/Y', strtotime(@$product->created_at))}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <style type="text/css">
                                    .img {
                                        position: relative;
                                        float: left;
                                        width:  200px;
                                        height: 200px;
                                        background-position: 50% 50%;
                                        background-repeat:   no-repeat;
                                        background-size:     cover;
                                    }
                                </style>
                                @forelse($product->productimages as $images)
                                <div class="col-md-4">

                                    <img src="{{@$images->image_path}}" class="img-thumbnail img">

                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            'use strict';
            $(document).on('click', '.meta-links', function (e) {
                e.preventDefault();
                let self = $(this);
                let target = self.attr('href');
                $('.interaction-list').removeClass('active');
                $(target).addClass('active');
                $('.meta-links').removeClass('active');
                self.addClass('active');
            })
        })
    </script>
@endsection
