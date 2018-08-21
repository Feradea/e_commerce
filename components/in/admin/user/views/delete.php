<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>

<div class="card">
  <div class="card-header">
    <h5 class="mb-0 card-title">Delete user</h5>
  </div>
  <form id="deleteUserForm">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Select user</label>
        </div>
        <div class="col-lg-10">
          <select name="userToDelete" class="custom-select">
            <?php
              $currentUserID = $_SESSION['id_user'];
              $users = mysqli_query($connection, "SELECT * FROM users WHERE UserID != '$currentUserID'");

              if ($users->num_rows > 0) {
                while($user = $users->fetch_assoc()) {
                  echo "<option value=\"{$user['UserID']}\">{$user['UserFirstName']}, {$user['UserLastName']} - {$user['UserEmail']}</option>";
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
      <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt mr-2"></i>Delete</button>
    </div>
  </form>
</div>