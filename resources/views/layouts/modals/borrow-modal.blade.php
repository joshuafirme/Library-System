<div class="modal fade" id="borrowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Borrow book</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  
          <form action="{{ action('Transaction\BorrowCtr@borrow') }}" method="POST">
            @csrf      
            <div class="row">
              
              <input type="hidden" name="accession_no">

              <div class="col-12">
                <h5>Book information</h5>
            </div>

              <div class="col-6 mb-2">
                <label class="col-form-label">Accession Number</label>
                <a class="form-control" id="accession_no"></a>
              </div>
  
              <div class="col-6">
                  <label class="col-form-label">Title</label>
                  <a class="form-control" id="title"></a>
                </div>

                <div class="col-12 mt-2"><hr></div>

                <div class="col-12">
                    <h5>Borrower</h5>
                </div>

                <div class="col-6">
                    <label class="col-form-label">User ID</label>
                    <input class="form-control" id="search_borrower" required placeholder="Enter student ID or teacher ID">
                </div>

                <div class="col-12"><hr></div>
                    
                    <input type="hidden"  name="user_id" id="user_id">

                    <div class="col-4 mb-2">
                        <label class="col-form-label">Name</label>
                        <a class="form-control" id="name"></a>
                    </div>
      
                    <div class="col-4">
                        <label class="col-form-label">Grade / Department</label>
                        <a class="form-control" id="grade-dept"></a>
                    </div>

                    <div class="col-4">
                        <label class="col-form-label">Contact</label>
                        <a class="form-control" id="contact_no"></a>
                    </div>
  
            </div>
  
        </div>
        <div class="modal-footer">
  
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-success" id="btn-add-product">Borrow</button>
        </div>
      </form>
      </div>
    </div>
  </div>