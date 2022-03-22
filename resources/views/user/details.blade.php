@extends('user.layout.style')
@section('content')

<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src=" {{asset('uploads/'.$pizza->image)}} " class="img-thumbnail" width="100%">            <br>
        <a href=" {{route('user#order')}} "><button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i> Order</button></a>
        <a href=" {{route('user#index')}} ">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fas fa-backspace"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
        <table>
            <tr>
                <td><b>Name  </b></td><td>:  {{$pizza->pizza_name}} </td>
            </tr>
            <tr>
                <td><b>Price  </b></td><td>:  {{$pizza->price}} Kyats </td>
            </tr>
            <tr>
                <td><b>Discount Price  </b></td><td>:  {{$pizza->discount_price}} </td>
            </tr>
            <tr>
                <td><b>Buy 1 Get 1  </b></td>
                <td>:
                    @if ($pizza->buy_one_get_one_status == 0)
                        Not Get
                    @else
                        Get
                    @endif
                </td>
            </tr>
            <tr>
                <td><b>Waiting Time  </b></td><td>:  {{$pizza->waiting_time}} </td>
            </tr>
            <tr>
                <td><b>Description  </b></td><td>:  {{$pizza->description}} </td>
            </tr>

        </table>
    </div>
</div>

@endsection
