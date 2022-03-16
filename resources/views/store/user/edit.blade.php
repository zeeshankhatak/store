@extends('gamer.layouts.master')
@section('title', 'Edit User - Admin')
@section('body')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
 
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ __('adminstaticword.Edit') }} {{ __('adminstaticword.Users') }}</h3>

          
        </div>
        <br>
        <div class="panel-body">
          <form action="{{ route('gamer.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="fname">
                  {{ __('adminstaticword.FirstName') }}:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->fname }}" autofocus required name="fname" type="text" class="form-control" placeholder="Enter first name"/>
              </div>

              <div class="col-md-6">
                <label for="lname">
                  {{ __('adminstaticword.LastName') }}:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->lname }}" required name="lname" type="text" class="form-control" placeholder="Enter last name"/>
              </div>
            </div>
            <br>

            <div class="row">

              <!--<div class="col-md-6">-->
              <!--  <label for="mobile"> {{ __('adminstaticword.Mobile') }}:</label>-->
              <!--  <input value="{{ $user->mobile }}" type="text" name="mobile" placeholder="Enter mobile no" class="form-control">-->
              <!-- </div>-->
               <div class="col-md-6">
                <label for="mobile">{{ __('adminstaticword.Email') }}:<sup class="redstar">*</sup> </label>
                <input value="{{ $user->email }}" required type="email" name="email" placeholder="Enter email" class="form-control">
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                  <label for="address">{{ __('adminstaticword.Address') }}: </label>
                  <textarea name="address" class="form-control" rows="1" placeholder="Enter adderss" value="">{{ $user->address }}</textarea>
              </div>

              <div class="col-md-6">
                <label for="dob">{{ __('adminstaticword.DateofBirth') }}: </label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {{-- <input type="date" value="{{ $user->dob }}" name="dob" required class="form-control pull-right" id="datepicker" placeholder="Enter your date of birth"> --}}
                  <input type="date" id="date" name="dob" class="form-control" placeholder="" value="{{ $user->dob }}" >
                </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6 text-white">
               <label for="gender">{{ __('adminstaticword.Gender') }}:</label>
                <br>
                <input type="radio" name="gender" id="ch1" value="m" style="margin-left: 0;" {{ $user->gender == 'm' ? 'checked' : '' }}> {{ __('adminstaticword.Male') }}
                <input type="radio" name="gender" id="ch2" value="f" {{ $user->gender == 'f' ? 'checked' : '' }}> {{ __('adminstaticword.Female') }}
                <input type="radio" name="gender" id="ch3" value="o" {{ $user->gender == 'o' ? 'checked' : '' }}> {{ __('adminstaticword.Other') }}
              </div>
{{-- 
              <div class="col-md-6">
               
                  @if(Auth::User()->role=="admin")
                  <label for="role">{{ __('adminstaticword.SelectRole') }}:</label>
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('adminstaticword.User') }}</option>
                    <option {{ $user->role == 'admin' ? 'selected' : ''}} value="admin">{{ __('adminstaticword.Admin') }}</option>
                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">{{ __('adminstaticword.Instructor') }}</option>
                  </select>
                  @endif
                  @if(Auth::User()->role=="instructor")
                  <label for="role">{{ __('adminstaticword.SelectRole') }}:</label>
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('adminstaticword.User') }}</option>
                    <option {{ $user->role == 'instructor' ? 'selected' : ''}} value="instructor">{{ __('adminstaticword.Instructor') }}</option>
                  </select>
                  @endif
                  {{-- @if(Auth::User()->role=="user")
                  <select class="form-control js-example-basic-single" name="role">
                    <option {{ $user->role == 'user' ? 'selected' : ''}} value="user">{{ __('adminstaticword.User') }}</option>
                  </select>
                  @endif 
             </div> --}}
            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.Country') }}:</label>
                <select id="country_id" class="form-control" name="country_id">
                  <option value="none" selected disabled hidden>
                      {{ __('adminstaticword.SelectanOption') }}
                    </option>

                  {{-- @foreach ($countries as $coun)
                    <option value="{{ $coun->country_id }}" {{ $user->country_id == $coun->country_id ? 'selected' : ''}}>{{ $coun->nicename }}
                    </option>
                  @endforeach --}}
                  <option value="USA" {{ $user->country_id != ""  ? 'selected' : ''}}>USA</option>
                </select>
              </div>

               <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.State') }}:</label>
                {{-- <select id="upload_id" class="form-control js-example-basic-single" name="state_id">
                  <option value="none" selected disabled hidden>
                    {{ __('adminstaticword.SelectanOption') }}
                  </option>
                  @foreach ($states as $s)
                    <option value="{{ $s->state_id}}" {{ $user->state_id==$s->state_id ? 'selected' : '' }}>{{ $s->name}}</option>
                  @endforeach
                </select> --}}
                <input type="hidden" name="country" id="countryId" value="US"/>
                <select name="state_id" class="states order-alpha form-control" id="stateId">

                    <option value="" >Select State</option>

                </select>
              </div>

               <div class="col-md-3">
                <label for="city_id">{{ __('adminstaticword.City') }}:</label>
                {{-- <select id="grand" class="form-control js-example-basic-single" name="city_id">
                  <option value="none" selected disabled hidden>
                     {{ __('adminstaticword.SelectanOption') }}
                  </option>
                  @foreach ($cities as $c)
                    <option value="{{ $c->id }}" {{ $user->city_id == $c->id ? 'selected' : ''}}>{{ $c->name }}
                    </option>
                  @endforeach
                </select> --}}
                <select name="city_id" class="cities order-alpha form-control" id="cityId">
                    <option value="">Select City</option>
                </select>
              </div>
          
              {{-- <div class="col-md-3">
                <label for="pin_code">{{ __('adminstaticword.Pincode') }}:</label>
                <input value="{{ $user->pin_code }}" placeholder="Enter Pincode" type="text" name="pin_code" class="form-control">
              </div> --}}
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label>{{ __('adminstaticword.Image') }}:<sup class="redstar">*</sup></label>
                <input type="file" name="user_img" class="form-control">
              </div>
              <div class="col-md-6">
                @if($user->user_img != null || $user->user_img !='')
                  <div class="edit-user-img">
                    <img src="{{ asset('images/gamer/'.$user->user_img) }}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
                @else
                  <div class="edit-user-img">
                    <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image" class="img-responsive">
                  </div>
                @endif
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-md-12">
                <div class="update-password">
                  <label for="box1"> {{ __('adminstaticword.UpdatePassword') }}:</label>
                  <input type="checkbox" id="myCheck" name="update_pass" onclick="myFunction()">
                </div>
              </div>
            </div>

            <div class="row display-none" id="update-password">
              <div class="col-md-6">
                <label>{{ __('adminstaticword.Password') }}</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password">
              </div>
              <div class="col-md-6">
                <label>{{ __('adminstaticword.ConfirmPassword') }}</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm password">
              </div>
            </div>
            <br>


            {{-- <div class="row">
              <div class="col-md-12">
                <label for="detail">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                <textarea id="detail" name="detail" class="form-control" rows="5" placeholder="Enter your details" value="">{{ $user->detail }}</textarea>
              </div>
            </div>
            <br> --}}

            <div class="box-header with-border">
              <h3 class="box-title">{{ __('adminstaticword.SocialProfile') }}</h3>
            </div>
            <br>

            <div class="row">
              <div class="col-md-6">
                <label for="facebook_url">
                {{ __('adminstaticword.FacebookUrl') }}:
                </label>
                <input autofocus name="facebook_url" value="{{ $user->facebook_url }}" type="text" class="form-control" placeholder="Facebook.com/"/>
              </div>
              <div class="col-md-6">
                <label for="youtube_url">
                {{ __('adminstaticword.YoutubeUrl') }}:
                </label>
                <input autofocus name="youtube_url" value="{{ $user->youtube_url }}" type="text" class="form-control" placeholder="youtube.com/"/>
                <br>
              </div>
            
              <div class="col-md-6">
                <label for="twitter_url">
                {{ __('adminstaticword.TwitterUrl') }}:
                </label>
                <input autofocus name="twitter_url" value="{{ $user->twitter_url }}" type="text" class="form-control" placeholder="Twitter.com/"/>
              </div>
              <div class="col-md-6">
                <label for="linkedin_url">
                {{ __('adminstaticword.LinkedInUrl') }}:
                </label>
                <input autofocus name="linkedin_url" value="{{ $user->linkedin_url }}" type="text" class="form-control" placeholder="Linkedin.com/"/>
              </div>
            </div>
            <br>
            <br>
            

            <div class="box-footer">
              <button type="submit" class="btn btn-md btn-primary">
                <i class="fa fa-save"></i> {{ __('adminstaticword.Save') }}
              </button>
            </form>
              {{-- <a href="{{ route('user.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
                <i class="fa fa-reply"></i> {{ __('adminstaticword.Back') }}
              </a> --}}
            </div>
            <br>

          </form>
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection

@section('scripts')

<script>
(function($) {
  "use strict";

  $( function() {
    $( "#dob,#doa" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });
  

  $('#married_status').change(function() {
      
    if($(this).val() == 'Married')
    {
      $('#doaboxxx').show();
    }
    else
    {
      $('#doaboxxx').hide();
    }
  });

  tinymce.init({selector:'textarea#detail'});

//   $(function() {
//     var urlLike = '{{ url('country/dropdown') }}';
//     $('#country_id').change(function() {
//       var up = $('#upload_id').empty();
//       var cat_id = $(this).val();    
//       if(cat_id){
//         $.ajax({
//           headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//           type:"GET",
//           url: urlLike,
//           data: {catId: cat_id},
//           success:function(data){   
//             console.log(data);
//             up.append('<option value="0">Please Choose</option>');
//             $.each(data, function(id, title) {
//               up.append($('<option>', {value:id, text:title}));
//             });
//           },
//           error: function(XMLHttpRequest, textStatus, errorThrown) {
//             console.log(XMLHttpRequest);
//           }
//         });
//       }
//     });
//   });

//   $(function() {
//     var urlLike = '{{ url('country/gcity') }}';
//     $('#upload_id').change(function() {
//       var up = $('#grand').empty();
//       var cat_id = $(this).val();    
//       if(cat_id){
//         $.ajax({
//           headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//           type:"GET",
//           url: urlLike,
//           data: {catId: cat_id},
//           success:function(data){   
//             console.log(data);
//             up.append('<option value="0">Please Choose</option>');
//             $.each(data, function(id, title) {
//               up.append($('<option>', {value:id, text:title}));
//             });
//           },
//           error: function(XMLHttpRequest, textStatus, errorThrown) {
//             console.log(XMLHttpRequest);
//           }
//         });
//       }
//     });
//   });

})(jQuery);
</script>

<script>
  function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("update-password");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
  
   

    // ajax for state and city

function ajaxCall() {
    this.send = function(data, url, method, success, type) {
        type = type||'json';
        var successRes = function(data) {
            success(data);
        }

        var errorRes = function(e) {
            console.log(e);
        }
        jQuery.ajax({
            url: url,
            type: method,
            data: data,
            success: successRes,
            error: errorRes,
            dataType: type,
            timeout: 60000
        });

    }

}

function locationInfo() {
    var rootUrl = "//geodata.solutions/api/api.php";
    //set default values
    var username = 'demo';
    var ordering = 'name';
    //now check for set values
    var addParams = '';
    if(jQuery("#gds_appid").length > 0) {
        addParams += '&appid=' + jQuery("#gds_appid").val();
    }
    if(jQuery("#gds_hash").length > 0) {
        addParams += '&hash=' + jQuery("#gds_hash").val();
    }

    var call = new ajaxCall();

    this.confCity = function(id) {
        var url = rootUrl+'?type=confCity&countryId='+ jQuery('#countryId').val() + '&stateId=' + jQuery('#stateId option:selected').attr('stateid') + '&cityId=' + id;
        var method = "post";
        var data = {};
        call.send(data, url, method, function(data) {
            if(data){
                //    alert(data);
            }
            else{
                //   alert('No data');
            }
        });
    };

    this.getCities = function(id) {
        jQuery(".cities option:gt(0)").remove();
        //get additional fields
        var stateClasses = jQuery('#cityId').attr('class');
        //console.log(stateClasses);
        var cC = stateClasses.split(" ");
        cC.shift();
        var addClasses = '';
        if(cC.length > 0)
        {
            acC = cC.join();
            addClasses = '&addClasses=' + encodeURIComponent(acC);
        }
        var url = rootUrl+'?type=getCities&countryId='+ jQuery('#countryId').val() +'&stateId=' + id + addParams + addClasses;
        var method = "post";
        var data = {};
        jQuery('.cities').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            jQuery('.cities').find("option:eq(0)").html("Select City");
            if(data.tp == 1){
                if(data.hits > 1000)
                {
                    //alert('Free usage far exceeded. Please subscribe at geodata.solutions.');
                    console.log('Daily geodata.solutions request limit exceeded:' + data.hits + ' of 1000');
                }
                else
                {
                    console.log('Daily geodata.solutions request count:' + data.hits + ' of 1000')
                }

                var listlen = Object.keys(data['result']).length;
                //console.log('number is cities is ' + listlen);
                if(listlen > 0)
                {
                    jQuery.each(data['result'], function(key, val) {

                        var option = jQuery('<option />');
                        var city= "{{$user->city_id}}";
                        if(val == city){
                            option.attr('selected', "selected");
                        }else{
                            option.removeAttr('selected');
                        }
                        option.attr('value', val).text(val);
                        jQuery('.cities').append(option);
                    });
                }
                else
                {
                    var usestate = jQuery('#stateId option:selected').val();
                    var option = jQuery('<option />');
                    option.attr('value', usestate).text(usestate);
                    option.attr('selected', 'selected');
                    jQuery('.cities').append(option);
                }

                jQuery(".cities").prop("disabled",false);
            }
            else{
                alert(data.msg);
            }
        });
    };

    this.getStates = function(id) {
        jQuery(".states option:gt(0)").remove();
        jQuery(".cities option:gt(0)").remove();
        //get additional fields
        var stateClasses = jQuery('#stateId').attr('class');
        console.log(stateClasses);
        var cC = stateClasses.split(" ");
        cC.shift();
        var addClasses = '';
        if(cC.length > 0)
        {
            acC = cC.join();
            addClasses = '&addClasses=' + encodeURIComponent(acC);
        }
        var url = rootUrl+'?type=getStates&countryId=' + id + addParams  + addClasses;
        var method = "post";
        var data = {};
        jQuery('.states').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function(data) {
            jQuery('.states').find("option:eq(0)").html("Select State");
            if(data.tp == 1){
                if(data.hits > 1000)
                {
                    //alert('Free usage far exceeded. Please subscribe at geodata.solutions.');
                    console.log('Daily geodata.solutions request limit exceeded: ' + data.hits + ' of 1000.');
                }
                else
                {
                    console.log('Daily geodata.solutions request count:' + data.hits + ' of 1000')
                }
                jQuery.each(data['result'], function(key, val) {
                    var option = jQuery('<option />');
                    var state= "{{$user->state_id}}";
                    if(val == state){
                        option.attr('selected', "selected");
                    }else{
                        option.removeAttr('selected');
                    }


                    option.attr('value', val).text(val);
                    option.attr('stateid', key);
                    jQuery('.states').append(option);
                });
                jQuery(".states").prop("disabled",false);
            }
            else{
                alert(data.msg);
            }
        });
    };
}

jQuery(function() {
    var loc = new locationInfo();
    var coid = jQuery("#countryId").val();
    loc.getStates(coid);
    jQuery(".states").on("change", function(ev) {
        console.log("hi");
        var stateId = jQuery("option:selected", this).attr('stateid');
        if(stateId != ''){
            loc.getCities(stateId);
        }
        else{
            jQuery(".cities option:gt(0)").remove();
        }
    });
    jQuery(".cities").on("change", function(ev) {
        var cityId = jQuery("option:selected", this).val();
        if(cityId != ''){
            loc.confCity(cityId);
        }
    });
});

// jQuery(document).ready(function () {

    // jQuery(document).load(function () {
    //     jQuery(".states").trigger("change");
    // });

    $(window).on('load', function() {
 // code here

setTimeout(() => {
    jQuery(".states").trigger("change");
}, 1000);


});
</script>

@endsection

