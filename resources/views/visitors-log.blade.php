
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
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <div class="card mb-4" style="height: 500px; width:700px; ">
                    <div class="card-body text-center">
                        <h6 class="mb-4 text-muted">Visitor's Log</h6>
                        <table class="table table-data responsive  table-hover" id="visitors-log-table">                               
                            <thead>
                              <tr>
                                  <th class="text-muted">User ID</th>
                                  <th class="text-muted">Name</th>
                                  <th class="text-muted">Grade</th>
                                  <th class="text-muted">Date time</th>
                                  <th class="text-muted">In/Out</th>
                              </tr>
                          </thead>
                          
                          </table>
                    </div>
                </div> 
            </div>
    
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <img style="width: 100px;" src="{{asset('img/logo.png')}}" alt="bootstraper logo">
                        </div>
                        <h6 class="mb-4 text-muted">Student In/Out</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter User ID" id="user_id">
                            </div>
                            <button style="width: 100%" class="btn btn-primary shadow-2 mb-2 mt-2" id="btn_in">In</button>
                            <button style="width: 100%" class="btn btn-danger shadow-2 mb-4" id="btn_out">out</button>

                    </div>
                </div>  
            </div>
                 
        </div>
    </div>

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('js/visitors-log.js')}}"></script>
</body>
</html>