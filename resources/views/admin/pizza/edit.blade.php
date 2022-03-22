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
                  <legend class="text-center">Edit Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                        <div class="mt-2 my-3 text-center">
                            <img src=" {{ asset('/uploads/'.$pizza->image) }} " style="width:100px; height:100px">
                        </div>

                      <form class="form-horizontal" method="post" action=" {{route('admin#updatePizza',$pizza->pizza_id)}} " enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="Name" name="name" value="{{old('name',$pizza->pizza_name)}} ">
                          </div>
                        </div>
                        @if($errors->has('name'))
                            <p>{{$errors->first('name')}} </p>
                        @endif

                        <div class="form-group row">
                            <label for="inputImage" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control"  placeholder="Image" name="image" >
                            </div>
                          </div>
                          @if($errors->has('image'))
                            <p>{{$errors->first('image')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"  placeholder="Price" name="price" value="{{old('price',$pizza->price)}} ">
                            </div>
                          </div>
                          @if($errors->has('price'))
                            <p>{{$errors->first('price')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputPublic" class="col-sm-2 col-form-label">Public Status</label>
                            <div class="col-sm-10">
                              <select name="public" id="" class="form-control">

                                  @if ($pizza->public_status==0)
                                    <option value="1">Public</option>
                                    <option value="0" selected>Unpublic</option>
                                  @else
                                    <option value="1" selected>Public</option>
                                    <option value="0">Unpublic</option>
                                  @endif
                              </select>
                            </div>
                          </div>

                          @if($errors->has('public'))
                            <p>{{$errors->first('public')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                              <select name="category" id="" class="form-control">
                                    <option value="{{$pizza->category_id}}">{{ $pizza->category_name }}</option>
                                  @foreach ($category as $item)
                                  @if ($item->category_id != $pizza->category_id)
                                     <option value="{{$item->category_id}} ">{{$item->category_name}} </option>
                                  @endif

                                  @endforeach
                              </select>
                            </div>
                          </div>

                          @if($errors->has('category'))
                            <p>{{$errors->first('category')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputDiscount" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"  placeholder="Discount" name="discount" value="{{old('discount',$pizza->discount_price)}} ">
                            </div>
                          </div>

                          @if($errors->has('discount'))
                            <p>{{$errors->first('discount')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputB1G1" class="col-sm-2 col-form-label">Buy1 Get1</label>
                            <div class="col-sm-10">

                              @if ($pizza->public_status==0)
                              <input type="radio" name="b1g1" class="form-input-check" value="1" >YES
                              <input type="radio" name="b1g1" class="form-input-check" value="0" checked>NO
                                  @else
                                  <input type="radio" name="b1g1" class="form-input-check" value="1" checked>YES
                                  <input type="radio" name="b1g1" class="form-input-check" value="0" >NO
                                  @endif
                            </div>
                          </div>

                          @if($errors->has('b1g1'))
                            <p>{{$errors->first('b1g1')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputWaitingTime" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"  placeholder="Waiting Time" name="waitingTime" value="{{old('waitingTime',$pizza->waiting_time)}} ">
                            </div>
                          </div>

                          @if($errors->has('waitingTime'))
                            <p>{{$errors->first('waitingTime')}} </p>
                        @endif


                          <div class="form-group row">
                            <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <textarea name="description" rows="3" class="form-control">{{old('description',$pizza->description)}}</textarea>
                            </div>
                          </div>

                        @if($errors->has('description'))
                            <p>{{$errors->first('description')}} </p>
                        @endif

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Add</button>
                          </div>
                        </div>
                      </form>

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
