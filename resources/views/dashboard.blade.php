@extends('layouts.dashboard-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Dashboard</h3>
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
                <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                    <div class="card">
                        <div class="card-header">Borrowed Books</div>
                        <div class="card-body">
                            <table class="table" id="borrowed-table" style="100%;">
                                <thead>
                                    <tr>
                                        <th>Accession Number</th>
                                        <th>Title</th> 
                                        <th>Author</th>   
                                        <th>Publisher</th> 
                                        <th>Category</th>          
                                        <th>Classification</th>
                                        <th>Edition</th>
                                        <th>Status</th>
                                    </tr>
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 mb-5">
                    <div class="card">
                        <div class="card-header">Reserved Books</div>
                        <div class="card-body">
                            <table class="table" id="reserved-table" style="100%;">
                                <thead>
                                    <tr>
                                        <th>Accession Number</th>
                                        <th>Title</th> 
                                        <th>Author</th>   
                                        <th>Publisher</th> 
                                        <th>Category</th>          
                                        <th>Classification</th>
                                        <th>Edition</th>
                                        <th>Status</th>
                                    </tr>
                                </thead> 
                            </table>
                        </div>
                    </div>
                </div>
              </div>
      
</div>


@endsection

