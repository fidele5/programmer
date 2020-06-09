<?php
    ob_start();
?>
<div class="container my-5 py-5 z-depth-1">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <!-- Default form register -->
            <form class="text-center border border-light p-5" action="#!">

                <p class="h4 mb-4">Inscription</p>

                
                <input type="text" id="nom" class="form-control mb-4 field" placeholder="Nom complet">

                <!-- E-mail -->
                <input type="email" id="email" class="form-control mb-4 field" placeholder="E-mail">
                <div id="err" class="valid-feedback">
                
                </div>

                <!-- Password -->
                <input type="password" id="password" class="form-control mb-4 field" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">

                <div class="form-row">
                    <div class="col">
                        <select id="status" class="browser-default custom-select field">
                            <option selected>Status</option>
                            <?php
                                for ($i=0; $i < count($statuses); $i++) {
                                    ?>
                            <option value="<?=$statuses[$i]["id"]?>"><?=$statuses[$i]["nom"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select id="domain" class="browser-default custom-select field">
                            <option selected>Domaine</option>
                            <?php
                                for ($i = 0; $i < count($domaines); $i++) {
                            ?>
                            <option value="<?=$domaines[$i]["id"]?>"><?=$domaines[$i]["nom"]?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Sign up button -->
                <button id="signin" class="btn btn-info my-4 btn-block" type="submit">S'inscrire</button>

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
