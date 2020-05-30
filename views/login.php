<?php
ob_start();
?>
<!-- Material form login -->
<div class="container my-5 py-5 z-depth-1">
  <div class="row justify-content-center">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <!-- Default form login -->
      <form class="text-center border border-light p-5" action="#!">

          <p class="h4 mb-4">Sign in</p>

          <!-- Email -->
          <input type="email" id="nom" class="form-control mb-4 champs" placeholder="E-mail">

          <!-- Password -->
          <input type="password" id="password" class="form-control mb-4 champs" placeholder="Mot de passe">

          <div class="d-flex justify-content-around">
              <div>
                  <!-- Remember me -->
                  <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                      <label class="custom-control-label" for="defaultLoginFormRemember">Se souvenir de moi</label>
                  </div>
              </div>
          </div>

          <!-- Sign in button -->
          <button id="login" class="btn btn-info btn-block my-4" type="submit">Se connecter</button>

          <!-- Register -->
          <p>Pas de compte?
              <a href="signin">Register</a>
          </p>

          <!-- Social login -->
          <p>or sign in with:</p>

          <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
          <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
          <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
          <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

      </form>
      <!-- Default form login -->
      </div>
        </div>
  </div>
<?php
$content = ob_get_clean();
require_once 'includes/template.php';
