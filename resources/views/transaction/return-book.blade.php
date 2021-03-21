@extends('layouts.transaction-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Return Book</h3>
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
                          <table class="table table-data responsive  table-hover" id="return-table">                               
                            <thead>
                              <tr>
                                  <th>User ID</th>
                                  <th>Borrower</th>
                                  <th>Contact Number</th>
                                  <th>Accession Number</th>
                                  <th>Title</th>
                                  <th>Due date</th>
                                  <th>Status</th>
                                  <th>Is Overdue</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          
                          </table>
      
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>

@include('layouts.modals.return-modal')

@endsection

