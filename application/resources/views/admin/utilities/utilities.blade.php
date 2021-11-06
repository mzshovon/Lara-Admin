@extends('admin.layouts.app')

@section('styles')

@endsection
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">Utilities</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">Utilities</span>
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
                <div class="m-portlet__body">
                    <div class="d-flex mb-2">
                        <div class="mr-auto">

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped contentMiddle">
                            <thead>
                            <tr>
                                <th>About Us</th>
                                <th>Privacy Statement</th>
                                <th>Terms & Conditions</th>
                                <th>Shipment Policy</th>
                                <th>Return Policy</th>
                                <th>How To Return</th>
                                <th width="1%" class="text-center no-wrap">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{@$utilities->about_us}}</td>
                                    <td>{{@$utilities->privacy_statement}}</td>
                                    <td>{{@$utilities->terms_conditions}}</td>
                                    <td>{{@$utilities->shipment_policy}}</td>
                                    <td>{{@$utilities->return_policy}}</td>
                                    <td>{{@$utilities->how_to_return}}</td>
                                    <td class="text-center no-wrap">
                                        <a href="{{url('admin/utilities/edit')}}" class="btn btn-xs btn-outline-info"><i class="la la-edit"></i> Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if (Session::has('message'))
        <script>
            swal('Success!', '{{ Session::get('message') }}', 'success');
        </script>
    @endif
@endsection
