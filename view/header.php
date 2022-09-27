<header>
    <nav>
        <h2><a href="<?= BASE . "/index.php?action=toLanding" ?>" class="logo">Dear Diary</a></h2>
        <ul class="navbar">
            <li><a href="<?= BASE . "/index.php?action=toAboutUs" ?>">About us</a></li>
            <li><a href="#" data-target="#login" data-toggle="modal" class="btn">Login</a></li>
            <li><a href="#" data-target="#signup" data-toggle="modal" class="btn1">Signup</a></li>
        </ul>
    </nav>

    <div id="login" class="modal fade" role="dialog">
        <div class="box">
            <button data-close="modal" id="close" class="close">
                <p><i class="fa-solid fa-circle-xmark"></i></p>
            </button>

            <!-- Sign In form -->

            <form method="POST" action="<?= BASE . "/index.php?action=regularLogin" ?>" class="signin">
                <span id="header-text">Login</span>

                <!-- Back-end Error Notification -->
                <?php if (isset($error_login)) { ?>
                    <script>
                        alert("<?= $error_login; ?>")
                    </script>
                <?php } ?>

                <div class="input-container">
                    <input id="login-ue" 
                    type="text" 
                    name="login-ue" 
                    <?php if(isset($username)) {echo "value='" . $username . "'";}?> 
                    />
                    <label for="login-ue" class="label" >Username / Email</label>
                </div>

                <div class="input-container">
                    <input type="password"
                    id="login-p" 
                    name="login-p" />
                    <div class="svg-container eye" id="si-pwd-show">
                        <i class="fa-solid fa-eye" id="togglePswSi"></i>
                    </div>
                    <label for="login-p" class="label">Password</label>
                </div>

                <button type="submit" class="form-button" id="login-btn">Log In</button>
            </form>
            <div id="or-separator">OR</div>
            <div class="google-btn">
                <div id="g_id_onload" data-client_id="<?= $_SERVER['CLIENT_ID']; ?>" data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleLogin" data-auto_prompt="false"></div>
                <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="pill" data-logo_alignment="left"></div>
            </div>

            <div>
                <a id="kakao-login-btn" href="javascript:loginWithKakao()">
                    <img src="https://k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg" width="222" alt="Kakao login button" />
                </a>
            </div>

            <div id="form-bottom">
                <p>Don't have an account yet?</p>
                <a id="sign-up-link">Sign Up</a>
            </div>
        </div>
    </div>

    <div id="signup" class="modal fade" role="dialog">
        <div class="box">
            <button data-close="modal" id="close1" class="close">
                <p><i class="fa-solid fa-circle-xmark"></i></p>
            </button>


            <!-- Sign Up form -->

            <form method="POST" action="<?= BASE . "/index.php?action=regularSignup" ?>" class="signup" id="su-form">
                <span id="header-text">Sign Up</span>
                
                <!-- Back-end Error Notification -->
                <?php if (isset($error_signup)) { ?>
                    <script>
                        alert("<?= $error_signup; ?>")
                    </script>
                <?php } ?>

                <div class="input-container">
                    <input id="sign-u" type="text" name="sign-u" />
                    <label for="sign-u" class="label">Username</label>
                    <div class="error-msg" id="tooltip-u">
                        <div class="arrow-left"></div>
                        <p>✖ Username can't be less than 4 characters</p>
                    </div>
                </div>

                <div class="input-container">
                    <input id="sign-e" type="text" name="sign-e" />
                    <label for="sign-e" class="label">Email</label>
                    <div class="error-msg" id="tooltip-e">
                        <div class="arrow-left"></div>
                        <p>✖ Please enter a valid Email Address</p>
                    </div>
                </div>
                
            <div class="input-container">
                <input type="password" 
                id="sign-p" 
                name="sign-p" />
                <div class="svg-container eye" id="su-pwd-show">
                    <i class="fa-solid fa-eye" id="togglePsw"></i>
                </div>
                <label for="sign-p" class="label">Password</label>
                <div class="error-msg" id="tooltip-psw">
                    <div class="arrow-left"></div>
                    <p>✖ Please enter a valid Password</p>
                </div>

                    <div id="tooltip-p">
                        <div class="arrow-left"></div>
                        <div id="message">
                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                            <p id="capital" class="invalid">A <b>capital</b> letter</p>
                            <p id="number" class="invalid">A <b>number</b></p>
                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                        </div>
                    </div>
            </div>

            <div class="input-container">
                <input type="password"
                id="sign-cp"
                name="sign-cp"/>
                <div class="svg-container eye" id="su-pwd2-show">
                    <i class="fa-solid fa-eye" id="togglePsw2"></i>
                </div>
                <label for="sign-cp" class="label">Confirm Password</label>
                <div class="error-msg" id="tooltip-cp">
                    <div class="arrow-left"></div>
                    <p>✖ Please match with the above password</p>
                </div>
            </div>

            <button type="submit" class="form-button" id="signup-btn">Sign Up</button>
        </form>

            <div id="or-separator">OR</div>

            <!-- Google login -->
            <div class="google-btn">
                <div id="g_id_onload" data-client_id="<?= $_SERVER['CLIENT_ID'] ?>" data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleSignUp" data-auto_prompt="false">
                </div>
                <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="signup_with" data-shape="pill" data-logo_alignment="left">
                </div>
            </div>
            <a href="javascript:signUpWithKakao()">
                <button class="form-button">Kakao</button>
            </a>
    </div>
<div class="blur"></div>
</header>

<!-- FORM VALIDATION -->
<script src="<?= BASE . "/public/js/formValidation.js"; ?>"></script>

<!-- GOOGLE -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<!-- KAKAO -->
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script> Kakao.init("<?= $_SERVER['JS_API_KEY'] ?>"); </script>
<script src="<?= BASE . "/public/js/kakao.js"; ?>"></script>