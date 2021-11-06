@extends('frontend.layouts.app')
@section('content')
    <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100" style="background-color: #e8faff; /*background-image: url({{url('assets/img/background-image/bi2.png')}});*/">
        <div class="ps-container">
            <div class="ps-section__content pb-50">
                <div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30"
                     data-radio="100%">
                    <h3 style="text-align: center">About Us</h3><br>
                    <div class="ps-masonry">
                        {{$utilities->about_us}}
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

@section('scripts')
@endsection
