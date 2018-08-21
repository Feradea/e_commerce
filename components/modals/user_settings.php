<div class="modal-content" id="UserSettingsModalContent">
    <div class="modal-header">
        <h5 class="modal-title" id="UserSettingsModalLabel"><?php echo "Dobrodošli" . " " . $_SESSION["user_name"]; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="modal-body">
        <a class="btn btn-outline-info btn-block" href='components/in/user/logout.php'>User Account Info</a>
        <a class="btn btn-outline-info btn-block" href='components/in/user/logout.php'>User Preferences</a>
        <a class="btn btn-outline-dark btn-block" href='components/in/user/logout.php'>Logout</a>
    </div>
    <div class="modal-footer">
        <!-- <ul class="nav justify-content-center">
            <li class="nav-item">
               
            </li>
        </ul> -->
    </div>
</div>