@extends("store/layouts.master")
@section('title','Add New Countries')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">

    <div class="box-header with-border">
      <div class="box-title">Add Countries</div>
    </div>
    <form action="{{ route('countries.store') }}" method="POST">
    @csrf
      <div class="box-body">

          <div class="form-group">
            <label>Name: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="name">
          </div>

          {{-- <div class="form-group">
            <label>Author Title: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="title_author">
          </div> --}}

      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('adminstaticword.Save') }}
      </button>
    </form>
      <a href="{{ route('countries') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
      </a>
    </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
{{-- <script>
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

</script> --}}

@endsection
