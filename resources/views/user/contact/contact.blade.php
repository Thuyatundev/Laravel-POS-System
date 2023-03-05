@extends('user.layouts.master')

@section('content')
  
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-body bg-dark text-white">
                            @if (session('sendsuccess'))
                            <div class="col-12 py-2">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-regular fa-circle-check"></i> {{session('sendsuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                            </div>
                            @endif
                            <div class="card-title">
                                <h3 class="text-center title-2"> Send Your Advice <i class="fa-solid fa-lightbulb"></i></h3>
                            </div>
                            <hr>
                            <form action="{{route('contact#store')}}" method="post" novalidate="novalidate" class="p-3">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Title</label>
                                    <input  name="title" type="text" class="form-control @error('title') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Title..." value="{{old('title')}}">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Message</label>
                                    <textarea name="message" id="" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder="Enter Your Messages..." >{{old('message')}}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                     @enderror
                                </div>        
                                <div class="pt-3">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-light text-dark btn-block col-5">
                                        
                                        <span id="payment-button-amount"><i class="fa-regular fa-paper-plane"></i> Send Your Message</span>                                        
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