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
                                <h2 class="title-1 text-dark"><i class="fa-solid fa-database"></i> Admin Account List : <span class="text-danger"> {{$admin->total()}}   </span></h2>

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

                   

                    <div>
                        <h4 class="text-dark">Search Key : <span class="text-danger">{{request('key')}}</span></h4>
                    </div>

                    <div class="col-3 offset-9">
                        <form action="{{route('adminAccount#list')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search Category ..." value="{{request('key')}}">
                                <button type="submit" class="btn btn-dark text-white">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                
                   @if (count($admin) != 0)
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="tr-shadow">
                                <td class="col-2">
                                    @if ( $a->image == null)
                                        @if ($a->gender == 'male')
                                        <img src="{{asset('admin/images/icon/user.png')}}" style="width: 200px;height:200px;" class="image-thumbnail shadow-sm" alt="pic">
                                        @else
                                        <img src="{{asset('admin/images/icon/female.jpg')}}" style="width: 200px;height:200px;" class="image-thumbnail shadow-sm" alt="pic">
                                        @endif
                                    @else
                                    <img src="{{asset('storage/'.$a->image)}}" style="width: 200px;height:200px;" class="image-thumbnail shadow-sm" alt="pic">  
                                    @endif
                                </td>
                                <td class="col-3">{{$a->name}}</td>
                                <td class="col-2">{{$a->email}}</td>
                                <td class="col-2">{{$a->phone}}</td>
                                <td class="col-2">{{$a->gender}}</td>
                                <td class="col-2">{{$a->address}}</td>
                                <td>
                                    <div class="table-data-feature">       
                                        @if (Auth::user()->id == $a->id)
                                        <a href="#">
                                            <button class="item" data-toggle="tooltip" data-placement="top">
                                                <i class="fa-solid fa-circle text-success"></i>
                                           </button>
                                           </a>   
                                        @else
                                        <a href="{{route('adminAccount#changeRole', $a->id)}}">
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Change Account Role">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                           </button>
                                        </a>

                                        <a href="{{route('adminAccount#delete', $a->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')" >
                                           <i class="fa-solid fa-trash-can"></i>
                                           </button>
                                           </a>   
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$admin->links()}}
                    </div>
                </div>   
                   @else
                       <h2 class="text-center text-dark">There is no your <i class="fa-solid fa-text-slash"></i>ext...</h2>
                   @endif
              </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection