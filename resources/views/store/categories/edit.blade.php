@extends("store/layouts.master")
@section('title','Edit Categories')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">
            Edit Categories
      </div>
    </div>
    <form action="{{ route('categories.update',$categories->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      <div class="box-body">

          <div class="form-group">
            <label>Title: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="title" value="{{$categories->title}}">
          </div>

          <div class="form-group">
            <label>Author Title: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="title_author" value="{{$categories->author}}">
          </div>

      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('attributes') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')

@endsection
