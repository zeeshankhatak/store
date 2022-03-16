@extends('gamer.layouts.master')
@section('title', 'Dashboard - Gamer')
@section('body')


<section class="content-header">
  <h1>
    {{ __('adminstaticword.Dashboard') }}
    {{-- <small>{{ $project_title }}</small> --}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('adminstaticword.Home') }}</a></li>
    <li class="active">{{ __('adminstaticword.Dashboard') }}</li>
  </ol>
</section>
<section class="content">
	<!-- Main row -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              	@php
              		$user = App\User::all();
              		if(count($user)>0){

              			echo count($user);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Users') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            {{-- <a href="{{route('user.index')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a> --}}
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              	@php
              		$cat = App\Categories::all();
              		if(count($cat)>0){

              			echo count($cat);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Categories') }}</p>
            </div>
            <div class="icon">
            	<i class="fa fa-th-large"></i>
            </div>
            <a href="{{url('category')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
              	@php
              		$course = App\Course::all();
              		if(count($course)>0){

              			echo count($course);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Courses') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('course')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              	@php
              		$page = App\Order::all();
              		if(count($page)>0){

              			echo count($page);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Orders') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('order')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>
              	@php
              		$faq = App\FaqStudent::all();
              		if(count($faq)>0){

              			echo count($faq);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Faqs') }}</p>
            </div>
            <div class="icon">
              <i class="fa fa-question"></i>
            </div>
            <a href="{{url('faq')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>@php
              		$review = App\Page::all();
              		if(count($review)>0){

              			echo count($review);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Pages') }}</p>
            </div>
            <div class="icon">
             <i class="fa fa-folder"></i>
            </div>
            <a href="{{ url('page') }}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                @php
              		$review = App\Instructor::all();
              		if(count($review)>0){

              			echo count($review);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Instructors') }}</p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="{{ url('requestinstructor') }}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
                @php
              		$review = App\Testimonial::all();
              		if(count($review)>0){

              			echo count($review);
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>{{ __('adminstaticword.Testimonials') }}</p>
            </div>
            <div class="icon">
             <i class="fa fa-folder"></i>
            </div>
            <a href="{{url('testimonial')}}" class="small-box-footer">{{ __('adminstaticword.Moreinfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

@endsection
