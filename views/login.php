<?php
ob_start();
?>
  <div class="yoo-login-wrap yoo-style1">
    <div class="container">
      <div class="row">
        <div class="col-lg-7"><i class="fab fa-500px"></i>
          <div class="yoo-vertical-middle">
            <div class="yoo-vertical-middle-in">
              <div class="yoo-signup-img yoo-style1">
                <img src="public/img/signup/01.png" alt="">
              </div>
            </div>
          </div>
        </div><!-- .col -->
        <div class="col-lg-5">
          <div class="yoo-vertical-middle">
            <div class="yoo-vertical-middle-in">
              <form action="#" class="yoo-form yoo-style1">
                <h2 class="yoo-form-title">Sign in to continue</h2>
                <div class="yoo-form-subtitle">Don’t have an account?  <a href="signup" class="yoo-form-btn yoo-style2">Sign up</a></div>
                <div class="yoo-height-b25 yoo-height-lg-b25"></div>
                <ul class="yoo-social-area yoo-style1 yoo-mp0">
                  <li><a href="#" class="yoo-form-btn yoo-style1 yoo-colo2"><i class="fab fa-facebook-f"></i><span>Sign up with Facebook</span></a></li>
                  <li><a href="#" class="yoo-form-btn yoo-style1 yoo-colo3"><i class="fab fa-google-plus-g"></i><span>Sign up with Gmail</span></a></li>
                </ul>
                <div class="yoo-height-b15 yoo-height-lg-b15"></div>
                <div class="yoo-form-separator">Or</div>
                <div class="yoo-height-b15 yoo-height-lg-b15"></div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group level-up form-group-md">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" id="email">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group level-up form-group-md">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password">
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="yoo-forget-pass-wrap">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="gridCheck">
                          <label class="custom-control-label" for="gridCheck">
                            <span class="custom-control-shadow"></span>Remember me
                          </label>
                        </div>
                        <a href="#" class="yoo-form-btn yoo-style2">Forgot password?</a>
                      </div>
                    </div>
                    <a href="accueil" class="yoo-form-btn yoo-style1 yoo-color1" class="yoo-form-btn yoo-style2 yoo-type1"><span>Sign Up</span></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!-- .container -->
  </div>
<?php
$content = ob_get_clean();
require_once 'includes/template.php';