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
                                <h2 class="title-1 text-dark"><i class="fa-solid fa-utensils"></i> Product List : <span class="text-danger">{{$pizzas->total()}} </span></h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                        <a href=" {{route('prodcut#createProduct')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button> 
                        </a> 
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>  
                        </div>
                    </div>
                    @if (session('productcreate'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-sharp fa-solid fa-circle-check"></i> {{session('productcreate')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    @if (session('deletesuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('deletesuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    @if (session('Productupdate'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-check"></i> {{session('Productupdate')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif


                    <div class="">
                        <h4>Search Key : <span class="text-danger">{{request('key')}}</span></h4>
                    </div>

                    <div class="col-3 offset-9">
                        <form action="{{route('product#createPage')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search Product ..." value="{{request('key')}}">
                                <button type="submit" class="btn btn-dark text-white">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                   

                @if (count($pizzas) != 0)
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizzas as $p)
                            <tr class="tr-shadow">
                                <td class="col-2"><img src="{{asset('storage/'.$p->image)}}" style="width: 200px;height:100px;" class="image-thumbnail shadow-sm" alt="pic"></td>
                                <td class="col-3">{{$p->name}}</td>
                                <td class="col-2">{{$p->price}}</td>
                                <td class="col-2">{{$p->category_name}}</td>
                                <td class="col-2"><i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('product#detail',$p->id)}}">
                                            <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            </a>   
                                       <a href="{{route('product#edit',$p->id)}}">
                                        <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        </a>        
                                        <a href="{{route('product#delete',$p->id)}}">
                                         <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')" >
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
                        {{$pizzas->links()}}
                    </div>
                </div>
                @else
                  <h4 class="text-dark text-center">There is no Pizza here!!</h4>  
                @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection