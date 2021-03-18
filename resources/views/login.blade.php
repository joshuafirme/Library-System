
<!doctype html>
<!-- 
* Bootstrap Simple Admin Template
* Version: 1.2
* Author: Alexis Luna
* Copyright 2020 Alexis Luna
* Website: https://github.com/alexis-luna/bootstrap-simple-admin-template
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRAPS</title>

    <link href="{{ asset('vendor/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    
</head>
<style>
body {
    background-image: url("/img/bg_school.jpg");
     /* Full height */
    height: 100%;
    background-attachment: fixed;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  </style>
<body>

    <div class="container" style="margin-top: 10%;">
        <div class="row">

            <div class="col-8">
                <div class="card mb-4" style="height: 150px; width:300px;">
                    <div class="card-body text-center">
                        <h6 class="mb-4 text-muted">Mission</h6>
                        <p class="text-muted">
                            SRAPS develops competent and upright individuals in the service of catholic church.
                        </p>
                    </div>
                </div> 
                <div class="card mb-5" style="height: 150px; width:300px;">
                    <div class="card-body text-center">
                        <h6 class="mb-4 text-muted">Vission</h6>
                        <p class="text-muted">
                            SRAPS is a Christ-centered learning community that evangelizes the whole person to become leaders of the society.
                        </p>
                    </div>
                </div>  
            </div>
    
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <img style="width: 100px;" src="{{asset('img/logo.png')}}" alt="bootstraper logo">
                        </div>
                        <h6 class="mb-4 text-muted">Sign in to your account</h6>
                       
                        <form action="{{action('LoginCtr@login')}}" method="POST">
                            @csrf
                            @if(\Session::has('invalid'))
                            <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fa fa-check-circle"></i> </h5>
                            {{ \Session::get('invalid') }}
                            </div>      
                            @endif
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="user_id" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <button style="width: 100%" type="submit" class="btn btn-primary shadow-2 mb-4">Login</button>
                        </form>
                        <p class="mb-2 text-muted">Go to <a href="#">OPAC</a></p>
                    </div>
                </div>  
            </div>
                 
        </div>
    </div>

</body>
</html>