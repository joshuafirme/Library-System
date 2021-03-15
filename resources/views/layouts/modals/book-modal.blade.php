<!--Add product Modal-->
@yield('modals')
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add book</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ action('Maintenance\BookCtr@store') }}" method="POST" enctype="multipart/form-data">
          @csrf      
          <div class="row">
            <input type="hidden" id="discount_hidden">
            
            <div class="col-6 mb-2">
              <label class="col-form-label">Accession Number</label>
              <input type="text" class="form-control" name="accession_no" required>
            </div>

            <div class="col-6">
                <label class="col-form-label">Title</label>
                <input type="text" class="form-control" name="title" required>
              </div>

              <div class="col-6 mb-2">
                <label class="col-form-label">Author</label>
                <input type="text" class="form-control" name="author" required>
              </div>

              <div class="col-6">
                <label class="col-form-label">Publisher</label>
                <input type="text" class="form-control" name="publisher" required>
              </div>
  
            <div class="col-4 mb-2">    
              <label class="col-form-label">Category</label>
              <select class="form-control" name="category" id="category">
                  <option value=1>Test</option>
              </select>
            </div>

            <div class="col-4">    
                <label class="col-form-label">Sub category</label>
                <select class="form-control" name="sub_category" id="sub_category">
                  <option value=1>Test</option>
                </select>
              </div>

              <div class="col-4">
                <label class="col-form-label">Edition</label>
                <input type="text" class="form-control" name="edition" required>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Number of copies</label>
                <input type="number" class="form-control" name="no_of_copies" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Number of pages</label>
                <input type="number" class="form-control" name="no_of_pages" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Amount if lost</label>
                <input type="number" class="form-control" name="amount_if_lost" required>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Cost</label>
                <input type="number" class="form-control" name="cost" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Date Acquire</label>
                <input type="date" class="form-control" name="date_acq" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Date published</label>
                <input type="date" class="form-control" name="date_published" required>
              </div>

          </div>

      </div>
      <div class="modal-footer">

              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-primary" id="btn-add-product">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>


  <!--Confirm Modal-->
  <div class="modal fade" id="proconfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="delete-message"></p>
        </div>
        <div class="delete-success" style="display: none;">
          <span style="margin-left:180px;" class="text-success">Deleted Successfully!</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="button" name="ok_button" id="product_ok_button">Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>


 