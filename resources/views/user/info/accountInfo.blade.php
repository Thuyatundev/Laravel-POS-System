
@extends('user.layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body bg-dark text-white">
                        <div class="card-title">
                            <a href="{{route('user#accountDetail')}}" class="text-decoration-none text-white"><i class="fa-solid fa-arrow-left"></i> </a>
                            <h3 class="text-center title-2"><i class="fa-solid fa-user-pen"></i> User Account Edit</h3>
                        </div>

                        @if (session('updateAccount'))
                        <div class="col-10 offset-1 mt-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-regular fa-circle-check"></i> {{session('updateAccount')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif
                        
                        <hr>
                        <form action="{{route('user#changeAccount',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6  col-md-6 text-center">
                                    @if (Auth::user()->image == null)
                                         @if (Auth::user()->gender == 'male')
                                        <img src="{{asset('admin/images/icon/user.png')}}" style="width: 310px;height:310px;"   class="image-thumbnail shadow-sm" alt="pic">
                                        @else
                                        <img src="{{asset('admin/images/icon/female.jpg')}}" style="width: 310px;height:310px;"  class="image-thumbnail shadow-sm" alt="pic">
                                        @endif
                                    @else
                                    <img src="{{asset('storage/'. Auth::user()->image)}}" style="width: 310px;height:310px;" class="rounded image-thumbnail shadow-sm" alt="Thura"/>
                                    @endif
                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"  >
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button class="text-dark btn btn-light col-12">
                                            Update <i class="fa-solid fa-circle-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="row col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input  name="name" type="text" value="{{ old('name', Auth::user()->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name..."> 
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input  name="email" type="email" value="{{ old('email',Auth::user()->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter email...">
                                        @error('email')
                                         <div class="invalid-feedback">
                                        {{$message}}
                                         </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input  name="phone" type="text" value="{{ old('phone',Auth::user()->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter phone...">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" >
                                            <option value="">Choose Your Gender...</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input  name="role" type="text" value="{{ old('role',Auth::user()->role)}}" class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name..." disabled>  
                                        @error('categoryName')
                                        <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                     @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                       <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="20" rows="5">{{ old('address',Auth::user()->address)}}</textarea>
                                       @error('address')
                                       <div class="invalid-feedback">
                                       {{$message}}
                                       </div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1"> <i class="fa-solid fa-circle text-success"></i> User Active</label> 
                                        <input  name="create" type="text" value="{{ old('create',Auth::user()->created_at->diffForHumans())}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Name..." disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection