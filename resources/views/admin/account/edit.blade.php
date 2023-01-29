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
                                <h3 class="text-center title-2"><i class="fa-solid fa-user-pen"></i> Account Edit</h3>
                            </div>
                            <hr>
                            <form action="" method="" novalidate="novalidate">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if (Auth::user()->image == null)
                                        <img src="{{asset('admin/images/icon/user.png')}}" alt="user"/>
                                        @else
                                        <img src="{{asset('admin/images/icon/tyt.jpg')}}" alt="Thura"/>
                                        @endif
                                        <div class="">
                                            <input type="file" class="form-control" name="">
                                        </div>
                                        <div class="mt-3">
                                            <button class="text-white btn btn-dark col-12">
                                                Update <i class="fa-solid fa-circle-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input  name="name" type="text" value="{{ old('name', Auth::user()->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name..."> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input  name="email" type="email" value="{{ old('email',Auth::user()->email)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                           
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input  name="phone" type="text" value="{{ old('phone',Auth::user()->phone)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                           
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input  name="role" type="text" value="{{ old('role',Auth::user()->role)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name..." disabled>  
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                           <textarea name="address" class="form-control" cols="20" rows="5">{{ old('address',Auth::user()->address)}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">User Active</label>
                                            <input  name="name" type="text" value="{{ old('address',Auth::user()->created_at->diffForHumans())}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
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
    <!-- END MAIN CONTENT-->
@endsection