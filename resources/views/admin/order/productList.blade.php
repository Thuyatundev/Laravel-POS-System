@extends('admin.layouts.master')

@section('title','Category-List')

@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="cont-fluid">
                <div class="col-md-12"> 
                   <div class="table-responsive table-responsive-data2">
                    <a href="{{route('order#list')}}" class="text-decoration-none text-dark"><i class="fa-solid fa-arrow-left-long me-2"></i> Back</a>

                    <div class="row col-5">
                        <div class="card mt-4">
                            <div class="card-body p-3">
                                <h3><i class="fa-regular fa-clipboard"></i> Order Info...</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-circle-user me-2"></i> Name</div>
                                    <div class="col">{{$orderList[0]->user_name}}</div>
                                </div>
                                <div class="row">
                                    <div class="col"><i class="fa-solid fa-barcode me-2"></i> Order Code</div>
                                    <div class="col">{{$orderList[0]->order_code}}</div>
                                </div>
                                <div class="row">
                                    <div class="col"> <i class="fa-solid fa-calendar-days me-2"></i> Order Date</div>
                                    <div class="col">{{$orderList[0]->created_at->format('j-F-y')}}</div>
                                </div>
                                <div class="row">
                                    <div class="col"> <i class="fa-solid fa-comment-dollar me-2"></i></i> Total Price</div>
                                    <div class="col">{{$order->total_price}} MMK <small class=" text-danger">**Include Delivery Fee**</small>    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($orderList as $o)
                            <tr class="tr-shadow">
                                <td></td>
                                <td class="">{{$o->user_id}}</td>
                                <td>{{$o->user_name}}</td>
                                <td><img src="{{asset('storage/'.$o->product_image)}}" style='width:100px;height:100px;' class="image-thumbnail shadow-sm"></td>
                                <td>{{$o->product_name}}</td>
                                <td>{{$o->created_at->format('j-F-y')}}</td>
                                <td >{{$o->qty}}</td>
                                <td >{{$o->total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection

