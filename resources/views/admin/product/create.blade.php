@extends('admin.layouts.master')


@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('product#createPage')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-solid fa-circle-plus text-success"></i> Create Your Product</h3>
                            </div>
                            <hr>

                            <form action="{{route('product#create')}}" enctype="multipart/form-data" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text" value="{{ old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Name">
                                    @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                              

                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                   <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror ">
                                    <option value="">Choose Your Category</option>
                                    @foreach ($categories as $c)
                                        <option value="{{$c ->id }}">{{ $c->name }}</option>
                                    @endforeach
                                   </select>
                                   @error('pizzaCategory')
                                   <div class="invalid-feedback">
                                       {{$message}}
                                   </div>
                                   @enderror
                                </div>
                               

                                <div class="form-group">
                                    <label class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" type='text' cols="30" rows="10" placeholder="Text Message...">{{old('pizzaDescription')}}</textarea>
                                    @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                    {{$message}}
                                     </div>
                                    @enderror
                                </div>

                                
                                <div class="form-group">
                                    <label class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="pizzaTime" type="number" value="{{ old('pizzaTime')}}"  class="form-control @error('pizzaTime') is-invalid @enderror" >
                                    @error('pizzaTime')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                

                                <div class="form-group">
                                    <label class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="pizzaImage" type="file" class="form-control @error('pizzaImage') is-invalid @enderror" >
                                    @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                               

                                <div class="form-group">
                                    <label class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number" value="{{ old('pizzaPrice')}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="price">
                                    @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    
                                </div>
                               
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-success text-white btn-block">
                                        <i class="fa-solid fa-circle-right"></i>
                                        <span id="payment-button-amount">Create</span>
                                    </button>
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