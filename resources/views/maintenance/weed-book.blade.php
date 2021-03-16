@extends('layouts.maintenance-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Weed Maintenance</h3>
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
      
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                  <div class="card-body">  
                          <table class="table table-data responsive  table-hover" id="weed-table" width="100%">                               
                            <thead>
                              <tr>
                                  {{--<th><input type="checkbox" name="select_all" value="1" id="select-all-product"></th>--}}
                                  <th>Accession Number</th>
                                  <th>Author</th>   
                                  <th>Publisher</th> 
                                  <th>Category</th>          
                                  <th>Sub Category</th>
                                  <th>Edition</th>
                                  <th>Copies</th>
                                  <th>Amount if lost</th>
                                  <th>Cost</th>
                                  <th>Date acquired</th>
                                  <th>Date published</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          
                          </table>
      
                         {{-- <img class="ml-2" src="{{asset('assets/arrow_ltr.png')}}" alt="">
      
                          <button class="btn btn-sm btn-danger mt-2" id="btn-bulk-archive">Weed</button>--}}
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>



@endsection

