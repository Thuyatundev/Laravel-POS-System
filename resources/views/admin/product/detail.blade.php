@extends('admin.layouts.master')


@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            @if (session('updateAccount'))
            <div class="col-5 offset-6">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fa-regular fa-circle-check"></i> {{session('updateAccount')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="row">
                        <div class="col-1 offset-11">
                           <button class="btn bg-dark text-white my-3" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-solid fa-layer-group"></i> Product Detail Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    <img src="{{asset('storage/'. $pizzas->image)}}" class="rounded img-thumbnail shadow-sm" >
                                </div>
                                <div class="col-7 offset-1">
                                    <div class="my-3 d-block w-25 btn btn-danger"><i class="fa-solid fa-pizza-slice"></i> {{$pizzas->name}}</div>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-circle-dollar-to-slot"></i> {{$pizzas->price}} MMK</span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-clock"></i> {{$pizzas->waitingtime}} Min</span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-regular fa-eye"></i> {{$pizzas->view_count}}</span>
                                    <span class="my-3 btn btn-dark text-white"><i class="fa-solid fa-link"></i> {{$pizzas->category_id}}</span>
                                    <h4 class="my-3"><i class="fa-solid fa-user-clock"></i> {{$pizzas->description}}</h4>
                                </div>
                            </div>

                            <div class="col-2 offset-1 mt-2">
                                <button class="btn btn-dark" type="submit">
                                    <a href="{{route('adminAccount#edit')}}" class="text-decoration-none text-white"><i class="fa-solid fa-gear"></i> Edit Account Profile</a>
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