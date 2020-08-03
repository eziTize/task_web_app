<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="IMS - Institute management system.Provide you everything in a one package.">
    <meta name="keywords" content="Ims,Institute management system,ielts management system,imigration management system">
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="{{ Asset('images/favicon/mstile-144x144.png') }}">

    <title>Login</title>
    
    <link rel="icon" href="{{ Asset('images/favicon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="{{ Asset('images/favicon/apple-touch-icon-152x152.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ Asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/materialize.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/style.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/layouts/page-center.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('css/custom/custom.min.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('js/plugins/prism/prism.css') }}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{ Asset('js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" media="screen,projection">
  </head>

  <body class="cyan">
    <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>

    @if(Session::has('error'))
    <div id="card-alert" class="card red">
      <div class="card-content white-text">
        <p><i class="mdi-alert-error"></i> {{ Session::get('error') }}</p>
      </div>
      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    @endif

    @if(Session::has('message'))
    <div id="card-alert" class="card light-blue">
      <div class="card-content white-text">
        <p><i class="fa fa-check"></i> {{ Session::get('message') }}</p>
      </div>
      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    @endif

    <div id="login-page" class="row">
      <div class="col s12 z-depth-4 card-panel">
        <form class="login-form" action="{{ Asset(env('admin').'/login') }}" method="post" autocomplete="off">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="input-field col s12 center">
              <img src="{{ Asset('images/login-logo.png') }}" alt="" class="responsive-img valign">
              <p class="center login-form-text"><b>Admin Panel Login</b></p>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="mdi-social-person-outline prefix"></i>
              <input id="email" class="tolowercase" type="email" name="email" required autofocus>
              <label for="email" class="center-align">Email</label>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="mdi-action-lock-outline prefix"></i>
              <input id="password" type="password" name="password" required>
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">          
            <div class="input-field col s12 m12 l12 login-text">
              <input type="checkbox" id="remember-me" />
              <label for="remember-me">Remember me</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="submit" class="btn waves-effect waves-light col s12" value="Login">
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <p class="margin medium-small"><a href="{{ Asset(env('teacher').'/login') }}">Login in Team Member Panel</a></p>
            </div>

            <div class="input-field col s12 m12 l12">
              <p class="margin medium-small"><a href="{{ Asset(env('student').'/login') }}">Login in Student Panel</a></p>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript" src="{{ Asset('js/plugins/jquery-1.11.2.min.js') }}"></script>   
    <script type="text/javascript" src="{{ Asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ Asset('js/custom-script.js') }}"></script>
  </body>
</html>