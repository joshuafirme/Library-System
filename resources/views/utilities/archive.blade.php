@extends('layouts.utilities-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Archive</h3>
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
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                    <div class="card-body">
               
                        
                        <table class="table table-data responsive  table-hover" id="archive-table" style="width: 100%">                               
                            <thead>
                              <tr>
                                  <th>User ID</th>
                                  <th>Name</th> 
                                  <th>Contact Number</th> 
                                  <th>Address</th> 
                                  <th>Date archived</th> 
                                  <th>Action</th>
                              </tr>
                          </thead> 
                        </table>
      
                    </div>
                </div>
                      
                     
                  </div>
              </div>
      
</div>


  <!--retrieve Modal-->
  <div class="modal fade" id="retrieveUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this user?</p>
        </div>
        <form action="{{ action('Utilities\ArchiveCtr@retrieve') }}" method="POST">
          @csrf
        <input type="hidden" id="id_retrieve" name="id_retrieve">
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-dark" type="submit">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection

