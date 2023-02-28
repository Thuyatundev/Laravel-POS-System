@extends('user.layouts.master')

@section('content')
    
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-muted table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                    </thead>
                    <tbody class="align-middle table-secondary">
                       @foreach ($order as $o)
                        <tr>                       
                            <td class="align-middle" > {{$o->created_at->format('j-M-Y')}} </td>
                            <td class="align-middle" > {{$o->order_code}} </td>
                            <td class="align-middle" > {{$o->total_price}} </td>
                            <td class="align-middle" > 
                            @if ($o->status == 0)
                                <span class="text-warning "><i class="fa-solid fa-clock"></i> Pending...</span>
                            @elseif ($o->status == 1)
                                <span class="text-success "><i class="fa-solid fa-circle-check"></i> Success...</span>
                            @elseif($o->status == 2)
                                <span class="text-danger "><i class="fa-solid fa-circle-exclamation"></i> Reject...</span>
                            @endif 
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$order->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection