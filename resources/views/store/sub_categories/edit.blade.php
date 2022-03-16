@extends("store/layouts.master")
@section('title','Edit Categories')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">
            Edit Sub-Categories
      </div>
    </div>
    <form action="{{ route('sub_categories.update',$sub_category->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      <div class="box-body">

          <div class="form-group">
            <label>Select Category: <span class="redstar">*</span></label>
            
              <select required="" name="category">
                <option value="none" selected disabled hidden> 
                  {{ __('adminstaticword.SelectanOption') }}
                </option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" {{ $category->id == $sub_category->mct_id ? 'selected' : '' }}>{{$category->title}}</option>
                @endforeach
              </select>
            
          </div>

          <div class="form-group">
            <label>Title: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="title" value="{{$sub_category->title}}">
          </div>

          <div class="form-group">
            <label>Author Title: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="title_author" value="{{$sub_category->author}}">
          </div>

          <div class="form-group">
            <label>Image: <span class="redstar">*</span></label>
            <input required="" value="{{$sub_category->image}}" type="file" class="form-control" name="image">
          </div>

      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('sub_categories') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')

@endsection
