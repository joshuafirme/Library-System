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

                  <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUserModal" id="btn-user-book"><span class='fa fa-plus'></span> Add user</a> 
                  <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#importModal"><span class='fa fa-file-excel'></span> Import</a> 
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exportModal"><span class='fa fa-file-export'></span> Export</button> 
  
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
                            <a class="nav-link" id="librarian-tab" data-toggle="tab" href="#librariantab" role="tab" aria-controls="home" aria-selected="false">Librarian
         
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
                            <table class="table table-data responsive  table-hover" id="usser-table" style="width: 100%">                               
                                <thead>
                                  <tr>
                                      <th>User name</th>
                                      <th>Name</th> 
                                      <th>Contact Number</th> 
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($admin as $data)                                
                                <tr>
                                  <td>{{ $data->user_id }}</td>
                                  <td>{{ $data->name }}</td>
                                  <td>{{ $data->contact_no }}</td>
                                  <td>
                                    <a class="btn btn-sm btn-primary" id="btn-edit-user" user-id="{{ $data->id }}" user-type="{{ $data->user_type }}" 
                                      data-toggle="modal" data-target="#editUserModal"><i class="fa fa-edit"></i></a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                              </table> 
                          </div>
                 
                          <div class="tab-pane fade mt-5" id="librariantab" role="tabpanel" aria-labelledby="librarian-tab">
                         
                            <table class="table table-data responsive  table-hover" id="librarian-table" style="width: 100%">                               
                                <thead>
                                  <tr>
                                    <th>User ID</th>
                                    <th>Name</th> 
                                    <th>Contact Number</th> 
                                    <th>Address</th> 
                                    <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($librarian as $data)                                
                                <tr>
                                  <td>{{ $data->user_id }}</td>
                                  <td>{{ $data->name }}</td>
                                  <td>{{ $data->contact_no }}</td>
                                  <td>{{ $data->address }}</td>
                                  <td>
                                    <a class="btn btn-sm btn-primary" id="btn-edit-user" user-id="{{ $data->id }}" user-type="{{ $data->user_type }}" 
                                      data-toggle="modal" data-target="#editUserModal"><i class="fa fa-edit"></i></a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                              
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

  <!--ImportModal-->
  <div class="modal fade" id="importModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Import User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
          <div class="modal-body">
            
            <form action="{{ action('Utilities\UserCtr@import') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <label for="">User type</label>
              <select class="form-control mb-4" name="user_type">
                <option value="2">Student</option>
                <option value="1">Teacher</option>
              </select>
                <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
              </div>
  
              <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-success">Import</button>
                <button class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </form>
      </div>
    </div>
  </div>


   <!--Expor Modal-->
   <div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Export User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
          <div class="modal-body">
            
            <form action="{{ action('Utilities\UserCtr@export') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <label for="">User type</label>
              <select class="form-control mb-4" name="user_type">
                <option value="2">Student</option>
                <option value="1">Teacher</option>
              </select>
              </div>
  
              <div class="modal-footer">
                <form action="{{ action('Utilities\UserCtr@export') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <button type="submit" class="btn btn-sm btn-success">Export</button>
                </form>
                <button class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </form>
      </div>
    </div>
  </div>
@include('layouts.modals.user-modal')

@endsection

