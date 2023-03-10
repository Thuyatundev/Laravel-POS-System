@extends('user.layouts.master')

@section('content')
    
    <!-- Cart Start -->
    <div class="container-fluid">
        
        <div class="row px-xl-5">
            <a href="{{route('user#home')}}" class="text-decoration-none text-dark my-3">
                <i class="fa-solid fa-arrow-left-long "></i> back
            </a>
           
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Gallery</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                        <tr>
                            {{-- <input type="hidden" id="price" value="{{$c->pizzaPrice}}"> --}}
                            <td><img src="{{asset('storage/'. $c->pizzaImage)}}" alt="" style="width: 100px;height:70px;" class="img-thumbnail"></td>
                            <td class="align-middle">
                                {{$c->pizzaName}}
                                <input type="hidden" class="orderId" value="{{$c->id}}">
                                <input type="hidden" class="productId" value="{{$c->product_id}}">
                                <input type="hidden" class="userId" value="{{$c->user_id}}">
                            </td>
                            <td class="align-middle" id="price">{{$c->pizzaPrice}} MMK</td>
                            
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-dark btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                   
                                    <input type="text" class="form-control form-control-sm bg-danger border-0 text-white text-center" value="{{$c->qty}}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-dark btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle col-3" id="total">{{$c->pizzaPrice*$c->qty}} MMK</td>
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
                            <h6 id="subTotalPrice">{{$totalPrice}} MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium"><i class="fa-solid fa-truck"></i> Delivery Fee</h6>
                            <h6 class="font-weight-medium"> 2500 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total Amount <i class="fa-solid fa-sack-dollar"></i></h5>
                            <h5 class="text-danger" id="finalPrice">{{$totalPrice+2500}} MMK</h5>
                        </div>
                        <button class="btn btn-block btn-dark font-weight-bold my-3 py-3" id="btnPlus">Order</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearbtn"> Remove All </button>
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
                // when plus button click
                $('.btn-plus').click(function(){
                    $parentNode = $(this).parents("tr");
                    // $price = $parentNode.find('#price').val();
                    $price = Number($parentNode.find('#price').text().replace('MMK',""));
                    $qty = Number($parentNode.find('#qty').val());

                    $total = $price*$qty;
                    $parentNode.find('#total').html($total+' MMK');
                    summaryCalculation();
                })
                // when minus button click
                $('.btn-minus').click(function(){
                    $parentNode = $(this).parents("tr");
                    // $price = $parentNode.find('#price').val();
                    $price = Number($parentNode.find('#price').text().replace('MMK',""));
                    $qty = Number($parentNode.find('#qty').val());

                    $total = $price*$qty;
                    $parentNode.find('#total').html($total+' MMK');
                    summaryCalculation();
                })

                // when cross button click
                $('.btnRemove').click(function(){
                    $parentNode = $(this).parents('tr');
                    $productId = $parentNode.find('.productId').val();
                    $orderId = $parentNode.find('.orderId').val();

                    $.ajax({
                        type: 'get',
                        url: '/User/ajax/crossbtn',
                        data : {'productId' : $productId , 'orderId': $orderId},
                        dataType: 'json',
                    })

                    $parentNode.remove();
                    summaryCalculation();
                })

                // calcutation final price for order
                function summaryCalculation()
                {
                    $totalPrice = 0;
                    $('#dataTable tbody tr').each(function(index,row){
                        $totalPrice += Number($(row).find('#total').text().replace("MMK", ""));
                    });

                    $('#subTotalPrice').html(`${$totalPrice} MMK`);
                    $("#finalPrice").html(`${$totalPrice + 2500} MMK`);
                }
            });

            // order
            $("#btnPlus").click(function(){
    
                    $orderList = [];

                    $random = Math.floor(Math.random() * 10000000001);

                   

                    $('#dataTable tbody tr').each(function(index,row){
                        $orderList.push({
                            'user_id' : $(row).find('.userId').val(),
                            'product_id' : $(row).find('.productId').val(),
                            'qty' : $(row).find('#qty').val(),
                            'total' : $(row).find('#total').text().replace("MMK","")*1,
                            'order_code' : 'POS'+ $random + 'CODE'
                        });
                    });
        
                    $.ajax({
                    type : 'get',
                    url  :  '/User/ajax/order',
                    data :  Object.assign({}, $orderList),
                    dataType : 'json',
                    success : function(response){
                        if (response.status == 'true') {
                            window.location.href = 'http://127.0.0.1:8000/User/userhome';
                        }
                    }
                    });
                });
            
            // Remove All
            $('#clearbtn').click(function(){
                $.ajax({
                    type : 'get',
                    url : '/User/ajax/clear/cart',
                    dataType : 'json',
                })

                $('#dataTable tbody tr').remove();
                $('#subTotalPrice').html('0 MMK');
                $('#finalPrice').html('2500 MMK');

            })

        </script>
@endsection