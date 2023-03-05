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
                                <h2 class="title-1 text-dark"><i class="fa-solid fa-user-group"></i> User Account List : <span class="text-danger"> {{$users->total()}}   </span></h2>
                            </div>
                            
                        </div>
                    </div>
                   <div class="table-responsive table-responsive-data2">
                    @if (session('deletesuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('deletesuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                           @foreach ($users as $u)
                           <tr>
                            <td class="col-2 px-3">
                                 @if ( $u->image == null)
                                @if ($u->gender == 'male')
                                <img src="{{asset('admin/images/icon/user.png')}}" style="width: 250px;height:170px;"  class="img-thumbnail shadow-sm" alt="pic">
                                @else
                                <img src="{{asset('admin/images/icon/female.jpg')}}" style="width: 250px;height:170px;"  class="img-thumbnail" alt="pic">
                                @endif
                                @else
                                <img src="{{asset('storage/'.$u->image)}}" style="width: 250px;height:170px;"    class="img-thumbnail shadow-sm" alt="pic">  
                                @endif
                            </td>
                            <input type="hidden" id="userId" value="{{$u->id}}">
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->gender}}</td>
                            <td>{{$u->phone}}</td>
                            <td>{{$u->address}}</td>
                            <td>
                                <select name="role" class="form-control rounded-pill text-center statusChange">
                                    <option value="admin" @if ($u->role == 'admin') selected  @endif >Admin</option>
                                    <option value="user"  @if ($u->role == 'user') selected  @endif >User</option>
                                </select>
                            </td>
                            <td>
                                <div class="p-1 border rounded-pill">
                                    <a href="{{route('admin#userdelete', $u->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')" >
                                    <i class="fa-solid fa-trash-can "></i> Delete
                                    </button>
                                    </a>
                                </div> 
                            </td>
                        </tr> 
                           @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$users->links()}}
                    </div>
                </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        
        $('.statusChange').change(function () {
               $currentStatus = $(this).val();
               $parentNode = $(this).parents('tr');
               $userId = $parentNode.find('#userId').val(); 

               $data = {'userId' :$userId,'role':$currentStatus}; 

               $.ajax({
                type : 'get',
                url : '/user/change/role',
                data : $data,
                dataType: 'json',  
            })
            location.reload();
        })
    })
</script>
@endsection