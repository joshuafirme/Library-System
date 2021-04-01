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
          
              @include('layouts.alert-validation')
      
              <div class="row">
      
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                  <div class="card-body">  
                          <table class="table table-data responsive  table-hover" id="weed-table" width="100%">                               
                            <thead>
                              <tr>
                                  {{--<th><input type="checkbox" name="select_all" value="1" id="select-all-product"></th>--}}
                                  <th>Accession Number</th>
                                  <th>Title</th>   
                                  <th>Author</th>   
                                  <th>Publisher</th> 
                                  <th>Category</th>          
                                  <th>Sub Category</th>
                                  <th>Edition</th>
                                  <th>Copies</th>
                                  <th>Date weed</th>
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

@include('layouts.modals.weed-modal')

@endsection

