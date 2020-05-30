<?php
    ob_start();
?>
<div class="container my-5 py-5 z-depth-1">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- Default form register -->
            <form class="text-center border border-light p-5" action="#!">

                <p class="h4 mb-4">Sign up</p>

                
                <input type="text" id="nom" class="form-control mb-4 field" placeholder="Nom complet">

                <!-- E-mail -->
                <input type="email" id="email" class="form-control mb-4 field" placeholder="E-mail">

                <!-- Password -->
                <input type="password" id="password" class="form-control field" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
                <small id="password" class="form-text text-muted mb-4">
                    At least 8 characters and 1 digit
                </small>

                <div class="form-row">
                    <div class="col">
                        <select id="status" class="browser-default custom-select field">
                            <option selected>Status</option>
                            <option value="1">Etudiant</option>
                            <option value="2">Professeur</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="domain" class="browser-default custom-select field">
                            <option selected>Domaine</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                
                <!-- Newsletter -->
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter">
                    <label class="custom-control-label" for="defaultRegisterFormNewsletter">Subscribe to our newsletter</label>
                </div>

                <!-- Sign up button -->
                <button id="signin" class="btn btn-info my-4 btn-block" type="submit">Sign in</button>

                <!-- Social register -->
                <p>or sign up with:</p>

                <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
                <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

                <hr>

                <!-- Terms of service -->
                <p>By clicking
                    <em>Sign up</em> you agree to our
                    <a href="" target="_blank">terms of service</a>

            </form>
<!-- Default form register -->
        </div>
    </div>
</div>
<?php
    $content = ob_get_clean();
    require_once 'includes/template.php';
