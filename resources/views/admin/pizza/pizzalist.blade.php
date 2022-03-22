@extends('admin.layout.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <a href="{{route('admin#createPizza')}} "><i class="fas fa-plus-square"></i></a>
                </div>
                <div class="">
                    <a href=" {{route('admin#downloadPizza')}} ">
                        <button class="btn btn-sm btn-success ms-5">
                            <i class="fa-solid fa-file-arrow-down"></i>
                        </button>
                    </a>
                </div>


                <div class="card-tools">
                    <form action=" {{route('admin#searchPizza')}} " method="get">
                  <div class="input-group input-group-sm" style="width: 150px;">

                      @csrf

                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>


                  </div>
                </form>
                </div>
              </div>

            <div class="">
                @if(Session::has('createPizzaSuccess'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{Session::get('createPizzaSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(Session::has('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{Session::get('deleteSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(Session::has('updatePizzaSuccess'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{Session::get('updatePizzaSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    @if ($status == 0 )

                        <tr>
                            <td colspan="7">
                                <small class="text-muted">There is no data.</small>
                            </td>
                        </tr>

                    @else

                        @foreach ($pizza as $item)
                            <tr>
                                <td>{{$item->pizza_id}} </td>
                                <td>{{$item->pizza_name}} </td>
                                <td>
                                <img src="{{ asset('uploads/'.$item->image)}} " class="img-thumbnail" width="100px">
                                </td>
                                <td>{{$item->price}} </td>
                                <td>
                                    @if ($item->public_status==1)
                                        Public
                                    @elseif ($item->public_status==0)
                                        UnPublic
                                    @endif
                                </td>
                                <td>
                                    @if ($item->buy_one_get_one_status==1)
                                        Yes
                                    @elseif ($item->buy_one_get_one_status==0)
                                        No
                                    @endif

                                </td>
                                <td>
                                <a href="{{route('admin#editPizza',$item->pizza_id)}} "><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                                <a href="{{route('admin#deletePizza',$item->pizza_id)}} "><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                                <a href=" {{route('admin#pizzaInfo',$item->pizza_id)}} "><button class="btn btn-sm bg-dark text-white"><i class="fas fa-eye"></i></button></a>
                                </td>
                            </tr>
                            @endforeach

                    @endif

                  </tbody>
                </table>
                <div class=""><h6>Total- {{$pizza->total()}} </h6></div>
                <div class="">
                    {{$pizza->links()}}
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
