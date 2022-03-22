@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12 offset-2 mt-5">
            <div class="col-md-9">
               <a href="{{route('admin#pizza')}} " class=" text-decoration-none"> <div class="mb-4 text-dark"><i class="fas fa-arrow-left"></i>Back</div></a>
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Pizza Information</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane d-flex justify-content-center" id="activity">

                        <div class="mt-2 text-center pr-4 pt-5">
                            <img src=" {{ asset('/uploads/'.$pizza->image) }} " style="width:300px; height:300px" class="rounded-circle img-thumbnail">
                        </div>

                        <div class="" style="">
                            <div class="mt-4">
                                <b>Name</b> : <span>{{$pizza->pizza_name}} </span>
                            </div>

                            <div class="mt-4">
                                <b>Pizza</b> : <span>{{$pizza->price}} Kyats </span>
                            </div>

                            <div class="mt-4">
                                <b>Public Status</b> :
                                <span>
                                    @if ($pizza->public_status==1)
                                        Public
                                    @else
                                        Unpublic
                                    @endif
                                </span>
                            </div>

                            <div class="mt-4">
                                <b>Category</b> : <span>{{$pizza->category_id}} </span>
                            </div>

                            <div class="mt-4">
                                <b>Discount Price</b> : <span>{{$pizza->discount_price}} </span>
                            </div>

                            <div class="mt-4">
                                <b>Buy 1 Get 1</b> :
                                <span>
                                    @if ($pizza->buy_one_get_one_status==1)
                                        Get
                                    @else
                                        Not
                                    @endif
                                </span>
                            </div>

                            <div class="mt-4">
                                <b>Waiting Time</b> : <span>{{$pizza->waiting_time}} </span>
                            </div>

                            <div class="mt-4">
                                <b>Description</b> : <span>{{$pizza->description}} </span>
                            </div>
                        </div>

                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
