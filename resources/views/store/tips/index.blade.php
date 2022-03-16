@extends('gamer/layouts.master')
@section('title', 'All Order - Admin')
@section('body')

<section class="content">
  @include('gamer.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Tips') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>

                <br>
                <br>

                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Coach') }}</th>
                  <th>{{ __('adminstaticword.Description') }}</th>
                  <th>{{ __('adminstaticword.Amount') }}</th>
                  <th>{{ __('adminstaticword.Date') }}</th>
                </tr>

              </thead>
              <tbody>
              <?php $i=0;?>
              @foreach($tips as $tip)

                <?php $i++;?>

                <tr>
                  <td><?php echo $i;?></td>
                  <td>{{$tip->gamer_tag}}</td>
                  <td>{{ $tip->description}}</td>
                  <td>${{$tip->amount}}</td>
                  <td>{{$tip->date}}</td>
                </tr>

              @endforeach
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $('#example1').dataTable( {
        "ordering": false
        } );

    });
</script>
@endsection
