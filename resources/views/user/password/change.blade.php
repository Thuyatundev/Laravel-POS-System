@extends('user.layouts.master')

@section('content')
  
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-body bg-dark text-warning">
                            @if (session('notMatch'))
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fa-regular fa-circle-check"></i> {{session('notMatch')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                            </div>
                            @endif

                            @if (session('changesuccess'))
                            <div class="col-12 py-2">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-regular fa-circle-check"></i> {{session('changesuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                            </div>
                            @endif
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-solid fa-unlock text-dark"></i> Change Your Password</h3>
                            </div>
                            <hr>
                            <form action="{{route('user#change')}}" method="post" novalidate="novalidate" class="p-3">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Old Password</label>
                                    <input  name="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                    @error('oldpassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input name="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                    @error('newpassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm Password</label>
                                    <input  name="confirmpassword" type="password" class="form-control @error('confirmpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                                    @error('confirmpassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-warning text-dark btn-block">
                                        <i class="fa-solid fa-key"></i>
                                        <span id="payment-button-amount">Change Password</span>                                        
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
 
@endsection