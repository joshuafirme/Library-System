@extends('layouts.utilities-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">User Maintenance</h3>
                <hr>
            </div>
      
              @if(count($errors)>0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
          
                      <li>{{$error}}</li>
                          
                      @endforeach
                  </ul>
              </div>
              @endif
          
              @if(\Session::has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> </h5>
                {{ \Session::get('success') }}
              </div>      
              @endif

              @if(\Session::has('danger'))
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> </h5>
                {{ \Session::get('danger') }}
              </div>      
              @endif
      
              <div class="row">
      
                <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUserModal" id="btn-user-book"><span class='fa fa-plus'></span> Add user</button> 
                  </div>
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                  <div class="card-body">  
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item">
                          <a class="nav-link  active" id="reorder-tab" data-toggle="tab" href="#reordertab" role="tab" aria-controls="contact" aria-selected="true">Student
      
                          </a>
                         </li>
                          <li class="nav-item">
                              <a class="nav-link" id="expiry-tab" data-toggle="tab" href="#expirytab" role="tab" aria-controls="home" aria-selected="false">Teacher
           
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" id="expired-tab" data-toggle="tab" href="#expiredtab" role="tab" aria-controls="profile" aria-selected="false">Admin</a>
                          </li>
                         
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  active show mt-5" id="reordertab" role="tabpanel" aria-labelledby="reorder-tab">
 
                            <table class="table table-data responsive  table-hover" id="student-table" style="width: 100%">                               
                                <thead>
                                  <tr>
                                      <th>User ID</th>
                                      <th>Name</th> 
                                      <th>Grade</th> 
                                      <th>Contact Number</th> 
                                      <th>Address</th> 
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              
                              </table>
                            
                          </div>
                          <div class="tab-pane fade mt-5" id="expiredtab" role="tabpanel" aria-labelledby="expired-tab">
                            <table class="table table-data responsive  table-hover" id="user-table" style="width: 100%">                               
                                <thead>
                                  <tr>
                                      <th>User name</th>
                                      <th>Name</th> 
                                      <th>Contact Number</th> 
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              
                              </table> 
                          </div>
                 
                          <div class="tab-pane fade mt-5" id="expirytab" role="tabpanel" aria-labelledby="expiry-tab">
                         
                            <table class="table table-data responsive  table-hover" id="teacher-table" style="width: 100%">                               
                                <thead>
                                  <tr>
                                    <th>User ID</th>
                                    <th>Name</th> 
                                    <th>Department</th> 
                                    <th>Contact Number</th> 
                                    <th>Address</th> 
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              
                              </table>
                        
                          </div>
                      </div>
                         
    
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>

@include('layouts.modals.user-modal')

@endsection

