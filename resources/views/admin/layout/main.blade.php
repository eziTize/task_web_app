<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Institute management system, online Learning Center Management System, Cheapest Management Software,Coaching center management software,ielts center">
    <meta name="keywords" content="Institute Management System,Software,Coaching Center,Learning Center,Cheapest,ielts,imigration">
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="{{ Asset('images/favicon/mstile-144x144.png') }}">
    
    <title>@yield('title')</title>
    
    <link rel="icon" href="{{ Asset('images/favicon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="{{ Asset('images/favicon/apple-touch-icon-152x152.png') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/materialize.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/style.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/custom/custom.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('js/plugins/prism/prism.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('js/plugins/chartist-js/chartist.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('js/plugins/sweetalert/sweetalert.css') }}" media="screen,projection">

    @yield('css')
    
  </head>

  <body>
    <style>
      input.header-search-input::placeholder {
        color: #000000 !important;
      }
    </style>

    <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>

    {!! View('admin.layout.header') !!}

    <div id="main">
      <div class="wrapper">

        {!! View('admin.layout.menu') !!}

        <section id="content">
        
          <!--breadcrumbs start-->
          <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
              <i class="mdi-action-search active"></i>
              <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
            <div class="container">
              <div class="row">
                <div class="col s12 m6 l6">
                  <h5 class="breadcrumbs-title">@yield('title')</h5>
                  <ol class="breadcrumbs">
                    <li><a href="{{ Asset(env('admin').'/dashboard') }}">Dashboard</a></li>
                    <li class="active">@yield('title')</li>
                  </ol>
                </div>

                <div class="col s12 m6 l6">
                  @yield('button')
                </div>
              </div>
            </div>
          </div>
          <!--breadcrumbs end-->
          <div class="row">
            <div class="col s12 m12 l12">
              @if(count($errors) > 0)
              <br>
              <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p style="color:red"><i class="mdi-alert-error"></i> {{ $error }}</p>
                @endforeach
              </div>
              @endif

              @if(Session::has('error'))
              <div id="card-alert" class="card red">
                <div class="card-content white-text">
                  <p><i class="mdi-alert-error"></i> ERROR : {{ Session::get('error') }}</p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endif

              @if(Session::has('message'))
              <div id="card-alert" class="card green">
                <div class="card-content white-text">
                  <p><i class="fa fa-check"></i> SUCCESS : {{ Session::get('message') }}</p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endif
            </div>
          </div>
     
          @yield('content')
       
        </section>

        {!! View('admin.layout.right') !!}

      </div>
    </div>

    <script type="text/javascript" src="{{ Asset('js/plugins/jquery-1.11.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/plugins/chartist-js/chartist.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/custom-script.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    @yield('js')

    <script>
      $(document).ready(function(){
        $('.tooltipped').tooltip({delay: 50});
      });

      function confirmAlert(type,_this){
	      if(type == "restore"){
          before_msg = "Your data will be restored";
          btn_txt = "Yes, restore it!";
          after_hmsg = "Restored!";
          after_msg = "Your data has been restored!";
        }else if(type == "destroy_permant"){
          before_msg = "You will not be able to recover this data!";
          btn_txt = "Yes, delete it!";
          after_hmsg = "Deleted!";
          after_msg = "Your data has been deleted!";
        }else if(type == "destroy"){
          before_msg = "Your data will be deleted!";
          btn_txt = "Yes, delete it!";
          after_hmsg = "Deleted!";
          after_msg = "Your data has been deleted!";
        }else{
          before_msg = "Your data will be changed!";
          btn_txt = "Yes, change it!";
          after_hmsg = "Changed!";
          after_msg = "Your data has been changed!";
        }
        
        del_form = $(_this).parents('form').attr('id');
        
        swal({
        	title: "Are you sure?",
        	text: before_msg,
        	type: "warning",
        	showCancelButton: true,
        	confirmButtonColor: '#DD6B55',
        	confirmButtonText: btn_txt,
        	closeOnConfirm: false
        }, function(){
        	swal(after_hmsg, after_msg, "success");
				  if(del_form){
					  $('#'+del_form).submit();
          }
        });
      }

      $(document).ready(function(){
        $(".bulk_xlsx").change(function(){
          if(this.files[0]){
            if(this.files[0].size>(10*1024*1024)){
              swal("Error","Maximum size allowed is 10 MB");
              $(this).val("");
            }else if(this.files[0].type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
              swal("Error","Only .xlsx file is allowed");
              $(this).val("");
            }
          }
        });
      });
    </script>
  </body>
</html>