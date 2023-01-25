@extends('admin.layouts.master')

@section('title','Category-List')

@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 text-dark"><i class="fa-solid fa-database"></i> Category List : <span class="text-danger">  {{$categories->total()}}</span></h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                        <a href=" {{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button> 
                        </a> 
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>  
                        </div>
                    </div>
                    @if (session('createSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-sharp fa-solid fa-circle-check"></i> {{session('createSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    @if (session('updateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-check"></i> {{session('updateSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                   

                    <div class="">
                        <h4>Search Key : <span class="text-danger">{{request('key')}}</span></h4>
                    </div>

                    <div class="col-3 offset-9">
                        <form action="{{route('category#list')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search Category ..." value="{{request('key')}}">
                                <button type="submit" class="btn btn-dark text-white">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                   

                   @if (count($categories) != 0)
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category-Name</th>
                                <th>Created-Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="tr-shadow">
                                <td>{{$category->id}}</td>
                                <td class="col-6">{{$category->name}}</td>
                                <td>{{$category->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                       <a href="{{ route('category#edit',$category->id)}}">
                                        <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        </a>        
                                        <a href="{{route('category#delete',$category->id)}}">
                                         <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" >
                                        <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$categories->links()}}
                    </div>
                </div>
                @else
                  <h4 class="text-dark text-center">There is no category here!!</h4>  
                @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection