@extends('admin.layouts.master')


@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="{{route('product#createPage')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-solid fa-user-pen"></i> Product Edit</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-3 offset-2">
                                        <input type="hidden" name="pizzaId" value="{{ $pizzas->id }}">    
                                        <img src="{{asset('storage/'. $pizzas->image)}}" class="rounded img-thumbnail shadow-sm" alt="Thura"/>
                                       
                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror"  >
                                            @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button class="text-white btn btn-dark col-12" type="submit">
                                                Update <i class="fa-solid fa-circle-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="row col-6">
                                        
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input  name="pizzaName" type="text" value="{{ old('pizzaName' , $pizzas->name)}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizzaName..."> 
                                            @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" type='text' cols="30" rows="10" placeholder="Text Message...">{{old('pizzaDescription',$pizzas->description)}}</textarea>
                                            @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                             </div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <input  name="pizzaDescription" type="text" value="{{ old('pizzaDescription',)}}" class="form-control @error('pizzaDescription') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizzaDescription...">
                                            @error('pizzaDescription')
                                             <div class="invalid-feedback">
                                            {{$message}}
                                             </div>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" >
                                                <option value="">Choose Your Pizza Category...</option>
                                               @foreach ($categories as $c)
                                                   <option value="{{$c->id}}" @if($pizzas->category_id == $c->id) selected @endif >{{$c->name}}</option>
                                               @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input  name="pizzaPrice" type="text" value="{{ old('pizzaPrice',$pizzas->price)}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizzaPrice...">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input  name="pizzaTime" type="number" value="{{ old('pizzaTime',$pizzas->waitingtime)}}" class="form-control @error('pizzaTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizzaTime...">
                                            @error('pizzaTime')
                                                <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                             @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">View</label>
                                            <input  name="viewcount" type="number" value="{{ old('viewcount',$pizzas->view_count)}}" class="form-control @error('viewcount') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name..." disabled>  
                                            @error('viewcount')
                                            <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                         @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Created Time</label>
                                            <input  name="create_at" type="text" value="{{ old('create_at',$pizzas->created_at->diffForHumans())}}" class="form-control" aria-required="true" aria-invalid="false" disabled>
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