@extends('admin.layout.master')
@section('page_title')
  Edit Book
@endsection
@section('main_content')
  <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <!-- form start -->
      <form name="formEdit" id="formEdit" method="POST" action="{{Route('product.update', $book->id)}}" enctype="multipart/form-data">
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
                  
                 <div class="form-group @error ('Name') has-error @enderror">
                    <label for="Name">Name <span class="text text-red">*</span></label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{$book->name}}">
                      @error('Name')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
 
                    <div class="form-group @error ('slug') has-error @enderror">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{$book->slug}}">
                      @error('slug')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Category <span class="text text-red">*</span></label>
                      <select class="form-control" name="category_id" id="category_id" style="width: 100%;">
                        <option value="none">-- Select Category --</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{ ($category->id == $book->category_id) ? 'selected' : null}} > {{$category->title}} </option>
                        @endforeach
                      </select>
                    </div>


                    <div class="form-group @error ('stock') has-error @enderror">
                      <label for="stock">Stock <span class="text text-red">*</span></label>
                      <input type="text" class="form-control" name="stock" id="stock" placeholder="Stock" value="{{$book->stock}}">
                      @error('stock')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group @error ('price') has-error @enderror">
                  <label for="price">Price: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="{{$book->price}}">
                    @error('price')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                  <div class="form-group @error ('sale_price') has-error @enderror">
                  <label for="sale_price">Sale-Price: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" value="{{$book->sale_price}}" name="sale_price" id="sale_price" placeholder="Sale-Price">
                  @error('sale_price')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('SKU') has-error @enderror">
                  <label for="SKU">SKU: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" value="{{$book->SKU}}" name="SKU" id="SKU" placeholder="SKU">
                  @error('SKU')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('quantity') has-error @enderror">
                  <label for="quantity">Quantity: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" value="{{$book->quantity}}" name="quantity" id="quantity" placeholder="quantity">
                  @error('quantity')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                  <div class="form-group @error ('options') has-error @enderror">
                  <label for="options">Options: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" value="{{$book->options}}" name="options" id="options" placeholder="Options">
                  @error('options')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('tags') has-error @enderror">
                  <label for="tags">Tags: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" value="{{$book->tags}}" name="tags" id="tags" placeholder="Tags">
                  @error('tags')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>
                  
                  <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">                            
                                <img src="{{asset('images/upload/upload-1.png')}}" class="effect8" alt="">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                                <img src="/uploads/product/{{$book->image}}" width="150" height="100" class="img-thumbnail" alt="">
                            </div>
                        </div>
                    </fieldset> 
                    @error("image") <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                    <fieldset>
                        <div class="body-title mb-10">Upload Gallery Images</div>
                        <div class="upload-image mb-16">                            
                            <div  id ="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" value="{{$book->images}}" accept="image/*" multiple="">
                                </label>
                            </div>
                        </div>                        
                    </fieldset>
                    @error("images") <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                 
                <div class="col-xs-6">

                    <div class="form-group">
                      <label>Recomended</label>
                      <select class="form-control" name="recommended" id="recommended" style="width: 100%;">
                        <option value="none">-- Select Recomended --</option>
                        <option value="yes" {{ ($book->recommended == 'yes') ? 'selected' : 'null' }} >Recomended</option>
                        <option value="no" {{ ($book->recommended == 'no') ? 'selected' : 'null' }} >Not Recomended</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Condition</label>
                      <select class="form-control" name="condition" id="condition" style="width: 100%;">
                        <option value="none">-- Select Condition --</option>
                        <option value="hot" {{ ($book->condition == 'hot') ? 'selected' : 'null' }} >Hot</option>
                        <option value="trending" {{ ($book->condition == 'trending') ? 'selected' : 'null' }} > Trending</option>
                        <option value="sale" {{ ($book->condition == 'sale') ? 'selected' : 'null' }} > Sale</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="description">Description <span class="text text-red">*</span></label>
                      <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description">{{$book->description}}</textarea>
                    </div>

                    <div class="form-group">
                      <label for="short_description">Short Description <span class="text text-red">*</span></label>
                      <textarea class="form-control" name="short_description" rows="5" id="short_description" placeholder="Short Description">{{$book->short_description}}</textarea>
                    </div>

                </div>
            </div>

              <!-- row end -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{Route('product.all')}}" class="btn btn-danger">Cancel</a>
          </div>
      </div>
      </form>
      <!-- /.box -->

      <!-- form end -->

    </section>
@endsection
