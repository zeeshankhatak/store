@extends('store/layouts.master')
@section('title', 'All Order - Admin')
@section('body')

<section class="content">
  @include('store.message')
  
  <!-- Order Details Modal -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="Order_Details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" id="d_close">&times;</span>
            </button>
        <div class="modal-body">
            <label>Order Details</label>
            <input type="hidden" class="order_id form-control">
          <table id="details" class="table table-bodered table-striped">
            <thead>
                <tr>
                    <th>Coach</th>
                    <th>Assign Date | Time</th>
                    <th>Coach Status</th>
                    <th>Tip a Coach</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        </div>
      
      </div>
    </div>
  </div>
  <!-- End Order Details Modal -->


   <!-- Coach Profile Modal -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="modal fade" id="Coach_Profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-sm">
         <div class="modal-content">
              <button type="button" class="cp_close close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
         
           <div class="modal-body">
              <div class="coach-image">
                <img class="coach_img img-circle" alt="User Image">
              </div>
               <input type="hidden" class="coach_id form-control">
               <div class="coach-detail">
                   <Label>Gamer Tag</Label><p class="c_name"></p>
                   <Label>Email</Label><p class="c_email"></p>
                   <Label>K/D Ratio</Label><p class="k_d_ratio"></p>
                   <Label>Total Wins</Label><p class="win_rate"></p>
                   <Label>Language</Label><p class="lang"></p>
               </div>
           </div>
         </div>
       </div>
     </div>
     <!-- Coach Profile Modal -->
     
      <!-- Tip a Coach Modal -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <div class="modal fade" id="Tip_a_coach" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          
            <button type="button" class="btn-close close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          
          <div class="modal-body">
            <h5 class="modal-title" id="exampleModalLabel">Tip a Coach</h5>

            <input type="hidden" class="coach_id form-control">
            <Label class="gamer_tag"></Label>
            <div class="form group-mb3">
                <label for="">Amount</label>
                <input type="number" class="amount form-control" required>
            </div>

            <div class="form group-mb3">
                <label for="">Discription</label>
                <textarea class="discription form-control" required></textarea>
                {{-- <input type="text" class="discription form-control"> --}}
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn_submit btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Tip a Coach Modal End -->
    
     
  <div class="row">
      <div id="message-box"></div>
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Order') }}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>

                <br>
                <br>
                <tr>

                  <th>{{ __('adminstaticword.Order #') }}</th>
                  <th>{{ __('adminstaticword.Game') }}</th>
                  <th>{{ __('adminstaticword.No.of Coaches') }}</th>
                  <th>{{ __('adminstaticword.PackageAmount') }}</th>
                  <th>{{ __('adminstaticword.Payment Status') }}</th>
                  <th>{{ __('adminstaticword.Order Status') }}</th>
                  <th>{{ __('adminstaticword.Action') }}</th>

                </tr>
              </thead>
              <tbody>
              </tbody>
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

       $(document).on('click','.details',function(e){
            e.preventDefault();
            var order_num = $(this).val();
            // console.log(order_num);
            $("#Order_Details").modal('show');
            $(".order_id").val(order_num);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'GET',
                url:'gamer/gamerdatafetch/'+order_num,
                dataType:'json',
                success:function(response){
                    // console.log(response);

                    $("#details tbody").html("");
                    $.each(response.data,function(key,value){
                        var orderStatus='';
                        if(value.coach_status==1){
                            coachStatusClass='badge badge-success';
                            coachStatus = "Accepted";
                            }
                            else{
                                coachStatusClass='badge badge-danger';
                                coachStatus = "Pending";
                            }

                        if(value.assign_date == null){
                            assignDate = "-";
                            }
                            else{
                                assignDate = value.assign_date;
                            }
                        $('#details tbody').append(
                            '<tr>\
                                <td><button value="'+value.coach_id+'" class="coach_profile  btn btn-link">'+value.gamer_tag+'</button></td>\
                                <td>'+assignDate+'</td>\
                                <td><span value="'+value.coach_status+'" class=" '+ coachStatusClass +' ">'+coachStatus+'</span></td>\
                                <td><button value="'+value.coach_id+'" data-tag="'+value.gamer_tag+'" class="btn btn-primary tip-coach">Tip a Coach</button></td>\
                            </tr>'
                        );
                    });

                }
            });

        });
        
        // ----------- 2nd Modal (Coach Profile) --------------
        $(document).on('click','.coach_profile',function(e){
            e.preventDefault();
            var coachId = $(this).val();
            // console.log(coachId);
            $("#Coach_Profile").modal('show');
            $(".coach_id").val(coachId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'GET',
                url:'gamer/coachd_details_fetch/'+coachId,
                dataType:'json',
                success:function(response){
                    // console.log(response);
                    // $(".c_name").html(response.data.fname+" "+response.data.lname);
                    $(".c_name").html(response.data.gamer_tag);
                    $(".c_email").html(response.data.email);
                    $(".k_d_ratio").html(response.data.k_d_ratio);
                    $(".win_rate").html(response.data.win_rate);
                    $(".pp").html(response.data.win_rate);
                    $(".lang").html(response.data.language);
                    
                    if(response.data.user_img == null){
                        
                        var source = "{{ asset('/images/default/user.jpg') }}";
                        $('.coach_img').attr('src', source);
                    
                    }
                    else
                    {
                        var image = response.data.user_img ;
                        var source = "{{ asset('/images/coach') }}"+"/"+image;
                        $('.coach_img').attr('src', source);   
                    }

                }
            });

        });
        
          // ----------- Tip a Coach Modal --------------
         $(document).on('click','.tip-coach',function(e){
            e.preventDefault();
            var coachId = $(this).val();
            var coachtag = $(this).attr("data-tag");

            $("#Tip_a_coach").modal('show');
            $(".coach_id").val(coachId);
            $(".gamer_tag").html(coachtag);

        });

        $(document).on('click','.btn_submit',function(e){
            e.preventDefault();
            var data = {
                'coach_id':$('.coach_id').val(),
                'amount':$('.amount').val(),
                'description':$('.discription').val(),
            }
            console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:"POST",
                url:"gamer/tip_a_coach",
                data:data,
                dataType:"json",
                success:function(response){
                    console.log(response);
                    if(response.status == 200){
                        $("#Tip_a_coach").modal('hide');
                        $("#Order_Details").modal('hide');
                        $("#message-box").html("");
                        $("#message-box").removeClass('alert alert-danger');
                        $("#message-box").addClass('alert alert-success');
                        $("#message-box").html(response.message);
                        $("#message-box").fadeIn("slow");
                        setTimeout(function(){
                            $("#message-box").fadeOut("slow")
                        },3000);
                        $("#Tip_a_coach").find("input").val("");
                        $("#Tip_a_coach").find("textarea").val("");
                    }
                    else{
                        $("#Tip_a_coach").modal('hide');
                        $("#Order_Details").modal('hide');
                        $("#message-box").html("");
                        $("#message-box").removeClass('alert alert-success');
                        $("#message-box").addClass('alert alert-danger');
                        $("#message-box").html(response.message);
                        $("#message-box").fadeIn("slow");
                        setTimeout(function(){
                            $("#message-box").fadeOut("slow")
                        },3000);
                        $("#Tip_a_coach").find("input").val("");
                        $("#Tip_a_coach").find("textarea").val("");
                    }

                }
            });

        });
        
         $(".cp_close").click(function(){
            $("#Coach_Profile").modal('hide');
        });
        
         $("#d_close").click(function(){
            $("#Order_Details").modal('hide');
        });

    });
</script>
@endsection
