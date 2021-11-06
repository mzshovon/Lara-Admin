@extends('frontend.layouts.app')
@section('content')
    <div class="container" style="border: 1px solid #5a9bc7; border-radius: 8px;margin-top: 15px;-webkit-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.75);
box-shadow: 0px 4px 5px 0px rgba(0,0,0,0.75); ">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
{{--                        <h3 class="m-subheader__title" style="text-align: center">Order Details</h3>--}}
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="#" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            <hr>

                        </ul>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->

            <div class="m-content">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-md-12 post-details">
                   <h1 style="text-align: center; margin-bottom: 30px"> Thank you for placing order here! You will be notified soon.</h1>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection


@section('scripts')
    <script>
        function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
        // To disable f5
        /* jQuery < 1.7 */
        $(document).bind("keydown", disableF5);
        /* OR jQuery >= 1.7 */
        $(document).on("keydown", disableF5);

        // To re-enable f5
        /* jQuery < 1.7 */
        $(document).unbind("keydown", disableF5);
        /* OR jQuery >= 1.7 */
        $(document).off("keydown", disableF5);
    </script>
@endsection
