@extends('admin.layout.master')
@section('page_title')
  Orders
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
                    <th width="20%">Customer Name</th>
                    <th width="20%">Product Name</th>
                    <th width="25%">Product Image</th>
                    <th width="25%">Order Status</th>
                    <th width="25%">Action</th>
                  </tr>
                </thead>
                @forelse ($single_order as $single)
                <tr>
                  <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                  <td>{{$single->order_number}}</td>
                  <td>{{$single->name}}</td>
                  <td>{{$single->product_name}}</td>
                  <td>
                  @if($single->product_img == 'No image found')
                      <img src="/uploads/no-img.jpg" width="100" height="100" class="img-thumbnail" alt="No Image Found">
                    @else
                      <img src="/uploads/product/{{$single->product_img}}" width="100" height="100" class="img-thumbnail" alt="$single->product_name">
                    @endif
                    </td>
                    <td>{{$single->status}}</td> 
                   <td>
                    <a href="{{route('single.order.detail', ['id'=>$single->id])}}" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="{{Route('order.destroy', $single->id)}}" onclick="return confirm('Are You Sure You Want To Delete')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></a>
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
                                    <div>Showing {{($single_order->currentpage()-1)*$single_order->perpage()+1}} to {{$single_order->currentpage()*$single_order->perpage()}}
                                        of  {{$single_order->total()}} entries
                                    </div>
                                </span>
                            </div>
                          <div class="col-sm-6 text-right">
                              <ul class="pagination">
                                  {{$single_order->links()}}
                              </ul>
                          </div>
                        </div>
                    </div>
                
          </div>
            <!-- /.box-body -->
          </div>


    </section>
@endsection
