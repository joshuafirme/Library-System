@extends('layouts.reports-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Visitor's Log</h3>
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
          
              @include('layouts.alert-validation')
      
              <div class="row">
                <div class="col-md-12 col-lg-12">
        
                <div class="card">
                  <div class="card-body">  

                    <div class="row mb-2">
           
    
                       </div>
                          <table class="table table-data responsive  table-hover" id="visitors-log-admin-table">                               
                            <thead>
                              <tr>
                                  <th>User ID</th>
                                  <th>Name</th>
                                  <th>Grade</th>
                                  <th>Date time</th>
                                  <th>Remarks</th>
                              </tr>
                          </thead>
                          
                          </table>
      
                        </div>
                      </div>
      
                  </div>
              </div>
      
</div>


@endsection

