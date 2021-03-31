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
                  @foreach ($category as $data)
                     <option value="{{$data->category}}">{{ $data->category }}</option>
                  @endforeach
              </select>
            </div>

            <div class="col-4">    
                <label class="col-form-label">Classification</label>
                <select class="form-control" name="classification" id="classification">
                </select>
              </div>

              <div class="col-4">
                <label class="col-form-label">Edition</label>
                <input type="text" class="form-control" name="edition" required>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Number of copies</label>
                <input type="number" class="form-control" name="copies" required>
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


<!--Edit Modal-->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Book Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="row">
            
            <div class="col-6 mb-2">
              <label class="col-form-label">Accession Number</label>
              <a class="form-control" name="accession_no"></a>
            </div>

            <div class="col-6">
                <label class="col-form-label">Title</label>
                <a class="form-control" name="title"></a>
              </div>

              <div class="col-6 mb-2">
                <label class="col-form-label">Author</label>
                <a class="form-control" name="author"></a>
              </div>

              <div class="col-6">
                <label class="col-form-label">Publisher</label>
                <a class="form-control" name="publisher"></a>
              </div>
  
              <div class="col-4">
                <label class="col-form-label">Category</label>
                <a class="form-control" name="category"></a>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Classification</label>
                <a  class="form-control" name="classification"></a>
              </div>

              <div class="col-4">
                <label class="col-form-label">Edition</label>
                <a class="form-control" name="edition"></a>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Number of copies</label>
                <a class="form-control" name="copies"></a>
              </div>

              <div class="col-4">
                <label class="col-form-label">Number of pages</label>
                <a type="number" class="form-control" name="no_of_pages"></a>
              </div>

              <div class="col-4">
                <label class="col-form-label">Amount if lost</label>
                <a type="number" class="form-control" name="amount_if_lost"></a>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Cost</label>
                <a type="number" class="form-control" name="cost"></a>
              </div>

              <div class="col-4">
                <label class="col-form-label">Date Acquire</label>
                <a type="date" class="form-control" name="date_acq"></a>
              </div>

              <div class="col-4">
                <label class="col-form-label">Date published</label>
                <a type="date" class="form-control" name="date_published"></a>
              </div>

          </div>

      </div>
      <div class="modal-footer">

              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit book</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ action('Maintenance\BookCtr@update') }}" method="POST" enctype="multipart/form-data">
          @csrf      
          <div class="row">
            <input type="hidden" id="id_hidden" name="id_hidden">
            
            <div class="col-6 mb-2">
              <label class="col-form-label">Accession Number</label>
              <input type="text" class="form-control" name="accession_no" id="accession_no" required>
            </div>

            <div class="col-6">
                <label class="col-form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" required>
              </div>

              <div class="col-6 mb-2">
                <label class="col-form-label">Author</label>
                <input type="text" class="form-control" name="author" id="author" required>
              </div>

              <div class="col-6">
                <label class="col-form-label">Publisher</label>
                <input type="text" class="form-control" name="publisher" id="publisher" required>
              </div>
  
            <div class="col-4 mb-2">    
              <label class="col-form-label">Category</label>
              <select class="form-control" name="category" id="edit_category">
                  @foreach ($category as $data)
                     <option value={{ $data->category }}>{{ $data->category }}</option>
                  @endforeach
              </select>
            </div>

            <div class="col-4">    
                <label class="col-form-label">Classification</label>
                <select class="form-control" name="classification" id="edit_classification">
                </select>
              </div>

              <div class="col-4">
                <label class="col-form-label">Edition</label>
                <input type="text" class="form-control" name="edition" id="edition" required>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Number of copies</label>
                <input type="number" class="form-control" name="copies" id="copies" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Number of pages</label>
                <input type="number" class="form-control" name="no_of_pages" id="no_of_pages" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Amount if lost</label>
                <input type="number" class="form-control" name="amount_if_lost" id="amount_if_lost" required>
              </div>

              <div class="col-4 mb-2">
                <label class="col-form-label">Cost</label>
                <input type="number" class="form-control" name="cost" id="cost" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Date Acquire</label>
                <input type="date" class="form-control" name="date_acq" id="date_acq" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Date published</label>
                <input type="date" class="form-control" name="date_published" id="date_published" required>
              </div>

          </div>

      </div>
      <div class="modal-footer">

              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-primary" id="btn-add-product">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <!--ImportModal-->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Import</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
        <div class="modal-body">
          
          <form action="{{ action('Maintenance\BookCtr@import') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-success">Import</button>
              <button class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </form>
    </div>
  </div>
</div>


  <!--Weed Modal-->
  <div class="modal fade" id="weedModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to weed this book?</p>
        </div>
        <form action="{{ action('Maintenance\BookCtr@weed') }}" method="POST">
          @csrf
        <input type="hidden" id="id_weed" name="id_weed">
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-dark" type="submit">Yes</button>
          <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>



 