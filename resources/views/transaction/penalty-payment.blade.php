@extends('layouts.transaction-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Penalty Payment</h3>
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

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item">
                          <a class="nav-link  active" id="pending-tab" data-toggle="tab" href="#pendingtab" role="tab" aria-controls="contact" aria-selected="true">Payment pending
      
                          </a>
                         </li>
                          <li class="nav-item">
                              <a class="nav-link" id="paid-tab" data-toggle="tab" href="#paidtab" role="tab" aria-controls="home" aria-selected="false">Paid
           
                              </a>
                          </li>
                         
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  active show mt-5" id="pendingtab" role="tabpanel" aria-labelledby="pending-tab">
 
                            <table class="table table-data responsive  table-hover" id="penalty-payment-table">                               
                                <thead>
                                  <tr>
                                      <th>User ID</th>
                                      <th>Borrower</th>
                                      <th>Contact Number</th>
                                      <th>Accession Number</th>
                                      <th>Title</th>
                                      <th>Due date</th>
                                      <th>Remarks</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              
                              </table>
                            
                          </div>
                          <div class="tab-pane fade mt-5" id="paidtab" role="tabpanel" aria-labelledby="paid-tab">
                            <table class="table table-data responsive  table-hover" id="usser-table" style="width: 100%">                               
                                <thead>
                                  <tr>
                                      <th>User name</th>
                                      <th>Name</th> 
                                      <th>Contact Number</th> 
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              </table> 
                          </div>
                 
                      </div>
      
      
                        </div>
                      </div>
                      
                     
                  </div>
              </div>
      
</div>

  <!--Pay Modal-->
  <div class="modal fade" id="payModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want record this as paid?</p>
          <p>Penalty amount: <b>₱ {{ \app\Helpers\base::getPenaltyAmount() }}</b></p>
        </div>
        <form action="{{ action('Utilities\UserCtr@archive') }}" method="POST">
          @csrf
        <input type="hidden" id="id_archive" name="id_archive">
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-dark" type="submit">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

@endsection

