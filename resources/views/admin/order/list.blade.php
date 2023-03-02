@extends('admin.layouts.master')

@section('title','Category-List')

@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="cont-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 text-dark"><i class="fa-solid fa-arrow-down-wide-short"></i> Order List : <span class="text-danger">{{count($order)}}</span></h2>

                            </div>
                        </div>
                    </div>
    
                  <div class="d-flex">
                    <select class="form-control col-1" id="orderStatus">
                        <option value="">All</option>
                        <option value="0">Pending</option>
                        <option value="1">Accept</option>
                        <option value="2">Reject</option>
                    </select>
                  </div>


                    {{-- <div class="">
                        <h4>Search Key : <span class="text-danger">{{request('key')}}</span></h4>
                    </div>

                    <div class="col-3 offset-9">
                        <form action="{{route('product#createPage')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search Product ..." value="{{request('key')}}">
                                <button type="submit" class="btn btn-dark text-white">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div> --}}

                   

              
                   <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="tr-shadow">
                                <td class="">{{$o->user_id}}</td>
                                <td class="">{{$o->user_name}}</td>
                                <td class="">{{$o->created_at->format('j-M-Y')}}</td>
                                <td class="">{{$o->order_code}}</td>
                                <td class="">{{$o->total_price}} MMK</td>
                                <td class="">
                                    <select name="status"  @if($o->status == 0 ) class="form-control text-center bg-dark text-warning" @elseif ($o->status == 1) class="form-control text-center bg-dark text-success" @elseif($o->status == 2) class="form-control text-center bg-dark text-danger"@endif >
                                        <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                        <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                    </select>
                            </tr>
                            @endforeach
                    
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{-- {{$order->links()}} --}}
                    </div>
                </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        $('#orderStatus').change(function(){
            $status = $('#orderStatus').val();

            $.ajax({
                type : 'get',
                url : 'http://localhost:8000/order/ajax/status',
                data :{
                    'status' :$status,
                },
                dataType: 'json',
                success : function(response){
                        $list = '';
                        for ($i=0; $i<response.length; $i++) {
                            
                          $list += ` <tr class="tr-shadow">
                                <td class="">${response[$i].user_id}</td>
                                <td class="">${response[$i].user_name}</td>
                                <td class="">${response[$i].created_at}</td>
                                <td class="">${response[$i].order_code}</td>
                                <td class="">${response[$i].total_price}</td>
                                <td class="">
                                    <select name="status"  @if($o->status == 0 ) class="form-control text-center bg-dark text-warning" @elseif ($o->status == 1) class="form-control text-center bg-dark text-success" @elseif($o->status == 2) class="form-control text-center bg-dark text-danger"@endif >
                                        <option value="0" ${response[$i].status}>Pending</option>
                                        <option value="1" ${response[$i].status}>Accept</option>
                                        <option value="2" ${response[$i].status}>Reject</option>
                                    </select>
                            </tr>`;
                        }
                        $('#dataList').html($list);
                    }
            })
        
        })
    })
</script>
@endsection