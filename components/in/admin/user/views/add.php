<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Add user</h5>
  </div>
  <form id="addUserForm">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Firstname</label>
        </div>
        <div class="col-lg-10">
          <input type="text" class="form-control" name="firstname" placeholder="Firstname">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Lastname</label>
        </div>
        <div class="col-lg-10">
          <input type="text" class="form-control" name="lastname" placeholder="Lastname" required>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">E-mail</label>
        </div>
        <div class="col-lg-10">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            </div>
            <input type="email" class="form-control" name="email" placeholder="E-mail" aria-label="E-mail" required>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Password</label>
        </div>
        <div class="col-lg-10">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
            </div>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="Password" required>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Password again</label>
        </div>
        <div class="col-lg-10">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
            </div>
            <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Password again" aria-label="Password2" required>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Role</label>
        </div>
        <div class="col-lg-10">
          <select class="custom-select" name="role" required>
            
            <?php
              $roles = mysqli_query($connection, "SELECT * FROM userlevel");
              if($roles->num_rows > 0) {
                while($role = $roles->fetch_assoc()) {
                  echo "<option value=\"{$role['UserLevelID']}\">{$role['UserLevelName']}</option>";
                }
              } else {
                echo "<option disabled>No results found</option>";
              }
            ?>

          </select>
        </div>
      </div>
    </div>
    <div class="card-footer text-right">
      <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save mr-2" aria-hidden="true"></i>Save</button>
    </div>
  </form> 
</div>