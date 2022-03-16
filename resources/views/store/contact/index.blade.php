@extends('admin/layouts.master')
@section('title', 'All Message - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.AllMessage') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              
              <thead>
                <br>
                <br>
                <tr>
                  <th>{{ __('adminstaticword.Name') }}</th>
                  <th>{{ __('adminstaticword.Phone') }}</th>
                  <th>{{ __('adminstaticword.Email') }}</th>
                  <th>{{ __('adminstaticword.Message') }}</th>
                  <th>{{ __('adminstaticword.View') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                  <td>{{$item->fname}}</td>
                  <td>{{$item->mobile}}</td>
                  <td>{{$item->email}}</td>
                  <td>{{ str_limit($item->message, $limit = 50, $end = '...') }}</td>
                  <td><a class="btn btn-primary btn-sm" href="{{route('usermessage.edit',$item->id)}}">{{ __('adminstaticword.View') }}</a></td>

                  <td>
                    <form  method="post" action="{{url('usermessage/'.$item->id)}}
                        "data-parsley-validate class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                         <button  type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                    </form>
                  </td>

                  @endforeach
               
                </tr>
              </tfoot>
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

@endsection