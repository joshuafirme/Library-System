@extends('layouts.transaction-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Borrow Book</h3>
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
                          <table class="table table-data responsive  table-hover" id="borrow-book-table">                               
                            <thead>
                              <tr>
                                  <th>Accession Number</th>
                                  <th>Title</th> 
                                  <th>Author</th>   
                                  <th>Category</th>          
                                  <th>Classification</th>
                                  <th>Edition</th>
                                  <th>Copies</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          
                          </table>
      
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>

@include('layouts.modals.borrow-modal')

@endsection

