@extends('layouts.transaction-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">For Release</h3>
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
                          <table class="table table-data responsive  table-hover" id="for-release-table">                               
                            <thead>
                              <tr>
                                  <th>User ID</th>
                                  <th>Borrower Name</th>
                                  <th>Accession Number</th>
                                  <th>Title</th>
                                  <th>Reservation Date</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          
                          </table>
      
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>

  <!--Release Modal-->
  <div class="modal fade" id="releaseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to release this book?</p>
        </div>
        <form action="{{ action('Transaction\ForReleaseCtr@release') }}" method="POST">
          @csrf
            <input type="hidden" id="user_id" name="user_id">
            <input type="hidden" id="acn_no" name="accession_no">
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-dark" type="submit">Yes</button>
          <button class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
      
        </form>
        </div>
      </div>
    </div>
  </div>

@endsection

