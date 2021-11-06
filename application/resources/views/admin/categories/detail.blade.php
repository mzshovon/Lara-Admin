@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">User Details</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">User Details</span>
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
                                <div class="col-md-8">
                                    <table class="table table-striped">
                                        <tr>
                                            <td width="150">Name</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@ $user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Email</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Joined Date</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@ date('d/m/Y', strtotime($user->created_at))}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Bio</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>{{@ $user->bio}}</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Follower</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>215</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Following</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>215</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Total Posts</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>33</td>
                                        </tr>
                                        <tr>
                                            <td width="150">Last Login</td>
                                            <td width="20" class="text-center">:</td>
                                            <td>19/01/2019 - 4:23pm</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{@ $user->image_url}}" alt="" class="img-thumbnail">
                                </div>
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
