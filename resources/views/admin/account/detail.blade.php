@extends('admin.layouts.master')


@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-sharp fa-solid fa-person-through-window"></i> Account Detail Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                    <img src="{{asset('admin/images/icon/user.png')}}" alt="Thura"/>
                                    @else
                                    <img src="{{asset('admin/images/icon/tyt.jpg')}}" alt="Thura"/>
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-3"><i class="fa-solid fa-user"></i> {{Auth::user()->name}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-envelope-circle-check"></i> {{Auth::user()->email}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-phone"></i> {{Auth::user()->phone}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-brain"></i> {{Auth::user()->role}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-map-location-dot"></i> {{Auth::user()->address}}</h4>
                                    <h4 class="my-3"><i class="fa-solid fa-user-clock"></i> {{Auth::user()->created_at->diffForHumans()}}</h4>
                                </div>
                            </div>

                            <div class="col-4 offset-2 mt-3">
                                <button class="btn btn-dark">
                                    Edit Account Profile
                                </button>
                            </div>

                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection