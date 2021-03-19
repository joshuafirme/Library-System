<div class="modal fade" id="reserveBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Reserve book</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  
          <form action="{{ action('Transaction\ReserveCtr@reserveBook') }}" method="POST">
            @csrf      
            <div class="row">
              
              <input type="hidden" name="accession_no">

              <div class="col-6 mb-2">
                <label class="col-form-label">Accession Number</label>
                <a class="form-control" id="accession_no"></a>
              </div>
  
              <div class="col-6">
                  <label class="col-form-label">Title</label>
                  <a class="form-control" id="title"></a>
                </div>
  
                <div class="col-6 mb-2">
                  <label class="col-form-label">Author</label>
                  <a class="form-control" id="author"></a>
                </div>
  
                <div class="col-6">
                  <label class="col-form-label">Publisher</label>
                  <a class="form-control" id="publisher"></a>
                </div>
    
              <div class="col-4 mb-2">    
                <label class="col-form-label">Category</label>
                <a class="form-control" id="category"></a>
              </div>
  
              <div class="col-4">    
                  <label class="col-form-label">Classification</label>
                  <a class="form-control" id="classification"></a>
                  </select>
                </div>
  
                <div class="col-4">
                  <label class="col-form-label">Edition</label>
                  <a class="form-control" id="edition"></a>
                </div>
  
                <div class="col-4 mb-2">
                  <label class="col-form-label">Number of copies</label>
                  <a class="form-control" id="copies"></a>
                </div>
  
                <div class="col-4">
                  <label class="col-form-label">Number of pages</label>
                  <a class="form-control" id="no_of_pages"></a>
                </div>
  
                <div class="col-4">
                  <label class="col-form-label">Date Acquire</label>
                  <a class="form-control" id="date_acq"></a>
                </div>
  
                <div class="col-4">
                  <label class="col-form-label">Date published</label>
                  <a class="form-control" id="date_published"></a>
                </div>

                <div class="col-12 mt-2"><hr></div>

                <div class="col-4">
                    <label class="col-form-label">Reservation Date</label>
                    <input class="form-control" type="date" name="reservation_date" id="reservation_date" required>
                </div>
  
            </div>
  
        </div>
        <div class="modal-footer">
  
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-success" id="btn-add-product">Reserve now</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  


  <!--Approve Reservation Modal-->
  <div class="modal fade" id="approveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to approve this reservation?</p>
        </div>
        <form action="{{ action('Transaction\ReserveCtr@approveReservation') }}" method="POST">
          @csrf
        <input type="hidden" id="user_id" name="user_id">
        <input type="hidden" id="acn_no" name="accession_no">
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-dark" type="submit">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!--Approve Reservation Modal-->
  <div class="modal fade" id="declineModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to decline this reservation?</p>
        </div>
        <form action="{{ action('Transaction\ReserveCtr@declineReservation') }}" method="POST">
          @csrf
        <input type="hidden" id="user_id" name="user_id">
        <input type="hidden" id="acn_no" name="accession_no">
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-dark" type="submit">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>