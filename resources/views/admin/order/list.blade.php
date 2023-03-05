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
                    
                    <form action="{{route('order#changeStatus')}}" method="get">
                        @csrf
                        
                        <div class="d-flex">
                            <select class="form-control col-1" name="orderStatus">
                                <option value="">All</option>
                                <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                                <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
        
                            <button class="btn btn-dark text-white" type="submit">  <i class="fa-solid fa-magnifying-glass me-1"></i> search</button>
                          </div>
                        </form>                
              
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
                                <input type="hidden" class="orderId" value="{{$o->id}}">
                                <td class="">{{$o->user_id}}</td>
                                <td class="">{{$o->user_name}}</td>
                                <td class="">{{$o->created_at->format('j-M-Y')}}</td>
                               <td>
                                <a href="{{route('order#listInfo',$o->order_code)}}" class="text-decoration-none">{{$o->order_code}}</a>
                               </td>
                                <td class="">{{$o->total_price}} MMK</td>
                                <td class="">
                                    <select name="status"  @if($o->status == 0 ) class="form-control statusChange text-center bg-dark text-warning " @elseif ($o->status == 1) class="form-control statusChange text-center bg-dark text-success" @elseif($o->status == 2) class="form-control statusChange text-center bg-dark text-danger"@endif >
                                        <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                        <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                    </select>
                                </td>
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
    {{-- // $('#orderStatus').change(function(){
        //     $status = $('#orderStatus').val();

        //     $.ajax({
        //         type : 'get',
        //         url : 'http://localhost:8000/order/ajax/status',
        //         data :{
        //             'status' :$status,
        //         },
        //         dataType: 'json',
        //         success : function(response){
        //                 $list = '';
        //                 for ($i=0; $i<response.length; $i++) {

        //                     // date change
        //                     $months =['January','February','March','April','May','June','July','August','September','October','November','December'];
        //                     $dbDate = new Date(response[$i].created_at);
        //                     $finalDate =$months[$dbDate.getMonth()]  +'-'+ $dbDate.getDate()  +'-'+ $dbDate.getFullYear();

        //                     if (response[$i].status == 0) {
        //                         $statusMessage = `
        //                         <select name="status"  @if($o->status == 0 ) class="form-control statusChange text-center bg-dark text-warning" @elseif ($o->status == 1) class="form-control text-center bg-dark text-success" @elseif($o->status == 2) class="form-control text-center bg-dark text-danger"@endif >
        //                                 <option value="0" selected>Pending</option>
        //                                 <option value="1" >Accept</option>
        //                                 <option value="2" >Reject</option>
        //                             </select>
        //                         `;
        //                     }else if(response[$i].status == 1){
        //                         $statusMessage = `
        //                         <select name="status"  @if($o->status == 0 ) class="form-control statusChange text-center bg-dark text-warning" @elseif ($o->status == 1) class="form-control text-center bg-dark text-success" @elseif($o->status == 2) class="form-control text-center bg-dark text-danger"@endif >
        //                                 <option value="0" >Pending</option>
        //                                 <option value="1" selected>Accept</option>
        //                                 <option value="2" >Reject</option>
        //                             </select>
        //                         `;
        //                     }else if(response[$i].status == 2){

        //                     $statusMessage = `
        //                     <select name="status"  @if($o->status == 0 ) class="form-control statusChange text-center bg-dark text-warning" @elseif ($o->status == 1) class="form-control text-center bg-dark text-success" @elseif($o->status == 2) class="form-control text-center bg-dark text-danger"@endif >
        //                                 <option value="0" >Pending</option>
        //                                 <option value="1" >Accept</option>
        //                                 <option value="2" selected>Reject</option>
        //                             </select>
        //                     `;
        //                 }
                            
        //                   $list += ` <tr class="tr-shadow">
        //                         <input type="hidden" class="orderId" value="${response[$i].id}">
        //                         <td class="">${response[$i].user_id}</td>
        //                         <td class="">${response[$i].user_name}</td>
        //                         <td class="">${$finalDate}</td>
        //                         <td class="">${response[$i].order_code}</td>
        //                         <td class="">${response[$i].total_price}</td>
        //                         <td class="">${$statusMessage}</td>
        //                     </tr>`;
        //                 }
        //                 $('#dataList').html($list);
        //             }
        //         })
        // }) --}}

    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        
        $('.statusChange').change(function () {
               $currentStatus = $(this).val();
               $parentNode = $(this).parents('tr');
               $orderId = $parentNode.find('.orderId').val(); 

               $data = {
                    'status' :$currentStatus,
                    'orderId' :$orderId
                }; 

               $.ajax({
                type : 'get',
                url : 'http://localhost:8000/order/ajax/change/status',
                data : $data,
                dataType: 'json',
            });
            location.reload();
        })
    })
</script>
@endsection