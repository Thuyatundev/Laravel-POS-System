@extends('admin.layouts.master')


@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                            <div class="col-lg-11 offset-1">
                                <a href="{{route('adminAccount#list')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
                            </div>
                    <div class="col-lg-10 offset-1">
                    <div class="card">
                       
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-solid fa-person-circle-question"></i> Change Account Role</h3>
                            </div>
                            <hr>
                            <form action="{{route('adminAccount#change',$account->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if ($account->image == null)
                                             @if ($account->gender == 'male')
                                            <img src="{{asset('admin/images/icon/user.png')}}" style="width: 350px;height:200px;"  class="image-thumbnail shadow-sm" alt="pic">
                                            @else
                                            <img src="{{asset('admin/images/icon/female.jpg')}}" style="width: 350px;height:200px;" class="image-thumbnail shadow-sm" alt="pic">
                                            @endif
                                        @else
                                        <img src="{{asset('storage/'. $account->image)}}"  class="rounded img-thumbnail shadow-sm" alt="Thura"/>
                                        @endif
                                        <div class="mt-3">
                                            <button class="text-white btn btn-dark col-12">
                                               Admin Role Change &nbsp;<i class="fa-solid fa-circle-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control bg-success text-white @error('role') is-invalid @enderror" >
                                                <option value="admin" @if ($account->role == 'admin') selected  @endif >Admin</option>
                                                <option value="user"  @if ($account->role == 'user') selected  @endif >User</option>
                                            </select>
                                            @error('role')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input  name="name" disabled  type="text" value="{{ old('name', $account->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name..."> 
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input  name="email" disabled type="email" value="{{ old('email',$account->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter email...">
                                            @error('email')
                                             <div class="invalid-feedback">
                                            {{$message}}
                                             </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input  name="phone" disabled type="text" value="{{ old('phone',$account->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror" >
                                                <option value="">Choose Your Gender...</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                             @enderror
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                           <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" cols="20" rows="5">{{ old('address',$account->address)}}</textarea>
                                           @error('address')
                                           <div class="invalid-feedback">
                                           {{$message}}
                                           </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">User Active</label>
                                            <input  name="create" disabled type="text" value="{{ old('create',$account->created_at->diffForHumans())}}" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
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