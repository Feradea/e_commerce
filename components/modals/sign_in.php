<?php

    $token_login = mt_rand() . mt_rand() . mt_rand();
    $_SESSION["token_login"] = $token_login;
    $hash_salt_token_login = password_hash($token_login, PASSWORD_DEFAULT);

    // $_SESSION["token_login"] = 'rasmuslerdorf';
    // $hash_salt_token_login = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq'; 
?>

<div class="modal-content" id="signInModalContent">
    <div class="modal-header">
        <h5 class="modal-title" id="signInModalLabel">Log in to Your Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="modal-body">
        <form id="signInForm">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="signInInputEmail">Email address</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" maxlength="64" size="64" name="signInInputEmail" id="signInInputEmail"required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="signInInputPassword">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" maxlength="64" size="64" name="signInInputPassword" id="signInInputPassword" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="signInInputRemember"> Remember me </label>
                <div class="col-sm-8">
                    <input class="checkbox" type="checkbox" name="signInInputRemember" id="signInInputRemember"> 
                </div>
            </div>
            <button type="submit" id="signInSubmit" class="btn btn-success btn-block text-uppercase">Sign in</button>
            <hr>
            <input type="hidden" name="token_login" id="token_login" value="<?php echo $hash_salt_token_login; ?>">
        </form>
        <div id="signInMsgArea" style="display:none; margin-top:2rem;">
            <div id="signInMsg" class="alert" style="display:none;">
                Some text
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="btn btn-link" id="forget-pass-modal-btn" href="javascript:void(0)"> Forgotten Password? </a>
            </li>
            <li class="nav-item">
                Don't you have account? 
                <a class="btn btn-link" id="sign-up-modal-btn" href="javascript:void(0)"> Sign up here! </a>
            </li>
        </ul>
    </div>
</div>