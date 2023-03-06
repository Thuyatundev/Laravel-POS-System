@extends('user.layouts.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <a href="{{route('user#home')}}" class="text-decoration-none text-dark ">
                        <i class="fa-solid fa-arrow-left-long"></i> back
                    </a>
                    <div class="carousel-inner bg-light mt-3">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{asset('storage/'.$pizzaList->image)}}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30 ">
                <div class="h-100 bg-light p-30">
                    <h3>{{$pizzaList->name}}</h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1">{{$pizzaList->view_count + 1}} <i class="fa-solid fa-eye"></i></small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$pizzaList->price}} MMK</h3>
                    <p class="mb-4 text-muted">{{$pizzaList->description}}</p>
                    <input type="hidden" value="{{Auth::user()->id}}" id="userId">
                    <input type="hidden" value="{{$pizzaList->id}}" id="pizzaId">
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-danger btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-dark text-white border-0 text-center" value="1" id="orderCount">
                            <div class="input-group-btn">
                                <button class="btn btn-danger btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger px-3" id="addCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-white rounded bg-primary px-2" href="https://facebook.com">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-primary px-2" href="https://twitter.com/i/flow/single_sign_on">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-white rounded bg-primary px-2" href="https://www.linkedin.com/">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-danger px-3" href="https:pinterest.com">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">{{$pizzaList->name}}</h4>
                            <p class="text-muted">{{$pizzaList->description}}</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaInfo as $item)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('storage/'.$item->image)}}" style="height:250px;" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail', $item->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$item->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$item->price}}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-danger mr-1"></small>
                                <small class="fa fa-star text-danger mr-1"></small>
                                <small class="fa fa-star text-danger mr-1"></small>
                                <small class="fa fa-star text-danger mr-1"></small>
                                <small class="fa fa-star text-danger mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function () {

            // increase pizza view count
            $.ajax({
                    type : 'get',
                    url: '/User/ajax/increase/viewCount',
                    data: { 'productId' : $('#pizzaId').val()},
                    dataType:'json',
                });

            // click add to cart btn
            $('#addCartBtn').click(function(){
                $source = {
                    'userId' : $('#userId').val(),
                    'pizzaId' : $('#pizzaId').val(),
                    'count' : $('#orderCount').val()
                };

                $.ajax({
                    type : 'get',
                    url: '/User/ajax/addToCart',
                    data: $source,
                    dataType:'json',
                    success:function(response){
                        if (response.status == 'success') {
                            window.location.href = '/User/userhome';
                        }
                    }
                });
            })
        })
    </script>
@endsection