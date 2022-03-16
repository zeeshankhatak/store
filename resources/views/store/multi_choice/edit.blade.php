@extends("admin/layouts.master")
@section('title','Add New Coupon')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">
            {{ __('adminstaticword.Send') }} {{ __('adminstaticword.Payouts') }}
      </div>
    </div>
    <form action="{{ route('payout.update',$payouts->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      <div class="box-body">


        <div class="form-group">
            <label>{{ __('adminstaticword.Coach') }}: <span class="redstar">*</span></label>

              <select required="" name="coach_id" id="" class="form-control">
                <option value="none" selected disabled hidden>
                    {{ __('adminstaticword.SelectCoach') }}
                 </option>
                @foreach ($coaches as $coach )
                <option value="{{$coach->coach_id}}" {{ $payouts->coach_id == $coach->coach_id ? 'selected' : '' }}>{{$coach->gamer_tag}}</option>
                @endforeach


              </select>

          </div>

          <div class="form-group">
            <label>{{ __('adminstaticword.Order ID') }}: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="order_id" value="{{$payouts->order_id}}">
          </div>

          <div class="form-group">
            <label>{{ __('adminstaticword.Transaction ID / Receipt ID') }}: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="trans_id" value="{{$payouts->trans_id}}">
          </div>

          <div class="form-group">
            <label>{{ __('adminstaticword.Amount') }}: <span class="redstar">*</span></label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input required="" id="amount" type="text" class="form-control" name="amount" value="{{$payouts->amount}}">
            </div>
          </div>

          <!--<div class="form-group">-->
          <!--  <label>{{ __('adminstaticword.Status') }}: <span class="redstar">*</span></label>-->

          <!--    <select required="" name="status" id="" class="form-control">-->
          <!--      <option value="none" selected disabled hidden>-->
          <!--         {{ __('adminstaticword.SelectanOption') }}-->
          <!--      </option>-->
          <!--      <option value="paid" {{ $payouts->status == 'paid' ? 'selected' : '' }}>{{ __('adminstaticword.Paid') }}</option>-->
          <!--      <option value="unpaid" {{ $payouts->status == 'unpaid' ? 'selected' : '' }}>{{ __('adminstaticword.Unpaid') }}</option>-->
          <!--      <option value="onhold" {{ $payouts->status == 'onhold' ? 'selected' : '' }}>{{ __('adminstaticword.On-Hold') }}</option>-->
          <!--    </select>-->

          <!--</div>-->
      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('all.payouts') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
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
