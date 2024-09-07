@extends('admin.layout.master')
@section('page_title')
  Edit Category
@endsection
@section('main_content')
  <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <!-- form start -->
      <form name="formEdit" id="formEdit" method="POST" action="{{Route('category.update', $category->id)}}" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row"> 
                @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
                <div class="col-xs-6">
                  
                  <div class="form-group @error ('title') has-error @enderror">
                    <label for="title">Title <span class="text text-red">*</span></label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{$category->title}}">
                      @error('title')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="col-xs-6">
                    <div class="form-group">
                      <label for="category_img">Category Image</label>
                      <input type="file" class="form-control" name="category_img" id="category_img" >
                      <small class="label label-warning">Cover Photo will be uploaded</small>
                    </div>

                    <div class="form-group @error ('slug') has-error @enderror">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{$category->slug}}">
                      @error('slug')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter ...">{{$category->description}}</textarea>
                  </div>
                </div>
            </div>
              <!-- row end -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{Route('category.all')}}" class="btn btn-danger">Cancel</a>
          </div>
      </div>
      </form>
      <!-- /.box -->

      <!-- form end -->

    </section>
@endsection

