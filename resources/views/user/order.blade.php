@extends('user.layout.style')
@section('content')

<div class="row mt-5 d-flex justify-content-center">
    <h3>Order Page</h3>
    <div class="col-4 ">
        <img src=" {{asset('uploads/'.$pizza->image)}} " class="img-thumbnail" width="100%">            <br>
        <a href=" {{route('user#index')}} ">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>



    <div class="col-6">
        @if(Session::has('total_time'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            Order Success ! Please Wait {{Session::get('total_time')}} minutes.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        <hr>
        <h5>Name  </h5><small>  {{$pizza->pizza_name}} </small><hr>
        <h5>Price  </h5><small>  {{$pizza->price - $pizza->discount_price}} Kyats </small><hr>
        <h5>Waiting Time  </h5><small>  {{$pizza->waiting_time}} </small><hr>
        <form action=" {{route('user#placeOrder')}} " method="post">
            @csrf
            <h5>Pizza Count  </h5>
            <input type="number" name="pizzaCount" placeholder="Number Of Pizza" class="form-control">
            @if($errors->has('pizzaCount'))
                <p class="text-danger">{{$errors->first('pizzaCount')}} </p>
            @endif
            <hr>

            <h5>Payment Type  </h5>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Credit</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">Cash</label>
            </div>
            @if($errors->has('paymentType'))
                <p class="text-danger">{{$errors->first('paymentType')}} </p>
            @endif
            <hr>
            <button class="btn btn-primary mt-5" method="submit"><i class="fas fa-shopping-cart"></i>Place Order</button>
        </form>
    </div>
</div>

@endsection
