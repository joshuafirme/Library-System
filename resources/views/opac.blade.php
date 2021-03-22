@extends('layouts.opac-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">OPAC</h3>
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
      
              <div class="row">
  
                    <div class="mt-2 ml-3">
                      Search by
                      </div>
        
                    <div class="col-sm-2 mb-3">
                        <select class="form-control" id="search_by">
                            <option value="0">Accession Number</option>
                            <option value="1">Title</option>
                            <option value="2">Author</option>
                            <option value="3">Publisher</option> 
                            <option value="4">Category</option>          
                            <option value="5">Classification</option>
                        </select>
                    </div>

                    <div class="col-sm-2 mb-3">
                        <input class="form-control" id="search_key" type="search">
                    </div>
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                  <div class="card-body">  
                          <table class="table table-data responsive  table-hover" id="opac-table">                               
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
                              </tr>
                          </thead>
                          
                          </table>
      
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>


@endsection

