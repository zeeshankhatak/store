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
    <form action="{{ route('payout.store') }}" method="POST">
    @csrf
      <div class="box-body">


        <div class="form-group">
            <label>{{ __('adminstaticword.Coach') }}: <span class="redstar">*</span></label>

              <select required="" name="coach_id" id="" class="form-control">
                <option value="none" selected disabled hidden>
                    {{ __('adminstaticword.SelectCoach') }}
                 </option>
                @foreach ($coaches as $coach )
                <option value="{{$coach->coach_id}}">{{$coach->gamer_tag}}</option>
                @endforeach


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

          <!--<div class="form-group">-->
          <!--  <label>{{ __('adminstaticword.Status') }}: <span class="redstar">*</span></label>-->

          <!--    <select required="" name="status" id="" class="form-control">-->
          <!--      <option value="none" selected disabled hidden>-->
          <!--         {{ __('adminstaticword.SelectanOption') }}-->
          <!--      </option>-->
          <!--      <option value="paid">{{ __('adminstaticword.Paid') }}</option>-->
          <!--      <option value="unpaid">{{ __('adminstaticword.Unpaid') }}</option>-->
          <!--      <option value="onhold">{{ __('adminstaticword.On-Hold') }}</option>-->
          <!--    </select>-->

          <!--</div>-->


          {{-- <div id="probox" class="form-group display-none">
            <label>{{ __('adminstaticword.SelectCourse') }}: <span class="redstar">*</span> </label>
            <br>
            <select style="width: 100%" id="pro_id" name="course_id" class="js-example-basic-single form-control">
                <option value="none" selected disabled hidden>
                   {{ __('adminstaticword.SelectanOption') }}
                </option>
                @foreach(App\Course::where('status','1')->get() as $product)
                  @if($product->type == 1)
                    <option value="{{ $product->id }}">{{ $product['title'] }}</option>
                  @endif
                @endforeach
            </select>
          </div> --}}


          {{-- <div id="catbox" class="form-group display-none">
            <label>{{ __('adminstaticword.SelectCategories') }}: <span class="required">*</span> </label>
            <br>
            <select style="width: 100%" id="cat_id" name="category_id" class="js-example-basic-single form-control">
                <option value="none" selected disabled hidden>
                   {{ __('adminstaticword.SelectanOption') }}
                </option>
                @foreach(App\Categories::where('status','1')->get() as $category)
                  <option value="{{ $category->id }}">{{ $category['title'] }}</option>
                @endforeach
            </select>
          </div> --}}

          {{-- <div class="form-group">
            <label>{{ __('adminstaticword.MaxUsageLimit') }}: <span class="redstar">*</span></label>
            <input required="" type="number" min="1" class="form-control" name="maxusage">
          </div> --}}

          {{-- <div id="minAmount" class="form-group">
            <label>{{ __('adminstaticword.MinAmount') }}: </label>
            <div class="input-group">
              @php
                $currency = App\Currency::first();
              @endphp
              <span class="input-group-addon"><i class="{{ $currency->icon }}"></i></span>
              <input type="number" min="0.0" value="0.00" step="0.1" class="form-control" name="minamount">
            </div>
          </div> --}}

           {{-- <div class="form-group">
            <label>{{ __('adminstaticword.ExpiryDate') }}: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input required="" id="expirydate" type="text" class="form-control" name="expirydate">
            </div>
          </div> --}}
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
