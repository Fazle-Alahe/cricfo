
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>StartUI - Register</title>

	<link href="{{asset('admin/assets')}}/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="{{asset('admin/assets')}}/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="{{asset('admin/assets')}}/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="{{asset('admin/assets')}}/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="{{asset('admin/assets')}}/img/favicon.png" rel="icon" type="image/png">
	<link href="{{asset('admin/assets')}}/img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<link rel="stylesheet" href="{{asset('admin/assets')}}/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('admin/assets')}}/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" action="{{route('register.store')}}" method="POST">
                    @csrf
                    <div class="sign-avatar no-photo">&plus;</div>
                    <header class="sign-title">Sign Up</header>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Full Name"/>
                        @error('name')
                            <strong class="text-danger">Enter your name.</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-Mail"/>
                        @error('email')
                            <strong class="text-danger">Enter your email.</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Repeat password"/>
                        @if (session('wrong'))
                            <strong class="text-danger">{{session('wrong')}}</strong>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-rounded btn-success sign-up">Sign up</button>
                    <p class="sign-note">Already have an account? <a href="sign-in.html">Sign in</a></p>
                    <!--<button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
                </form>
            </div>
        </div>
    </div><!--.page-center-->

<script src="{{asset('admin/assets')}}/js/lib/jquery/jquery-3.2.1.min.js"></script>
<script src="{{asset('admin/assets')}}/js/lib/popper/popper.min.js"></script>
<script src="{{asset('admin/assets')}}/js/lib/tether/tether.min.js"></script>
<script src="{{asset('admin/assets')}}/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="{{asset('admin/assets')}}/js/plugins.js"></script>
    <script type="text/javascript" src="{{asset('admin/assets')}}/js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="{{asset('admin/assets')}}/js/app.js"></script>
</body>
</html>