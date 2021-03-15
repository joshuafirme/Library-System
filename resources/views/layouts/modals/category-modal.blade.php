<!--Add  Modal-->
@yield('modals')
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ action('Maintenance\CategoryCtr@store') }}" method="POST">
          @csrf      
          <div class="row">

            <div class="col-12 mb-2">
                <label class="col-form-label">Category</label>
                <input type="text" class="form-control" name="category" required>
              </div>
  
              <div class="col-12 mb-2">
                <label class="col-form-label">Classification</label>
                <input type="text" class="form-control" name="classification" required>
              </div>

          </div>

      </div>
      <div class="modal-footer">

              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!--Edit Modal-->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ action('Maintenance\CategoryCtr@update') }}" method="POST">
          @csrf      
          <div class="row">
            
            <input type="hidden" name="id_hidden" id="id_hidden">

            <div class="col-12">
                <label class="col-form-label">Category</label>
                <input type="text" class="form-control" name="category" id="category" required>
            </div>

            <div class="col-12">
                <label class="col-form-label">Classification</label>
                <input type="text" class="form-control" name="classification" id="classification" required>
            </div>

          </div>

      </div>
      <div class="modal-footer">

              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-primary">Update</button>
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


 