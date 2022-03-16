@extends('admin/layouts.master')
@section('title', 'Add Trusted - Admin')
@section('body')

<section class="content">
  @include('admin.message')
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border"> 
              <h3 class="box-title">{{ __('adminstaticword.Add') }} {{ __('adminstaticword.TrustedSlider') }}</h3>
            </div>
            <div class="box-body">
              <form id="demo-form2" method="post" action="{{url('trusted/')}}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="row">
                  <div class="col-md-9">
                    <label for="exampleInputTit1e">{{ __('adminstaticword.URL') }}:<sup class="redstar">*</sup></label>
                    <input class="form-control" required type="text" name="url" placeholder="Please Enter Your trusted Url">
                  </div>
                
                  <div class="col-md-3">
                    <label for="exampleInputSlug">{{ __('adminstaticword.Image') }}</label>
                    <br>
                    <input type="file" name="image" id="image" class="inputfile inputfile-1"  />
                    <label for="image"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}&hellip;</span>
                  </div>
                </div>
                <br>
                        
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                    <br>
                    <li class="tg-list-item">              
                      <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                      <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                    </li>
                    <input type="hidden"  name="free" value="0" for="status" id="status">
                  </div>
                </div>
                <br>

                <div class="box-footer">
                  <button type="submit" class="btn btn-md col-md-2 btn-primary">{{ __('adminstaticword.Submit') }}</button>
                </div>
           
              </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section> 

@endsection

