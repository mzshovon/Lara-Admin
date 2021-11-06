@extends('frontend.layouts.app')
@section('content')
    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
        <div class="row" style="margin-bottom:40px;">
            <div class="col-md-8 col-md-offset-2">
                <input type="hidden" name="email" value="{{@$email}}"> {{-- required --}}
                <input type="hidden" name="orderID" value="{{@$order_id}}">
                <input type="hidden" name="amount" value="{{@$total_amount}}"> {{-- required in kobo --}}
                <input type="hidden" name="quantity" value="{{@$quantity}}">
                <input type="hidden" name="metadata"
                       value="{{ json_encode($array = ['key_name' => 'value',]) }}"> {{-- For other necessary things you want to add to your payload. it is optional though --}}
                <input type="hidden" name="reference" value="{{ @$reference }}"> {{-- required --}}
                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                <input type="hidden" name="_token"
                       value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                <p>
                    <button class="btn btn-success btn-lg btn-block" type="submit" id="submit" value="Pay Now!">
                        <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                    </button>
                </p>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        jQuery(function(){
            jQuery('#submit').click();
        });
    </script>
@endsection
