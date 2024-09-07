@extends('admin.layout.master')
@section('page_title')
  Order Details
@endsection
@section('main_content')
<style>
    .table-transaction>tbody>tr:nth-of-type(odd) {
        --bs-table-accent-bg: #fff !important; 
    }    
</style>
<div class="main-content-inner">                            
    <div class="main-content-wrap">
               
        
        <div class="wg-box mt-5 mb-5">            
    
            <table class="table table-striped table-bordered table-transaction">
                <tr>
                    <th>Order No</th>
                    <td>{{"1" . str_pad($transaction->order->id,4,"0",STR_PAD_LEFT)}}</td>
                    <th>Order Date</th>
                    <td>{{$transaction->order->created_at}}</td>
                    <th>Order Status</th>
                    <td colspan="5">
                        @if($transaction->order->status=='delivered')
                            <span class="badge bg-success">Delivered</span>
                        @elseif($transaction->order->status=='canceled')
                            <span class="badge bg-danger">Canceled</span>
                        @else
                            <span class="badge bg-warning">Ordered</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>        
        
        <div class="">
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Return Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderitems as $orderitem)
                        <tr>
                            
                            <td class="pname">
                                <div class="image">
                                    @if($orderitem->product->image == 'No image found')
                                    <img src="/uploads/no-img.jpg" alt="" width="100" alt="100" class="img-thumbnail">
                                    @else
                                    <img src="/uploads/product/{{$orderitem->product->image}}" width="100" alt="100" class="img-thumbnail">
                                    @endif
                                </div>
                                <div class="name">
                                    <a href="{{ route('product-detail', $orderitem->product->slug) }}" target="_blank" class="body-title-2 text-center">{{$orderitem->product->name}}</a>                                    
                                </div>  
                            </td>
                            <td class="text-center">Rs/{{$orderitem->price}}</td>
                            <td class="text-center">{{$orderitem->quantity}}</td>
                            <td class="text-center">{{$orderitem->product->SKU}}</td>

                            <td class="text-center">{{$orderitem->rstatus == 0 ? "No":"Yes"}}</td>                                                                                
                            <td class="text-center">
                                <a href="" target="_blank">
                                    <div class="list-icon-function view-icon">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>                                                                    
                                    </div>
                                </a>
                            </td>
                        </tr>
                        @endforeach                                  
                    </tbody>
                </table>
            </div>
            
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">                
                {{$orderitems->links('pagination::bootstrap-5')}}
            </div>
        </div>

        <div class="col-md-12 text-center">
            <h2>Shipping Address</h2>
            <div class="col-md-12 text-center">                
                <div class="table table-striped table-bordered">
                    <td><h4>Name : {{$transaction->order->name}}</h4></td>
                    <td><h4>Address : {{$transaction->order->address}}</h4></td>
                    <td><h4>City : {{$transaction->order->city}}</h4></td>
                    <td><h4>Mobile : {{$transaction->order->phone}}</h4></td>
                </div>
            </div>              
        </div>

        <div class="mt-5 bg-secondary">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Subtotal</th>
                    <td>Rs/{{$transaction->order->subtotal}}</td>
                    <th>Payment Mode</th>
                    <td>{{$transaction->mode}}</td>
                    <th>Status</th>
                    <td>
                        @if($transaction->status=='approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($transaction->status=='declined')
                            <span class="badge bg-danger">Declined</span>
                        @elseif($transaction->status=='refunded')
                            <span class="badge bg-secondary">Refunded</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                    <form action="{{route('admin.order.status.update')}}" method="POST">
        @csrf
        @method("PUT")
        <input type="hidden" name="order_id" value="{{ $transaction->order->id }}"  />
        <div class="row">
            <div class="col-md-3">
                <div class="select">
                    <select id="order_status" name="order_status">                            
                        <option value="ordered" {{$transaction->order->status=="ordered" ? "selected":""}}>Ordered</option>
                        <option value="delivered" {{$transaction->order->status=="delivered" ? "selected":""}}>Delivered</option>
                        <option value="canceled" {{$transaction->order->status=="canceled" ? "selected":""}}>Canceled</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary tf-button w208">Update</button>
            </div>                    
        </div>
    </form></td>
                </tr>               
            </table>
        </div>       
    </div>
</div>

@endsection
