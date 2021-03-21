<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Return book</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  
          <form action="{{ action('Transaction\ReturnCtr@return') }}" method="POST">
            @csrf      
            <div class="row">
              
                <div class="col-12">
                    <h5>Borrower</h5>
                </div>

                <input type="hidden" name="user_id">
                <input type="hidden" name="accession_no">

                <div class="col-6 mb-2">
                    <label class="col-form-label">User ID</label>
                    <a class="form-control" id="user_id"></a>
                </div>

  
                <div class="col-6">
                    <label class="col-form-label">Name</label>
                    <a class="form-control" id="name"></a>
                </div>
  
                <div class="col-6 mb-2">
                    <label class="col-form-label">Grade / Department</label>
                    <a class="form-control" id="grade-dept"></a>
                </div>

                <div class="col-6">
                    <label class="col-form-label">Contact</label>
                    <a class="form-control" id="contact_no"></a>
                </div>
              
                <div class="col-12 mt-2 mb-2"><hr></div>

                <div class="col-12">
                  <h5>Borrowed book</h5>
                </div>
        
                <div class="col-6 mb-2">
                    <label class="col-form-label">Accession Number</label>
                    <a class="form-control" id="accession_no"></a>
                  </div>
      
                <div class="col-6">
                    <label class="col-form-label">Title</label>
                    <a class="form-control" id="title"></a>
                </div>

                <div class="col-6">
                    <label class="col-form-label">Due date</label>
                    <a class="form-control" id="due_date"></a>
                </div>

                <div class="col-6">
                    <label class="col-form-label">Remarks</label>
                    <select class="form-control" name="remarks" id="remarks">
                        <option value="1">Returned</option>
                        <option value="2">Overdue</option>
                        <option value="3">Loss</option>
                    </select>
                 </div>
              
            </div>
  
        </div>
        <div class="modal-footer">
  
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-success" id="btn-add-product">Return</button>
        </div>
      </form>
      </div>
    </div>
  </div>