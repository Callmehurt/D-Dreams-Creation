<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>D Dreams Creation Pvt. Ltd</title>
    <meta content="D Dreams Creation Pvt. Ltd" name="Photography and Videography at Biratchowk" />
    <meta content="Sandeep Shrestha" name="author" />
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">

</head>

<body>


<div class="accountbg"></div>
<div class="home-btn d-none d-sm-block">
    <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a>
</div>
<div class="wrapper-page">
    <div class="card card-pages shadow-none">

        <div class="card-body">
            <div class="text-center m-t-0 m-b-15">
                <a href="#" class="logo logo-admin"><img src="{{asset('images/logo-dark.png')}}" alt="" height="24"></a>
            </div>
            <h5 class="font-18 text-center">Sign in to continue to Stexo.</h5>

            <form class="form-horizontal m-t-30" action="{{route('login.user')}}" method="post">
                @csrf
                <div class="form-group">
                    <div class="col-12">
                        <label>Email</label>
                        <input class="form-control" parsley-type="email" type="email" required="" placeholder="Email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-12">
                        <label>Password</label>
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-12">
                        <div class="checkbox checkbox-primary">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1"> Remember me</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        @include('.message/flash')
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

                <div class="form-group row m-t-30 m-b-0">
                    <div class="col-sm-7">
                        <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="pages-register.html" class="text-muted">Create an account</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- END wrapper -->

{{--<!-- Begin page -->--}}
{{--<div id="wrapper">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-4">--}}
{{--                <div class="form-wrapper" style="margin-top: 5rem">--}}
{{--                    <h4>Login Form</h4>--}}
{{--                    <form action="{{route('login.user')}}" method="post">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Email</label>--}}
{{--                            <input type="email" class="form-control" name="email">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Password</label>--}}
{{--                            <input type="password" class="form-control" name="password">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <button class="btn btn-success">Login</button>--}}
{{--                        </div>--}}
{{--                        @if (Session::has('error'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <i class="fa fa-times" aria-hidden="true"></i>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
{{--                                {{ Session::get('error') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- container-fluid -->
</div>
<!-- END wrapper -->

<!-- jQuery  -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/metismenu.min.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/waves.min.js')}}"></script>

<!--Morris Chart-->
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>

<script src="{{asset('pages/dashboard.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('js/app.js')}}"></script>

</body>

</html>