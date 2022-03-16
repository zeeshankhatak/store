@extends("store/layouts.master")
@section('title','Add New Item')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">Add Item</div>
    </div>
    <form action="{{ route('items.store') }}" method="POST">
    @csrf
      <div class="box-body">

        <div class="form-group">
          <label>Price : <span class="redstar">*</span></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
            <input required="" id="amount" type="text" class="form-control" name="to">
          </div>
        </div>

        {{-- <div class="form-group">
          <label>Price From: <span class="redstar">*</span></label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
            <input required="" id="amount" type="text" class="form-control" name="from">
          </div>
        </div> --}}

        <div class="form-group">
            <label>Sub Category: <span class="redstar">*</span></label>

              <select required="" name="sub_cat" id="" class="form-control">
                <option value="none" selected disabled hidden>
                  Select Sub-Category
                 </option>
                @foreach ($sub_cats as $sub_cat )
                <option value="{{$sub_cat->id}}">{{$sub_cat->title}}</option>
                @endforeach

              </select>
          </div>

          <div class="form-group">
            <label>Country: <span class="redstar">*</span></label>

              <select required="" name="city" id="" class="form-control">
                <option value="none" selected disabled hidden>
                  Select Country
                 </option>
                @foreach ($country as $con )
                <option value="{{$con->id}}">{{$con->name}}</option>
                @endforeach

              </select>
          </div>

          <div class="form-group">
            <label>Area: <span class="redstar">*</span></label>

              <select required="" name="area" id="" class="form-control">
                <option value="none" selected disabled hidden>
                    Select Area
                 </option>
                @foreach ($areas as $area )
                <option value="{{$area->id}}">{{$area->area_name}}</option>
                @endforeach

              </select>
          </div>

          <div class="form-group">
            <label>Stock: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="stock">
          </div>

          <div class="col-md-3">
            <label for="exampleInputTit1e">Status:</label>
            <li class="tg-list-item">              
              <input class="tgl tgl-skewed" id="status" type="checkbox" name="status">
              <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
          </li>
          {{-- <input type="hidden"  name="free" value="" for="status" id="status"> --}}
          </div>

      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('items.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  (function($) {
  "use strict";

      $('#link_by').on('change',function(){
        var opt = $(this).val();

        if(opt == 'course'){
          $('#minAmount').hide();
          $('#probox').show();
          $('#minAmount').hide();
          $('#pro_id').attr('required','required');
        }else{
          $('#minAmount').show();
          $('#probox').hide();
          $('#pro_id').removeAttr('required');
        }
    });

      $('#link_by').on('change',function(){
        var opt = $(this).val();

        if(opt == 'category'){
          $('#catbox').show();
          $('#pro_id').attr('required','required');
        }else{
          $('#catbox').hide();
          $('#pro_id').removeAttr('required');
        }
    });

      $( function() {
        $( "#expirydate" ).datepicker({
          dateFormat : 'yy-m-d'
        });
      });

  })(jQuery);

</script>

@endsection
