<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Needs
================================================== -->
        <meta charset="utf-8" />
        <meta name="description" content="UI/UX guy">
        <meta name="author" content="Colin Toh">
        <title>Minsp</title>
        <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->



        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


        <!-- CSS
        ================================================== -->
        {{ HTML::style('css/style.css'); }}        
        {{ HTML::style('js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css'); }}        
        <link href='http://fonts.googleapis.com/css?family=Philosopher:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

        <!-- Scripts
          ================================================== -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>        
        {{ HTML::script('js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js'); }}
        <script src="http://connect.soundcloud.com/sdk.js"></script> 
        <script>
$(document).ready(function() {
    $('#other_genre').hide();
    $('.new_genre').click(function() {
        $('#other_genre').show();
    });
    $('.genre').click(function() {
        $('#other_genre').hide();
    });

    $('#hashtag').hide();
    $('#OMC').click(function() {
        $('#hashtag').toggle();
    });
    
    $( "#datepicker" ).datepicker();
});
        </script>        
        {{ HTML::script('js/kendo.all.min.js'); }}        
    </head>
    <body>
        <div id="header">
            <div class="header">
                <div class="logo left"><a href="#">{{HTML::image('img/logo.png');}}</a></div>
                <ul class="nav left">
                    <li class="selected"><a href="{{ URL::route('home') }}" class="home"><span class="link">Home</span></a></li>
                    <li><a href="" class="music"><span class="link">Music</span></a></li>
                    <li><a href="" class="media"><span class="link">Media</span></a></li>
                    <li><a href="" class="social"><span class="link">Social</span></a></li>
                </ul>
                <div class="login right">
                    @if(Auth::check())
                    <ul class="nav login">
                        <li><a href="{{ URL::route('sign-out-account') }}" class="login"><span class="link">Logout</span></a></li>
                    </ul>
                    <p><a href="{{ URL::route('change-password-account') }}">Change password</a></p>
                    @else
                    <ul class="nav login">
                        <li><a href="{{ URL::route('sing-in-account') }}" class="login"><span class="link">Login</span></a></li>
                    </ul>
                    <p><a href="{{ URL::route('create-account') }}">Create an account</a></p>
                    <p><h6><a href="{{ URL::route('forgot-password') }}">Forgot password</a></h6></p>
                    @endif 
                </div>
                <div class="clear"></div>
            </div>

        </div><!-- /header -->
        @if(Session::has('global'))
        <p>{{ Session::get('global') }}</p>
        @endif

        @include('layout.navigation')
        @yield('content')
    </body>
</html>