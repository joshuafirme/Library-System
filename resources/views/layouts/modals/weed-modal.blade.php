
  <!--Retrieve Modal-->
  <div class="modal fade" id="retrieveBookModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to retrieve this book?</p>
        </div>
        <form action="{{ action('Maintenance\WeedBookCtr@retrieve') }}" method="POST">
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