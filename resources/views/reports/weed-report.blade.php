@extends('layouts.reports-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Weed Books Report</h3>
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
      
              <div class="row">
                <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                    <button class="btn btn-danger btn-sm"id="btn-weed-print"><span class='fa fa-print'></span> Print</button>
                </div>
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                  <div class="card-body">  
                          <table class="table table-data responsive  table-hover" id="weed-table" width="100%">                               
                            <thead>
                              <tr>
                                  <th>Accession Number</th>
                                  <th>Title</th>   
                                  <th>Author</th>   
                                  <th>Publisher</th> 
                                  <th>Category</th>          
                                  <th>Classification</th>
                                  <th>Edition</th>
                                  <th>Copies</th>
                                  <th>Date weed</th>
                              </tr>
                          </thead>
                          
                          </table>
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>

@endsection

