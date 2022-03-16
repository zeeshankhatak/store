@extends("store/layouts.master")
@section('title','All Coupons')

@section('body')
<section class="content">
  @include('store.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Store</h3>
        </div>
        <div class="box-header">
          <a href="{{ route('add.attributes') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> ADD</a>
          <br>
        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
              <thead>

                <th>ID</th>
                <th>TITLE</th>
                <th>AUTHOR</th>
                <th>EDIT</th>
                <th>DELETE</th>
              </thead>

              <tbody>
                {{-- @foreach($payouts as $payout)
                  <tr>
                        <td>{{$payout->id}}</td>
                        <td>{{$payout->gamer_tag}}</td>
                        <td>{{$payout->order_id}}</td>
                        <td>{{$payout->trans_id}}</td>
                        <td>${{$payout->amount}}</td>
                        <td>
                                <span  class=" {{ $payout->status == 1 ? 'badge badge-success' : 'badge badge-danger' }}">
                                @if($payout->status == 1)
                                    {{ __('adminstaticword.Paid') }}
                                @else
                                    {{ __('adminstaticword.Unpaid') }}
                                @endif
                                </span>
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm"
                                href="{{ route('edit.payout', $payout->id) }}">
                                <i class="glyphicon glyphicon-pencil"></i></a>
                        </td>
                  </tr>
                @endforeach --}}
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        $('#example').DataTable( {
        "order": [ 0, "desc" ]
    } );

    });
</script>
@endsection
