<?php
  if(!$_SESSION['isAdmin'])
    exit("Authentication required!");
?>

<?php 
  if (!isset($_GET['userId'])) {
?>
<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Edit user</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-light">
          <tr class="text-center">
            <th scope="col"><i class="fas fa-cog text-center"></i></th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $currentUserId = $_SESSION['id_user'];
            $users = mysqli_query($connection, "SELECT * FROM users u LEFT JOIN userlevel ul ON u.UserUserLevelID_FK = ul.UserLevelID WHERE u.UserID != '$currentUserId'");
            if ($users->num_rows > 0) {
              while($user = $users->fetch_assoc()) {
                echo "<tr>";
                  echo "<td><a href='index.php?user_settings=edit&userId={$user['UserID']}' class='btn btn-sm btn-primary'><i class='fas fa-edit mr-2'></i>Edit</a></td>";
                  echo "<td>{$user['UserFirstName']}, {$user['UserLastName']}</td>";
                  echo "<td>{$user['UserEmail']}</td>";
                  echo "<td>{$user['UserLevelName']}</td>";
                  echo "<td>{$user['UserStatus']}</td>";
                echo "</tr>";
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php 
  } else {
    $userId = $_GET['userId'];
    $selectedUser = mysqli_query($connection, "SELECT * FROM users u LEFT JOIN userlevel ul ON u.UserUserLevelID_FK = ul.UserLevelID WHERE u.UserID = '$userId'");

    if ($selectedUser->num_rows > 0) {
      $user = $selectedUser->fetch_assoc();
?>

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0"><?php echo "{$user['UserFirstName']}, {$user['UserLastName']}"; ?></h5>
  </div>
  <form id="editUserForm">
    <input type="hidden" name="userId" value="<?php echo $userId ?>">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Firstname</label>
        </div>
        <div class="col-lg-10">
          <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo $user['UserFirstName'] ?>">
        </div>
      </div>  
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Lastname</label>
        </div>
        <div class="col-lg-10">
          <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo $user['UserLastName'] ?>" required>
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
            <input type="email" class="form-control" name="email" placeholder="E-mail" aria-label="E-mail" required value="<?php echo $user['UserEmail'] ?>" disabled>
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
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="Password">
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
            <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Password again" aria-label="Password2">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-2">
          <label class="col-form-label">Role</label>
        </div>
        <div class="col-lg-10">
          <select class="custom-select" name="role" required>
            <option value="<?php echo $user['UserLevelID'] ?>" selected><?php echo $user['UserLevelName'] ?></option>
            <?php
              $currentRoleId = $user['UserLevelID'];
              $roles = mysqli_query($connection, "SELECT * FROM userlevel WHERE UserLevelID != '$currentRoleId'");
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


<?php 
    } else {
        echo "<h4 class='text-center text-danger'>No results found..</h4>"; 
    }

}
?>