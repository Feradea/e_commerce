<?php
$token_reg = mt_rand() . mt_rand() . mt_rand();
$_SESSION["token_reg"] = $token_reg;
$hash_salt_token_reg = password_hash($token_reg, PASSWORD_DEFAULT);
?>
<div class="modal-content" id="signUpModalContent">
    <div class="modal-header">
        <h5 class="modal-title" id="signUpModalLabel">Register</h5>
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="modal-body">
        <form id="signUpForm" class="signUpForm" name="signUpForm">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="signUpInputFirstName">First Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="signUpInputFirstName" maxlength="32" size="32" id="signUpInputFirstName" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="signUpInputLastName">Last Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="signUpInputLastName" maxlength="32" size="32" id="signUpInputLastName" required>
                </div>

            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="signUpInputEmail">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" name="signUpInputEmail" maxlength="64" size="64" id="signUpInputEmail" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="signUpInputPassword">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="signUpInputPassword" maxlength="64" size="64" id="signUpInputPassword" required>
                </div>
            </div>

            <button type="submit" id="signUpSubmit" class="btn btn-success btn-block text-uppercase">Register</button>
            <hr>
            <input type="hidden" name="token_reg" id="token_reg" value="<?php echo $hash_salt_token_reg; ?>">
        </form>
        <div id="signUpMsgArea" style="display:none; margin-top:2rem;">
            <div id="signUpMsg" class="alert" style="display:none;">
                Some text
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <p class="sub-link-text">
            Already have account?
            <a class="btn btn-link" id="sign-in-modal-btn" href="javascript:void(0)">Sign in!</a>
        </p>
    </div>
</div>