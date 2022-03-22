@extends('admin.layout.app')

@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

        @if(Session::has('categorySuccess'))
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    {{Session::get('categorySuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
        @endif

        @if(Session::has('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{Session::get('deleteSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
        @endif

        @if(Session::has('updateSuccess'))
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    {{Session::get('updateSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
        @endif

      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route('admin#addCategory') }} "><button class="btn btn-sm btn-outline-dark">Add Category</button></a>
                </h3>
                <a href=" {{route('admin#categoryDownload')}} "><button class="btn btn-sm btn-success ms-5"><i class="fa-solid fa-file-arrow-down"></i></button></a>

                <div class="card-tools">

                  <form action="{{route('admin#search')}} " method="get" class="form-control" >
                      @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="searchData" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>

                          </div>
                        </div>
                      </div>

                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">


                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Product Count</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($category as $item)

                    <tr>
                        <td>{{$item->category_id }} </td>
                        <td>{{$item->category_name}}  </td>
                        <td>
                            @if($item->count ==0)
                                <a href="#" class="text-decoration-none">{{$item->count}}</a>
                            @else
                            <a href=" {{route('admin#categoryItem',$item->category_id )}} " class="text-decoration-none">{{$item->count}}</a>
                            @endif
                        </td>
                        <td>
                          <a href="{{route('admin#edit',$item->category_id )}} "><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                          <a href="{{route('admin#delete',$item->category_id)}} "><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                      </tr>

                    @endforeach

                  </tbody>
                </table>
                <div class=""><h6>Total- {{$category->total()}}</h6>  </div>

               <div class="mt-4 ms-3"> {{$category->links()}}</div>
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
