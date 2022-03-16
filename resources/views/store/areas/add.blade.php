@extends("store/layouts.master")
@section('title','Add New Area')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">Add Area</div>
    </div>
    <form action="{{ route('areas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="box-body">

          <div class="form-group">
            <label>Select Country: <span class="redstar">*</span></label>
            
              <select required="" name="country">
                <option value="none" selected disabled hidden> 
                  {{ __('adminstaticword.SelectanOption') }}
                </option>
                @foreach($country as $countryy)
                <option value="{{$countryy->id}}">{{$countryy->name}}</option>
                @endforeach
              </select>
            
          </div>

          <div class="form-group">
            <label>Area Name: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="name">
          </div>

          {{-- <div class="form-group">
            <label>Author Title: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="title_author">
          </div>

          <div class="form-group">
            <label>Image: <span class="redstar">*</span></label>
            <input required="" type="file" class="form-control" name="image">
          </div> --}}

      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('areas') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection

