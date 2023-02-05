@extends('admin.layouts.master')


@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="{{route('adminAccount#detail')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-solid fa-user-pen"></i> Account Edit</h3>
                            </div>
                            <hr>
                            <form action="{{route('adminAccount#update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if (Auth::user()->image == null)
                                        <img src="{{asset('admin/images/icon/user.png')}}" alt="user"/>
                                        @else
                                        <img src="{{asset('storage/'. Auth::user()->image)}}" class="rounded img-thumbnail shadow-sm" alt="Thura"/>
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
                                            <button class="text-white btn btn-dark col-12">
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
                                            <label class="control-label mb-1">User Active</label>
                                            <input  name="create" type="text" value="{{ old('create',Auth::user()->created_at->diffForHumans())}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
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