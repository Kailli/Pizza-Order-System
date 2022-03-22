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
                  <legend class="text-center">Add Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">


                      <form class="form-horizontal" method="post" action=" {{route('admin#insetPizza')}} " enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="Name" name="name">
                          </div>
                        </div>
                        @if($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}} </p>
                        @endif

                        <div class="form-group row">
                            <label for="inputImage" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control"  placeholder="Image" name="image">
                            </div>
                          </div>
                          @if($errors->has('image'))
                            <p class="text-danger">{{$errors->first('image')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Price" name="price">
                            </div>
                          </div>
                          @if($errors->has('price'))
                            <p class="text-danger">{{$errors->first('price')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputPublic" class="col-sm-2 col-form-label">Public Status</label>
                            <div class="col-sm-10">
                              <select name="public" id="" class="form-control">
                                  <option value="1">Public</option>
                                  <option value="0">Unpublic</option>
                              </select>
                            </div>
                          </div>

                          @if($errors->has('public'))
                            <p class="text-danger">{{$errors->first('public')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                              <select name="category" id="" class="form-control">
                                  <option value="">Choose Category</option>
                                  @foreach ($category as $item)
                                  <option value="{{$item->category_id}} ">{{$item->category_name}} </option>

                                  @endforeach
                              </select>
                            </div>
                          </div>

                          @if($errors->has('category'))
                            <p class="text-danger">{{$errors->first('category')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputDiscount" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Discount" name="discount">
                            </div>
                          </div>

                          @if($errors->has('discount'))
                            <p class="text-danger">{{$errors->first('discount')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputB1G1" class="col-sm-2 col-form-label">Buy1 Get1</label>
                            <div class="col-sm-10">
                              <input type="radio" name="b1g1" class="form-input-check" value="1">YES
                              <input type="radio" name="b1g1" class="form-input-check" value="0">NO
                            </div>
                          </div>

                          @if($errors->has('b1g1'))
                            <p class="text-danger">{{$errors->first('b1g1')}} </p>
                        @endif

                          <div class="form-group row">
                            <label for="inputWaitingTime" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  placeholder="Waiting Time" name="waitingTime">
                            </div>
                          </div>

                          @if($errors->has('waitingTime'))
                            <p class="text-danger">{{$errors->first('waitingTime')}} </p>
                        @endif


                          <div class="form-group row">
                            <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <textarea name="description" rows="3" class="form-control"></textarea>
                            </div>
                          </div>

                        @if($errors->has('description'))
                            <p class="text-danger">{{$errors->first('description')}} </p>
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
