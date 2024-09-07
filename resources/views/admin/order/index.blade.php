@extends('admin.layout.master')
@section('page_title')
  Manage Category
@endsection
@section('main_content')
  <section class="content">
      
      <!-- /.row -->
     <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> 
                    <a class="btn btn-danger btn-xm"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-danger btn-xm"><i class="fa fa-eye-slash"></i></a>
                    <a class="btn btn-danger btn-xm"><i class="fa fa-trash"></i></a>
              </h3>
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
              <table class="table table-bordered">
                <thead style="background-color: #F8F8F8;">
                  <tr>
                    <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                    <th width="10%">Order No</th>
                    <th width="15%">Customer Name</th>
                    <th width="10%">Phone</th>
                    <th width="10%">Subtotal</th>
                    <th width="10%">Total Items</th>
                    <th width="10%">Status</th>
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                @forelse($orders as $order)

                <tr>
                  <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                  <td>{{$order->order_number}}</td>
                  <td>{{$order->name}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->subtotal}}</td>
                  <td>{{$order->orderItems->count()}}</td>
                  <td>{{$order->status}}</td>
                   <td>
                    <a href="{{route('order.detail',['order_id'=>$order->id])}}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="{{Route('order.destroy', $order->id)}}" onclick="return confirm('Are You Sure You Want To Delete')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></a>
                   </td> 
                </tr>
                 @empty
                  <div class="alert alert-danger">No Record Found</div>
                @endforelse
            </table>
            </div>
            <!-- /.box-body -->
              <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-6">
                                <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                                    <div>Showing {{($orders->currentpage()-1)*$orders->perpage()+1}} to {{$orders->currentpage()*$orders->perpage()}}
                                        of  {{$orders->total()}} entries
                                    </div>
                                </span>
                            </div>
                          <div class="col-sm-6 text-right">
                              <ul class="pagination">
                                  {{$orders->links()}}
                              </ul>
                          </div>
                        </div>
                    </div>    
          </div>
            <!-- /.box-body -->
          </div>
    </section>
@endsection
