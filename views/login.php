<?php
ob_start();
?>
<!-- Material form login -->
<div class="container my-5 py-5 z-depth-1">
  <div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card">
          <h5 class="card-header info-color white-text text-center py-4">
            <strong>Sign in</strong>
          </h5>
          <!--Card content-->
          <div class="card-body px-lg-5 pt-0">
              <!-- Form -->
              <form class="text-center" style="color: #757575;" action="#!">
                <!-- Email -->
                <div class="md-form">
                  <input type="email" id="nom" class="form-control champs">
                  <label for="login">E-mail</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                  <input type="password" id="password" class="form-control champs">
                  <label for="password">Password</label>
                </div>

                <div class="d-flex justify-content-around">
                  <div>
                    <!-- Remember me -->
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                      <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                    </div>
                  </div>
                  <div></div>
                </div>

                <!-- Sign in button -->
                <button id="login" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

                <!-- Register -->
                <p>Pas de compte?
                  <a href="signin">S'enregister</a>
                </p>

                <!-- Social login -->
                <p>or sign in with:</p>
                <a type="button" class="btn-floating btn-fb btn-sm">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a type="button" class="btn-floating btn-tw btn-sm">
                  <i class="fab fa-twitter"></i>
                </a>
                <a type="button" class="btn-floating btn-li btn-sm">
                  <i class="fab fa-linkedin-in"></i>
                </a>
                <a type="button" class="btn-floating btn-git btn-sm">
                  <i class="fab fa-github"></i>
                </a>

              </form>
              <!-- Form -->

          </div>

        </div>
        <!-- Material form login -->
      </div>
        </div>
  </div>
<?php
$content = ob_get_clean();
require_once 'includes/template.php';
