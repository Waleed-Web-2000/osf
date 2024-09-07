@extends('admin.layout.master')
@section('page_title')
  Order Details
@endsection
@section('main_content')
    <section class="content">      
      <!-- /.row -->
        <div class="box">
            <div class="box-header with-border">
              <div class="box-tools">
                <form method="get" action="/admin/category">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="s" class="form-control pull-right" placeholder="Search" value="{{ request('s') ? request('s'):null}}">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if($ord)
              <table class="table table-bordered">
                <thead style="background-color: #F8F8F8;">
                  <tr>
                    <th width="10%">Order No</th>
                    <th width="20%">Quantity</th>
                    <th width="20%">Product Name</th>
                    <th width="25%">Product Image</th>
                    <th width="25%">Price</th>
                    <th width="25%">Status</th>
                  </tr>
                </thead>
                @foreach($ord as $or)
                <tr>
                  <td>{{$or->order_number}}</td>
                  <td>{{$or->quantity}}</td>
                  <td>{{$or->product_name}}</td>
                  <td> <img src="/uploads/product/{{$or->product_img}}" width="150" height="100" class="img-thumbnail" alt=""></td> 
                  <td>{{$or->price}}</td> 
                  <td>{{$or->status}}</td> 
                </tr>

                <thead style="background-color: #F8F8F8;">
                  <tr>
                    <th width="10%">Customer Name</th>
                    <th width="20%">Customer Address</th>
                    <th width="20%">Customer Phone</th>
                    <th width="25%">Customer City</th>
                    <th width="25%">Customer Subotal</th>
                  </tr>
                </thead>
                <br>
                <tr>
                  <td>{{$or->name}}</td>
                  <td>{{$or->address}}</td>
                  <td>{{$or->phone}}</td>
                  <td>{{$or->city}}</td>
                  <td>{{$or->subtotal}}</td> 
                </tr>
                @endforeach
            </table>
            <form action="{{route('admin.buy.order.status.update')}}" method="POST">
        @csrf
        @method("PUT")
        <input type="hidden" name="buy_id" value="{{ $or->id }}"  />
        <div class="row">
            <div class="col-md-3">
                <div class="select">
                    <select id="order_status" name="buy_order_status">                            
                        <option value="ordered" {{$or->status=="pending" ? "selected":""}}>Pending</option>
                        <option value="delivered" {{$or->status=="delivered" ? "selected":""}}>Delivered</option>
                        <option value="canceled" {{$or->status=="canceled" ? "selected":""}}>Canceled</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary tf-button w208">Update</button>
            </div>                    
        </div>
    </form>
            </div>
            <!-- /.box-body -->
              <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-6">
                                <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                                    <div>Showing {{($ord->currentpage()-1)*$ord->perpage()+1}} to {{$ord->currentpage()*$ord->perpage()}}
                                        of  {{$ord->total()}} entries
                                    </div>
                                </span>
                            </div>
                          <div class="col-sm-6 text-right">
                              <ul class="pagination">
                                  {{$ord->links()}}
                              </ul>
                          </div>
                        </div>
                    </div>
                @else
                  <div class="alert alert-danger">No Record Found</div>    
                @endif
          </div>
            <!-- /.box-body -->
          </div>
    </section>
@endsection
