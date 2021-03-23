@extends('layouts.reports-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Unreturned Report</h3>
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
                <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                    <button class="btn btn-danger btn-sm"id="btn-unreturned-print"><span class='fa fa-print'></span> Print</button>
                    </div>
                <div class="col-md-12 col-lg-12">
        
                <div class="card">
                  <div class="card-body">  

                    <div class="row mb-2">
    
                       </div>
                          <table class="table table-data responsive  table-hover" id="unreturned-report-table">                               
                            <thead>
                              <tr>
                                  <th>User ID</th>
                                  <th>Borrower</th>
                                  <th>Contact Number</th>
                                  <th>Accession Number</th>
                                  <th>Title</th>
                                  <th>Date borrowed</th>
                                  <th>Due date</th>
                              </tr>
                          </thead>
                          
                          </table>
      
                        </div>
                      </div>
      
                  </div>
              </div>
      
</div>


@endsection

