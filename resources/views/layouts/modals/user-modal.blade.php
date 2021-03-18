<!--Add  Modal-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Add user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ action('Utilities\UserCtr@store') }}" method="POST">
          @csrf      
          <div class="row">

            <div class="col-4">
                <label class="col-form-label">User type</label>
                <select class="form-control" name="user_type" id="user_type">
                    <option value="2">Student</option>
                    <option value="1">Teacher</option>
                    <option value="0">Librarian</option>
                    <option value="0">Administrator</option>
                </select>
              </div>

            <div class="col-4 mb-2">
                <label class="col-form-label">Name</label>
                <input type="text" class="form-control" name="name" required>
              </div>
  

             <div class="col-4">
                <label class="col-form-label">Grade</label>
                <select class="form-control" name="grade" id="grade">
                    <option value="Grade 1">Grade 1</option>
                    <option value="Grade 2">Grade 2</option>
                    <option value="Grade 3">Grade 3</option>
                    <option value="Grade 4">Grade 4</option>
                    <option value="Grade 5">Grade 5</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                </select>
              </div>
  

              <div class="col-4 mb-2">
                <label class="col-form-label">Department</label>
                <select class="form-control" name="department" id="department" readonly>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Science">Science</option>
                    <option value="English">English</option>
                </select>
              </div>

              <div class="col-4">
                <label class="col-form-label">Contact Number</label>
                <input type="text" class="form-control" name="contact_no" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Address</label>
                <input type="text" class="form-control" name="address" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">User ID</label>
                <input type="text" class="form-control" name="user_id" required>
              </div>
  
              <div class="col-4 mb-2">
                <label class="col-form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
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


<!--edit  Modal-->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit user</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ action('Utilities\UserCtr@update') }}" method="POST">
          @csrf      
          <div class="row">

            <input type="hidden" name="user_id_hidden" id="user_id_hidden">

            <div class="col-4">
                <label class="col-form-label">User type</label>
                <select class="form-control" name="user_type" id="edit_user_type">
                    <option value="2">Student</option>
                    <option value="1">Teacher</option>
                    <option value="0">Librarian</option>
                    <option value="0">Administrator</option>
                </select>
              </div>

            <div class="col-4 mb-2">
                <label class="col-form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
  

             <div class="col-4">
                <label class="col-form-label">Grade</label>
                <select class="form-control" name="grade" id="edit_grade">
                    <option value="Grade 1">Grade 1</option>
                    <option value="Grade 2">Grade 2</option>
                    <option value="Grade 3">Grade 3</option>
                    <option value="Grade 4">Grade 4</option>
                    <option value="Grade 5">Grade 5</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                    <option value="Grade 12">Grade 12</option>
                </select>
              </div>
  

              <div class="col-4 mb-2">
                <label class="col-form-label">Department</label>
                <select class="form-control" name="department" id="edit_department" readonly>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Science">Science</option>
                    <option value="English">English</option>
                </select>
              </div>

              <div class="col-4">
                <label class="col-form-label">Contact Number</label>
                <input type="text" class="form-control" name="contact_no" id="contact_no" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address" required>
              </div>

              <div class="col-4">
                <label class="col-form-label">User ID</label>
                <input type="text" class="form-control" name="user_id" id="user_id" required>
              </div>
  
              <div class="col-4 mb-2">
                <label class="col-form-label">New Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
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
  <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure do you want to archive this user?</p>
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


 