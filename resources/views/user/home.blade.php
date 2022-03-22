@extends('user.layout.style')

@section('content')

<!-- Page Content-->
<div class="container px-4 px-lg-5" id="home">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza" src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
        <div class="col-lg-5">
            <h1 class="font-weight-light">Pizza Order System</h1>
            <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
            <a class="btn btn-primary" href="#!">Enjoy!</a>
        </div>
    </div>

    <!-- Content Row-->
    <div class="row d-flex">
        <div class="col-3">
                <div class="me-5">
                    <form method="get" action=" {{route('user#searchItem')}} ">
                        <div class="input-group">
                            <input class="form-control" name="searchData"  type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>

                    <div class="text-center">
                        <a href=" {{route('user#index')}} " class="text-black" style="text-decoration: none; "><div class="m-2 p-2">All</div></a>
                        @foreach ($category as $item)

                        <a href=" {{route('user#categorySearch',$item->category_id)}} " class="text-black" style="text-decoration: none; "><div class="m-2 p-2"> {{$item->category_name}} </div></a>

                        @endforeach
                    </div>
                    <form action=" {{route('user#searchPizzaData')}} " method="GET">
                        @csrf
                    <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Start Date - End Date</h3>
                                <input type="date" name="startDate" id="" class="form-control"> -
                                <input type="date" name="endDate" id="" class="form-control">
                        </div>
                    <hr>
                        <div class="text-center m-4 p-2">
                            <h3 class="mb-3">Min - Max Amount</h3>
                                <input type="number" name="minPrice" id="" class="form-control" placeholder="minimum price"> -
                                <input type="number" name="maxPrice" id="" class="form-control" placeholder="maximun price">
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-dark">Search <i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
        </div>

        <div class="col-9 mt-3">

            @if ($status==1)
            <div class="row gx-4 gx-lg-5" id="pizza">
                    @foreach ($pizza as $item)
                        <div class="col-md m-3" >
                            <div class="card" style="width:190px; height:300px;"  >
                                <!-- Sale badge-->

                                @if ( $item->buy_one_get_one_status == 1)
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Buy1 Get1</div>
                                @endif

                                <!-- Product image-->
                                <img class="card-img-top" src=" {{asset('uploads/'.$item->image)}} " alt="..." height="200px" id="pizza_image"/>
                                <!-- Product details-->
                                <div class="card-body p-3">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"> {{$item -> pizza_name}} </h5>
                                        {{-- <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">$20.00</span> $18.00 --}}
                                        <span>{{$item->price}}</span>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href=" {{route('user#pizzaDetails',$item->pizza_id)}} ">More Details</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="mt-3 alert alert-danger" role="alert" style="width:500px; margin-top:40px;">
                    There is no Pizza...
                    </div>
                </div>
                @endif
                <div class="mt-5">
                    {{ $pizza -> links()}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center d-flex justify-content-center align-items-center" id="contact">
    <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
        <h3>Contact Us</h3>

        @if(Session::has('contactSuccess'))
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    {{Session::get('contactSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
        @endif

        <form action=" {{route('admin#createContact')}} " method="post" class="my-4">
            @csrf
            <input type="text" name="user_name" value="{{ old('user_name') }}" class="form-control my-3" placeholder="Name">
                <div class="">
                    @if($errors->has('user_name'))
                    <p class="text-danger">{{$errors->first('user_name')}} </p>
                @endif
                </div>
            <input type="text" name="user_email" value="{{ old('user_email') }}" class="form-control my-3" placeholder="Email">
            <div class="">
                @if($errors->has('user_email'))
                <p class="text-danger">{{$errors->first('user_email')}} </p>
            @endif
            </div>
            <textarea class="form-control my-3" name="user_message" rows="3" placeholder="Message">{{old('user_message')}}</textarea>
            <div class="">
                @if($errors->has('user_message'))
                <p class="text-danger">{{$errors->first('user_message')}} </p>
            @endif
            </div>
            <button type="submit" class="btn btn-outline-dark">Send  <i class="fas fa-arrow-right"></i></button>
        </form>
    </div>
</div>

@endsection
