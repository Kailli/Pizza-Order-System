@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-10 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">

                <div class="">
                @if(Session::has('updateSuccess'))
                    <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    {{Session::get('updateSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                </div>

                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action=" {{route('admin#updateProfile', $user->id)}} " method="post" >
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value=" {{old('name',$user->name)}} " placeholder="Name">
                          </div>
                          @if ($errors->has('name'))
                              <p class="text-danger"> {{$errors->first('name')}} </p>
                          @endif
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" value=" {{old('email',$user->email)}} " placeholder="Email">
                          </div>
                          @if ($errors->has('email'))
                              <p class="text-danger"> {{$errors->first('email')}} </p>
                          @endif
                        </div>

                        <div class="form-group row">
                            <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="phone" value=" {{old('phone',$user->phone)}} " placeholder="Phone">
                            </div>
                            @if ($errors->has('phone'))
                              <p class="text-danger"> {{$errors->first('phone')}} </p>
                          @endif
                          </div>

                          <div class="form-group row">
                            <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="address" value=" {{old('address',$user->address)}} " placeholder="Address">
                            </div>
                            @if ($errors->has('address'))
                              <p class="text-danger"> {{$errors->first('address')}} </p>
                            @endif
                          </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">

                        <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>

                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-dark text-white">Update</button>
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
