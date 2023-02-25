@extends('user.layouts.master')

@section('content')
    
    <!-- Cart Start -->
    <div class="container-fluid">
        
        <div class="row px-xl-5">
            <a href="{{route('user#home')}}" class="text-decoration-none text-dark my-3">
                <i class="fa-solid fa-arrow-left-long "></i> back
            </a>
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $cart)
                        <tr>
                            <input type="hidden" id="price" value="{{$cart->pizzaPrice}}">
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">{{$cart->pizzaName}}</td>
                            <td class="align-middle">{{$cart->pizzaPrice}} MMK</td>
                            
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                   
                                    <input type="text" class="form-control form-control-sm bg-dark border-0 text-white text-center" value="{{$cart->qty}}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{$cart->pizzaPrice*$cart->qty}} MMK</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6> <i class="fa-solid fa-dollar-sign"></i> Total Price</h6>
                            <h6>{{$totalPrice}} MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium"><i class="fa-solid fa-truck"></i> Delivery Fee</h6>
                            <h6 class="font-weight-medium"> 3500 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total Amount <i class="fa-solid fa-sack-dollar"></i></h5>
                            <h5 class="text-danger">{{$totalPrice+3500}} MMK</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@section('scriptSource')
        <script>
            $(document).ready(function(){
                $('.btn-plus').click(function(){
                    $parentNode = $(this).parents("tr");
                    $price = $parentNode.find('#price').val();
                    $qty = Number($parentNode.find('#qty').val());

                    $total = $price*$qty;
                    $parentNode.find('#total').html($total+' MMK');
                })
                $('.btn-minus').click(function(){
                    $parentNode = $(this).parents("tr");
                    $price = $parentNode.find('#price').val();
                    $qty = Number($parentNode.find('#qty').val());

                    $total = $price*$qty;
                    $parentNode.find('#total').html($total+' MMK');
                })
                $('.btnRemove').click(function(){
                    $parentNode = $(this).parents('tr');
                    $parentNode.remove();
                })
            });
            
        </script>
@endsection