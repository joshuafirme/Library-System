@extends('layouts.utilities-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Audit trail</h3>
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

                <div class="col-sm-2 mb-3">
                    <input data-column="9" type="date" class="form-control" id="date_from" value="{{ date('Y-m-d') }}">
                    </div>
  
                    <div class="mt-2">
                      -
                      </div>
        
                    <div class="col-sm-2 mb-3">
                      <input data-column="9" type="date" class="form-control" id="date_to" value="{{ date('Y-m-d') }}">
                      </div>
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                    <div class="card-body">  
                        
                        <table class="table table-data responsive  table-hover" id="audit-table" style="width: 100%">                               
                            <thead>
                              <tr>
                                <th>User ID</th>
                                <th>Name</th> 
                                <th>Role</th> 
                                <th>Module</th> 
                                <th>Action</th>
                                <th>Date time</th>
                              </tr>
                          </thead>
                          
                          </table>
        
                    </div>
                </div>
                      
                     
                  </div>
              </div>
      
</div>

@endsection

