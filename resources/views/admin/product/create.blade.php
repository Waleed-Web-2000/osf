@extends('admin.layout.master')
@section('page_title')
  Create Book
@endsection
@section('main_content')
  <section class="content">
      <!-- form start -->
      <form name="formCreate" id="formCreate" method="POST" action="{{Route('product.store')}}" enctype="multipart/form-data">
      @csrf
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
                 <div class="form-group @error ('name') has-error @enderror">
                    <label for="name">Name<span class="text text-red">*</span></label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    @error('name')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
 
                    <div class="form-group @error ('slug') has-error @enderror">
                    <label for="slug">Slug <span class="text text-red">*</span></label>
                      <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">
                      @error('slug')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label>Category <span class="text text-red">*</span></label>
                      <select class="form-control" name="category_id" id="category_id" style="width: 100%;">
                        <option value="none">-- Select Category --</option>
                        @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group @error ('stock') has-error @enderror">
                      <label for="stock">Stock <span class="text text-red">*</span></label>
                      <input type="text" class="form-control" name="stock" id="stock" placeholder="Stock">
                      @error('stock')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group @error ('price') has-error @enderror">
                  <label for="price">Price: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                  @error('price')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('sale_price') has-error @enderror">
                  <label for="sale_price">Sale-Price: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="sale_price" id="sale_price" placeholder="Sale-Price">
                  @error('sale_price')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('SKU') has-error @enderror">
                  <label for="SKU">SKU: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="SKU" id="SKU" placeholder="SKU">
                  @error('SKU')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('quantity') has-error @enderror">
                  <label for="quantity">Quantity: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="quantity" id="quantity" placeholder="quantity">
                  @error('quantity')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                  <div class="form-group @error ('options') has-error @enderror">
                  <label for="options">Options: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="options" id="options" placeholder="Options">
                  @error('options')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('tags') has-error @enderror">
                  <label for="tags">Tags: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" name="tags" id="tags" placeholder="Tags">
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
                                    <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
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
                        <option value="yes">Recomended</option>
                        <option value="no">Not Recomended</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Condition</label>
                      <select class="form-control" name="condition" id="condition" style="width: 100%;">
                        <option value="none">-- Select Condition --</option>
                        <option value="hot">hot</option>
                        <option value="trending">trending</option>
                        <option value="sale">sale</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="description">Description <span class="text text-red">*</span></label>
                      <textarea class="form-control" name="description" rows="10" cols="80" id="description" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="short_description">Short Description <span class="text text-red">*</span></label>
                      <textarea class="form-control" name="short_description" rows="5" id="quote" placeholder="Short Description"></textarea>
                    </div>

                   

                </div>
            </div>

              <!-- row end -->

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{Route('product.all')}}" class="btn btn-danger">Cancel</a>
          </div>
      </div>
      </form>
      <!-- /.box -->

      <!-- form end -->

    </section>
@endsection

@push("scripts")

    <script>
            $(function(){
                $("#myFile").on("change",function(e){
                    const photoInp = $("#myFile");                    
                    const [file] = this.files;
                    if (file) {
                        $("#imgpreview img").attr('src',URL.createObjectURL(file));
                        $("#imgpreview").show();                        
                    }
                });


                $("#gFile").on("change",function(e){
                    $(".gitems").remove();
                    const gFile = $("gFile");
                    const gphotos = this.files;                    
                    $.each(gphotos,function(key,val){                        
                        $("#galUpload").prepend(`<div class="item gitems"><img src="${URL.createObjectURL(val)}" alt=""></div>`);                        
                    });                    
                });


                $("input[name='name']").on("change",function(){
                    $("input[name='slug']").val(StringToSlug($(this).val()));
                });
                
            });
            function StringToSlug(Text) {
                return Text.toLowerCase()
                .replace(/[^\w ]+/g, "")
                .replace(/ +/g, "-");
            }     
    </script>
    
@endpush

