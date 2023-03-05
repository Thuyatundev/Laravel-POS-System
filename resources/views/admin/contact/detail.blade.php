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
                                <h3 class="text-center title-2"><i class="fa-regular fa-message"></i> Message Detail</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-7 offset-1">
                                    <div class="col">
                                        <i class="fa-solid fa-user"></i> <span>Name :</span><span class="my-3"> {{$message->user_name}}</span>
                                    </div>
                                    <div class="col">
                                        <i class="fa-solid fa-envelope-circle-check"></i> <span>Email :</span><span class="my-3"> {{$message->user_email}}</span>
                                    </div>
                                    <h3 class="my-3 fs-3"><i class="fa-solid fa-comment-sms"></i> {{$message->title}}</h3>
                                    <h4 class="my-3 text-muted"><i class="fa-solid fa-book-open"></i> {{$message->message}}</h4>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection