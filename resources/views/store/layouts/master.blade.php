<!DOCTYPE html>

<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku'); //make a list of rtl languages
?>

<html class="no-js" lang="en" @if (in_array($language,$rtl)) dir="rtl" @endif>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Store  | @yield('title')</title> 
  <!-- Tell the browser to be
   to screen width -->

  @php
    $meta = App\Setting::all();
  @endphp

  @foreach($meta as $met)
    <meta name="description" content="{{ $met->meta_data_des}}">
    <meta name="keywords" content="{{ $met->meta_data_key }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $met->google_ana }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ $met->google_ana }}');
    </script>
    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '{{ $met->fb_pixel }}');
      fbq('track', 'PageView');
    </script>

    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
    <noscript>
      <img style="display:none" src="https://www.facebook.com/tr?id={{ $met->fb_pixel }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
  @endforeach

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{url('admin1/bower_components/bootstrap/dist/css/bootstrap.min.css')}}"> <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('css/datepicker.css') }}">
  {{-- <link rel="icon" type="image/icon" href="{{ asset('images/favicon/'.$gsetting->favicon) }}"> <!-- favicon-icon --> --}}
  <link rel="stylesheet" href="{{ url('admin1/css/select2.min.css') }}"> <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('admin1/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ url('css/fontawesome-iconpicker.min.css') }}">
  <link rel="stylesheet" href="{{url('admin1/css/jquery-ui.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('admin1/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('admin1/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> <!-- Theme style -->
  <link rel="stylesheet" href="{{url('admin1/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <?php
  $language = Session::get('changed_language'); //or 'english' //set the system language
  $rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku'); //make a list of rtl languages
  ?>
  @if (in_array($language,$rtl))
  <link rel="stylesheet" href="{{url('admin1/dist/css/AdminLTE-rtl.min.css')}}">  <!-- adminLTE RTL  style -->
  @else
  <link rel="stylesheet" href="{{url('admin1/dist/css/AdminLTE.min.css')}}">
  @endif

  <link rel="stylesheet" href="{{url('css/toggle.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('css/component.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('css/normalize.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('admin1/plugins/pace/pace.min.css') }}">
  <link rel="stylesheet" href="{{url('admin1/dist/css/skins/_all-skins.min.css')}}">
  <link href="{{url('admin1/css/bootstrap-toggle.min.css')}}">
  <link rel="stylesheet" href="{{ url('css/animate.min.css') }}"><!-- Custom Css -->
  @if (in_array($language,$rtl))
  <link rel="stylesheet" href="{{ url('admin1/css/admin-rtl.css') }}">
  @else
  <link rel="stylesheet" href="{{ url('admin1/css/admin.css') }}">
  @endif
  <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  @yield('stylesheets')

</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
    
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          
        </div>
      </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->

      @include('store.layouts.sidebar')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      @yield('body')
      <!-- Main content end-->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        {{-- {{ $project_title }} (Version 1.9) --}}
      </div>
     {{-- {{ $cpy_txt }} --}}
    </footer>
    <!-- /.control-sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

    <!--API SCRIPTS FOR STATE CITY -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    {{-- <script src="//geodata.solutions/includes/statecity.js"></script> --}}
     <!--END -->
  <!-- jQuery 3 -->
  <script src="{{url('admin1/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ url('admin1/js/select2.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{url('admin1/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script> <!-- DataTables -->
  <script src="{{url('admin1/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('admin1/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script> <!-- SlimScroll -->
  <script src="{{url('admin1/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script> <!-- FastClick -->
  <script src="{{url('admin1/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{url('admin1/dist/js/adminlte.min.js')}}"></script> <!-- AdminLTE for demo purposes -->
  <script src="{{url('admin1/dist/js/demo.js')}}"></script>
  <script src="{{ URL::asset('admin1/bower_components/PACE/pace.min.js') }}"></script>
  <!-- PACE -->
  <script src="{{ URL::asset('admin1/bower_components/ckeditor/ckeditor.js') }}"></script>
  <!-- CK Editor -->
  <script src="{{ URL::asset('admin1/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script> <!-- bootstrap datepicker -->
  <script src="{{ url('admin1/js/jquery-ui.js')}}"></script>
  <script src="{{ url('js/custom-toggle.js') }}"></script>
  <script src="{{ url('js/custom-file-input.js')}}"></script>
  <script src="{{ url('js/fontawesome-iconpicker.js')}}"></script>
  <script src="{{ url('admin1/js/courseclass.js')}}"></script>
  <script src="{{ url('admin1/js/tinymce.min.js')}}"></script>
  <script src="{{ url('admin1/bower_components/moment/moment.js') }}"></script>
   <script src="{{ url('js/datepicker.js') }}"></script>
  <script src="{{ url('js/custom-js.js')}}"></script>

  <!-- page script -->
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>

  <script>
  (function($) {
    "use strict";
    tinymce.init({
      mode : "specific_textareas",
      editor_selector : "myTextEditor",
      plugins: 'table,textcolor,image,lists,link,code,wordcount,advlist, autosave',
      theme: 'modern',
      menubar: 'none',
      height : '300',
      toolbar: 'restoredraft,bold italic underline | fontselect |  fontsizeselect | forecolor backcolor |alignleft aligncenter alignright alignjustify| bullist,numlist | link image'
    });

    })();
  </script>

  <script>
    window.setTimeout(function(){
      $(".alert").fadeTo(300,0).slideUp(500, function(){
        $(this).remove();
      });
    },2000);
  </script>

  <script>
    $(function(){
      $('.icp-auto').iconpicker();
    });
  </script>

  <script>

    $(function () {
      $('.action-destroy').on('click', function () {
        $.iconpicker.batch('.icp.iconpicker-element', 'destroy');
      });
      $(document).on('click', '.action-placement', function (e) {
        $('.action-placement').removeClass('active');
        $(this).addClass('active');
        $('.icp-opts').data('iconpicker').updatePlacement($(this).text());
        e.preventDefault();
        return false;
      });
      $('.action-create').on('click', function () {
        $('.icp-auto').iconpicker();

        $('.icp-dd').iconpicker({

        });
        $('.icp-opts').iconpicker({
          title: 'With custom options',
          icons: [
            {
              title: "fab fa-github",
              searchTerms: ['repository', 'code']
            },
            {
              title: "fas fa-heart",
              searchTerms: ['love']
            },
            {
              title: "fab fa-html5",
              searchTerms: ['web']
            },
            {
              title: "fab fa-css3",
              searchTerms: ['style']
            }
          ],
          selectedCustomClass: 'label label-success',
          mustAccept: true,
          placement: 'bottomRight',
          showFooter: true,
          // note that this is ignored cause we have an accept button:
          hideOnSelect: true,
          // fontAwesome5: true,
          templates: {
            footer: '<div class="popover-footer">' +
            '<div style="text-align:left; font-size:12px;">Placements: \n\
            <a href="#" class=" action-placement">inline</a>\n\
            <a href="#" class=" action-placement">topLeftCorner</a>\n\
            <a href="#" class=" action-placement">topLeft</a>\n\
            <a href="#" class=" action-placement">top</a>\n\
            <a href="#" class=" action-placement">topRight</a>\n\
            <a href="#" class=" action-placement">topRightCorner</a>\n\
            <a href="#" class=" action-placement">rightTop</a>\n\
            <a href="#" class=" action-placement">right</a>\n\
            <a href="#" class=" action-placement">rightBottom</a>\n\
            <a href="#" class=" action-placement">bottomRightCorner</a>\n\
            <a href="#" class=" active action-placement">bottomRight</a>\n\
            <a href="#" class=" action-placement">bottom</a>\n\
            <a href="#" class=" action-placement">bottomLeft</a>\n\
            <a href="#" class=" action-placement">bottomLeftCorner</a>\n\
            <a href="#" class=" action-placement">leftBottom</a>\n\
            <a href="#" class=" action-placement">left</a>\n\
            <a href="#" class=" action-placement">leftTop</a>\n\
            </div><hr></div>'
          }
        }).data('iconpicker').show();
      }).trigger('click');


      $('.icp').on('iconpickerSelected', function (e) {
        $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
          e.iconpickerInstance.options.iconBaseClass + ' ' +
          e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
      });
    });

  </script>

  <script>
    $('#datepicker').datepicker({
      autoclose: true,
      changeYear: true,
    })
  </script>

  <script>
    $(function(){
      $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('activeTab', $(e.target).attr('href'));
      });
      var activeTab = localStorage.getItem('activeTab');
      if(activeTab){
          $('#nav-tab a[href="' + activeTab + '"]').tab('show');
      }
    });
  </script>

  <script>
    $(function() {
        $('form').attr('autocomplete','off');
    });
  </script>

  <script>
    $(function() {
      $('.js-example-basic-single').select2();
    });
  </script>

  {{-- @if($gsetting->rightclick=='0')
    <script>
      (function($) {
        "use strict";
          $(function() {
            $(document).on("contextmenu",function(e) {
               return false;
            });
        });
      })(jQuery);
    </script>
  @endif
  @if($gsetting->inspect=='1')
    <script>
      (function($) {
      "use strict";
        //    document.onkeydown = function(e) {
        //   if(event.keyCode == 123) {
        //      return false;
        //   }
        //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        //      return false;
        //   }
        //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
        //      return false;
        //   }
        //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        //      return false;
        //   }
        //   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        //      return false;
        //   }
        // }
      })(jQuery);
    </script>
  @endif --}}

@yield('scripts')
@yield('script')

</body>
</html>
