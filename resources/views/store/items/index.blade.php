@extends("store/layouts.master")
@section('title','All Coupons')

@section('body')
<section class="content">
  @include('store.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Apply Filters</h3>
          <form action="{{ route('items.index') }}" method="GET">
            @csrf
  
          <div class="form-group box-header">
            <label>Price To :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input id="amount" type="text" class="form-control" name="to">
            </div>
          </div>
  
          <div class="form-group box-header">
            <label>Price From :</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
              <input id="amount" type="text" class="form-control" name="from">
            </div>
          </div>
  
          <div class="form-group box-header">
            <label>Stock :</label>
              <input id="amount" type="text" class="form-control" name="stock">
          </div>
  
          <div class="form-group box-header">
            <label>Country :</label>
  
              <select name="country" id="" class="form-control">
                <option value="none" selected disabled hidden>
                  Select Country
                 </option>
                @foreach ($country as $con )
                <option value="{{$con->id}}">{{$con->name}}</option>
                @endforeach
  
              </select>
          </div>
  
          <div class="form-group box-header">
            <label>Sub Category :</label>
  
              <select name="sub_cat" id="" class="form-control">
                <option value="none" selected disabled hidden>
                  Select Sub-Category
                 </option>
                @foreach ($sub_cat as $sub_ca )
                <option value="{{$sub_ca->id}}">{{$sub_ca->title}}</option>
                @endforeach
  
              </select>
          </div>

          <div class="form-group box-header">
            <label>Status :</label>
  
              <select name="status" id="" class="form-control">
                <option value="none" selected disabled hidden>
                  Select Status
                 </option>
                <option value="1">Active</option>
                <option value="0">In-Active</option>
              </select>
          </div>
  
          <div class="box-header">
          <button type="submit" class="btn btn-md btn-primary">
            <i class="fa fa-plus-circle"></i> Filter
          </button>
          </div>
          </form>
        </div>
        <div class="box-header">
          <a href="{{ route('add.items') }}" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> ADD NEW ITEM</a>
          <br>
        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
              <thead>

                <th>ID</th>
                <th>IMAGE</th>
                <th>PRICE</th>
                {{-- <th>PRICE FROM</th> --}}
                <th>SUB CATEGORY</th>
                <th>COUNTRY</th>
                <th>AREA</th>
                <th>STOCK</th>
                <th>STATUS</th>
                <th>EDIT</th>
                <th>DELETE</th>
              </thead>

              <tbody>
                @foreach($result as $item)
                  <tr>
                        <td>{{$item->item_ID}}</td>
                        <td>
                          <img src="{{ asset('images/gamer/' . $item->image) }}"class="img-responsive">
                        </td>
                        <td>$ {{$item->price}}</td>
                        {{-- <td>$ {{$item->new_Price}}</td> --}}
                        <td>{{$item->title}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->area_name}}</td>
                        <td>{{$item->stock}}</td>
                        <td>
                            <label class="badge badge-xs {{ $item->status ==1 ? 'btn-success' : 'btn-danger' }}">
                              @if($item->status ==1)
                              {{ __('adminstaticword.Active') }}
                              @else
                              {{ __('adminstaticword.InActive') }}
                              @endif
                            </label>
                        </td>

                        <td>
                          <a class="btn btn-success btn-sm"
                          href="{{ route('edit.items', $item->item_ID) }}">
                              <i class="glyphicon glyphicon-pencil"></i></a>
                      </td>

                      <td>
                        <form method="post" action="{{ route('items.delete', $item->item_ID) }}
                            " data-parsley-validate class="form-horizontal form-label-left">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}

                          <button onclick="return confirm('Are you sure you want to delete?')"
                            type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i>
                          </button>
                        </form>
                    </td>
                  </tr>
                @endforeach
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
     
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "http://localhost/Fps");
    }

</script>
@endsection
