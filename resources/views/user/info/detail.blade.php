@extends('user.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        @if (session('updateAccount'))
        <div class="col-6 offset-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-regular fa-circle-check"></i> {{session('updateAccount')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        </div>
        @endif
        @if (session('changeRole'))
        <div class="col-5 offset-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-regular fa-circle-check"></i> {{session('changeRole')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        </div>
        @endif
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
               
                <div class="card">
                    
                    <div class="card-body bg-dark text-warning">
                        <div class="card-title">
                            <h3 class="text-center title-2"><i class="fa-solid fa-circle-user"></i> User Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                    <img src="{{asset('admin/images/icon/user.png')}}" style="width: 320px;height:320px;" class="img-thumbnail shadow-sm" alt="pic">
                                    @else
                                    <img src="{{asset('admin/images/icon/female.jpg')}}" style="width: 320px;height:320px;" class="img-thumbnail shadow-sm" alt="pic">
                                    @endif
                                @else
                                <img src="{{asset('storage/'. Auth::user()->image)}}" style="width: 320px;height:320px;" class="rounded img-thumbnail shadow-sm" alt="Thura"/>
                                @endif
                            </div>
                            <div class="col-5 offset-1">
                                <h4 class="my-3"><i class="fa-solid fa-circle text-success"></i> {{Auth::user()->name}}</h4> 
                                <h4 class="my-3"><i class="fa-solid fa-envelope-circle-check"></i> {{Auth::user()->email}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-phone"></i> {{Auth::user()->phone}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-venus-mars"></i> {{Auth::user()->gender}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-brain"></i> {{Auth::user()->role}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-map-location-dot"></i> {{Auth::user()->address}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-user-clock"></i> {{Auth::user()->created_at->diffForHumans()}}</h4>
                            </div>
                        </div>

                        <div class="col-4 offset-2 mt-3">
                            <button class="btn btn-warning " type="submit">
                                <a href="{{route('user#accountChangePage')}}" class="text-decoration-none text-dark"><i class="fa-solid fa-gear"></i> Edit Account Profile</a>
                            </button>
                        </div>

                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection