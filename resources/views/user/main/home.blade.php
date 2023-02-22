@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title text-uppercase mb-3"><span class="">Pizzas Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <hr class="bg-warning">
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <label class="h4" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal text-dark">{{count($category)}}</span>
                        </div>
                        <hr class="bg-warning">
                        
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <a href="{{route('user#home')}}" class="text-secondary"> <label class="pb-2" for="price-1">All</label></a>
                         </div>
                        @foreach ($category as $c)
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                           <a href="{{route('user#filter',$c->id)}}" class="text-secondary"> <label class="pb-2" for="price-1">{{$c->name}}</label></a>
                        </div>
                        @endforeach
                    </form>
                </div>
               
                <!-- Price End -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->  
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                               <a href="{{route('cart#pizzaCart')}}">
                                <button type="button" class="btn btn-dark position-relative"><i class="fa-solid fa-cart-plus text-white fs-4"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{count($cart)}}
                                    </span>
                                  </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Product List...</option>
                                        <option value="desc">Newest Food</option>
                                        <option value="asc">Latest Food</option>
                                    </select>
                                </div>
                                </div>
                                </div>
                         </div>
                    
                        <span class="row" id="dataList">
                        @if (count($pizza) != 0)
                        @foreach ($pizza as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 280px" src="{{asset('storage/'. $p->image)}}" alt="">
                                     <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href="{{route('cart#pizzaCart')}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetail', $p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                    </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{$p->price}}MMK</h5>  
                                    </div>
                                </div>
                            </div>
                        </div>    
                            @endforeach
                        @else
                            <div class="text-center text-dark fs-1 shadow py-5 my-5 col-6 offset-3">There is no pizza here! <i class="fa-solid fa-pizza-slice fs-1 text-danger"></i></div>
                        @endif
                        </span>
                    </div>
                </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
    $(document).ready(function(){
        $('#sortingOption').change(function(){
            $eventOption = $('#sortingOption').val();

            if ($eventOption == 'asc') {
                $.ajax({
                    type : 'get',
                    url  : 'http://localhost:8000/User/ajax/pizza',
                    data : {'status' : 'asc'},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for ($i=0; $i<response.length; $i++) {
                            
                            // console.log(`${response[$i].name}`);
                            $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 280px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                     <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}MMK</h5>  
                                    </div>
                                </div>
                            </div>
                        </div>`;
                            
                        }
                        $('#dataList').html($list); 
                    }
                });
            }else if($eventOption =='desc'){
                $.ajax({
                    type : 'get',
                    url  : 'http://localhost:8000/User/ajax/pizza',
                    data : {'status' : 'desc'},
                    dataType : 'json',
                    success : function(response){
                        $list = '';
                        for ($i=0; $i<response.length; $i++) {
                            
                          $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 280px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                     <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div> 
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}MMK</h5>  
                                    </div>
                                </div>
                            </div>
                        </div>`;
                        }
                        $('#dataList').html($list);
                    }
                });
            }
        })
    });
    </script>
@endsection
