@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-5 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">

                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <form action=" {{route('admin#changePassword',Auth()->user()->id)}} " method="post">
                            @csrf
                            <div class="my-2">
                                <label for="oldpw">Old Password</label>
                                <input type="password" id="" class="form-control" name="oldPassword">
                            </div>
                            @if ($errors->has('oldPassword'))
                              <p class="text-danger"> {{$errors->first('oldPassword')}} </p>
                            @endif
                            @if (Session::has('wrongPw'))
                              <p class="text-danger"> {{Session::get('wrongPw')}} </p>
                            @endif

                            <div class="my-2">
                                <label for="newpw">New Password</label>
                                <input type="password" id="" class="form-control" name="newPassword">
                            </div>
                            @if ($errors->has('newPassword'))
                              <p class="text-danger"> {{$errors->first('newPassword')}} </p>
                            @endif
                            @if (Session::has('notSame'))
                              <p class="text-danger"> {{Session::get('notSame')}} </p>
                            @endif
                            @if (Session::has('lengthEr'))
                              <p class="text-danger"> {{Session::get('lengthEr')}} </p>
                            @endif

                            <div class="my-2">
                                <label for="confirmpw">Confirm Password</label>
                                <input type="password" id="" class="form-control" name="confirmPassword">
                            </div>
                            @if ($errors->has('confirmPassword'))
                              <p class="text-danger"> {{$errors->first('confirmPassword')}} </p>
                            @endif
                            @if (Session::has('notSame'))
                              <p class="text-danger"> {{Session::get('notSame')}} </p>
                            @endif
                            @if (Session::has('lengthEr'))
                              <p class="text-danger"> {{Session::get('lengthEr')}} </p>
                            @endif

                            <div class="my-2 float-right">
                            <input type="submit" value="Change" class="btn btn-dark text-white">
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
