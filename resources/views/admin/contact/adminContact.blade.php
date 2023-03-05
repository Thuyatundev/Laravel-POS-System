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
                                <h2 class="title-1 text-dark"><i class="fa-solid fa-comments"></i> Client Message : <span class="text-danger"> {{$messages->total()}}</span></h2>

                            </div>
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
                    </div>
                @if (count($messages) != 0)
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr> 
                                <th>Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Messages</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $m)
                            <tr class="tr-shadow">
                                <td class="">{{$m->user_name}}</td>
                                <td class="">{{$m->user_email}}</td>
                                <td class="">{{$m->title}}</td>
                                <td class=""> <a href="{{route('admin#detail',$m->id)}}">
                                    <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="detail">
                                        <i class="fa-solid fa-eye text-danger"> </i> Read
                                    </button>
                                </a></td>
                                <td>
                                    <div class="table-data-feature">
                                          
                                        <a href="{{route('admin#delete',$m->id)}}">
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
                        {{$messages->links()}}
                    </div>
                </div>
                @else
                  <h4 class="text-dark text-center">There is no Message here!!</h4>  
                @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection