@extends('admin.layout.master')
@section('page_title')
  Setting
@endsection

@section('main_content')

<section class="content">

      <!-- SELECT2 EXAMPLE -->
      <!-- form start -->
      <form name="formEdit" id="formEdit" method="POST" action="{{route('settings.update', $data->id)}}" enctype="multipart/form-data">
      @csrf 
        @method('put')
        {{-- {{dd($data)}} --}}
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
                  <div class="form-group">
                      <label for="logo">Website Logo</label>
                      <input type="file" class="form-control" name="logo" id="logo" >
                      <img src="/uploads/setting/logo/{{$data->logo}}" width="200" height="200" class="img-thumbnail" alt="logo">
                      <small class="label label-warning">Logo will be uploaded</small>
                    </div>
                   <div class="form-group">
                      <label for="photo">User Image</label>
                      <input type="file" class="form-control" name="photo" id="photo" >
                      <img src="/uploads/setting/photo/{{$data->photo}}" width="200" height="200" class="img-thumbnail" alt="photo">
                      <small class="label label-warning">Photo will be uploaded</small>
                    </div>
                  <div class="form-group @error ('email') has-error @enderror">
                  <label for="email">Email: <span class="text text-red">*</span></label> 
                  <input type="email" class="form-control" value="{{$data->email}}" name="email" id="email" placeholder="Sale-Price">
                  @error('email')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('address') has-error @enderror">
                  <label for="address">Address: <span class="text text-red">*</span></label> 
                  <input type="text" class="form-control" value="{{$data->address}}" name="address" id="address" placeholder="address">
                  @error('address')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>

                 <div class="form-group @error ('phone') has-error @enderror">
                  <label for="phone">Phone: <span class="text text-red">*</span></label> 
                  <input type="number" class="form-control" value="{{$data->phone}}" name="phone" id="phone" placeholder="phone">
                  @error('phone')
                        <div class="label label-danger">{{ $message }}</div>
                      @enderror
                 </div>
                                   
                <div class="col-xs-6">              
                    <div class="form-group">
                      <label for="description">Description <span class="text text-red">*</span></label>
                      <textarea class="form-control" name="description" rows="5" id="description" placeholder="Description">{{$data->description}}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="short_description">Short Description <span class="text text-red">*</span></label>
                      <textarea class="form-control" name="short_des" rows="5" id="short_description" placeholder="Short Description">{{$data->short_des}}</textarea>
                    </div>
                </div>
            </div>
              <!-- row end -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
      </div>
      </form>
      <!-- /.box -->

      <!-- form end -->

    </section>
@endsection
