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
                    <a href="{{Route('category.create')}}" class="btn btn-default btn-xm"><i class="fa fa-plus"></i></a>
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
              @if($categories)
              <table class="table table-bordered">
                <thead style="background-color: #F8F8F8;">
                  <tr>
                    <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                    <th width="10%">Id</th>
                    <th width="40%">Title</th>
                    <th width="10%">Image</th>
                    <th width="10%">Status</th>
                    <th width="10%">Manage</th>
                  </tr>
                </thead>
                @foreach($categories as $category)
                <tr>
                  <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                  <td>{{$category->id}}</td>
                  <td>{{$category->title}}</td>
                  <td>
                    @if($category->category_img == 'No image found')
                      <img src="/uploads/no-img.jpg" width="100" height="100" class="img-thumbnail" alt="No Image Found">
                    @else
                      <img src="/uploads/category/{{$category->category_img}}" width="100" height="100" class="img-thumbnail" alt="$category->title">
                    @endif
                  </td>
                  <td>
                  @if($category->status == "DEACTIVE")
                    <a href="{{Route('category.status', $category->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
                  @else  
                    <a href="{{Route('category.status', $category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></a>
                  @endif  
                  </td>
                  <td>
                      <a href="{{Route('category.edit', $category->id)}}" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                      <a href="{{Route('category.destroy', $category->id)}}" onclick="return confirm('Are You Sure You Want To Delete')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
                @endforeach
            </table>
            </div>
            <!-- /.box-body -->
              <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-6">
                                <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                                    <div>Showing {{($categories->currentpage()-1)*$categories->perpage()+1}} to {{$categories->currentpage()*$categories->perpage()}}
                                        of  {{$categories->total()}} entries
                                    </div>
                                </span>
                            </div>
                          <div class="col-sm-6 text-right">
                              <ul class="pagination">
                                  {{$categories->links()}}
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
