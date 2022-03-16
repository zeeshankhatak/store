@extends("store/layouts.master")
@section('title','Add New Attribute')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">Add Attributes</div>
    </div>
    <form action="{{ route('attributes.store') }}" method="POST">
    @csrf
      <div class="box-body">


        <div class="form-group">
            <label>{{ __('adminstaticword.Coach') }}: <span class="redstar">*</span></label>

              <select required="" name="coach_id" id="" class="form-control">
                <option value="none" selected disabled hidden>
                    {{ __('adminstaticword.SelectCoach') }}
                 </option>
                {{-- @foreach ($coaches as $coach )
                <option value="{{$coach->coach_id}}">{{$coach->gamer_tag}}</option>
                @endforeach --}}


              </select>

          </div>

          <div class="form-group">
            <label>{{ __('adminstaticword.Order ID') }}: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="order_id">
          </div>

          <div class="form-group">
            <label>{{ __('adminstaticword.Transaction ID / Receipt ID') }}: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="trans_id">
          </div>

          <div class="form-group">
            <label>{{ __('adminstaticword.Amount') }}: <span class="redstar">*</span></label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input required="" id="amount" type="text" class="form-control" name="amount">
            </div>
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
