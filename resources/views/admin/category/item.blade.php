@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="m-3 text-center"><h3> {{$pizza[0]->categoryName}} </h3></div>
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">


                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Pizza Name</th>
                      <th>Price</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($pizza as $item)

                    <tr>
                        <td>{{$item->pizza_id }} </td>
                        <td>
                            <img src=" {{asset('uploads/'.$item->image)}} " width="150px" height="100px">
                        </td>
                        <td>{{$item->pizza_name}}  </td>
                        <td> {{$item->price}} </td>
                      </tr>

                    @endforeach

                  </tbody>
                </table>
                <div class=""><h6>Total- {{$pizza->total()}}</h6>  </div>

                <div class="card-footer float-right">
                    <a href=" {{route('admin#category')}} ">
                    <button class="btn btn-dark text-white">Back</button>
                    </a>
                </div>

               <div class="mt-4 ms-3"> {{$pizza->links()}}</div>
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


@endsection
