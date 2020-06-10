<?php
    ob_start();
?>
    <link rel="stylesheet" type="text/css" href="public/plugins/dropify/dropify.min.css">
    <link href="public/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link href="public/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="public/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <script src="public/plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="public/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="public/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="public/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">                       
                <div class="account-settings-container layout-top-spacing">
                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="contact" class="section contact">
                                        <div class="info">
                                            <h5 class="">Modifier profil</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="login">Login</label>
                                                                <input type="text" class="form-control mb-4" id="login" placeholder="Login" value="<?=$user[0]["email"]?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="nom">Nom complet</label>
                                                                <input type="text" class="form-control mb-4" id="nom" placeholder="Nom complet" value="<?=$user[0]["nom_complet"]?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control mb-4" id="email" placeholder="Email" value="<?=$user[0]["email"]?>" >
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="password">Mot de passe</label>
                                                                <input type="password" class="form-control mb-4" id="password" placeholder="mot de passe" value="<?=$user[0]["password"]?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="country">Status</label>
                                                                <select class="form-control" id="status">
                                                                    <?php foreach ($statuses as $statut)
                                                                    {
                                                                    ?>
                                                                        <option value="<?=$statut['id']?>"><?=$statut['nom']?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="country">Domaine</label>
                                                                   <select class="form-control" id="domain">
                                                                    <?php foreach ($domaines as $domaine)
                                                                    {
                                                                    ?>
                                                                        <option value="<?=$domaine['id']?>"><?=$domaine['nom']?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="formation">Formation</label>
                                                                <input type="text" class="form-control mb-4" id="formation" placeholder="formation" value="<?=$user[0]["formation"]?>">
                                                            </div>
                                                        </div>
                                                        
                                                        <input type="hidden" name="id" id="id" class="form-control" value="<?=$id?>">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-settings-footer">
                        
                        <div class="as-footer-container">

                            <button id="multiple-reset" class="btn btn-primary">Reinitialiser</button>
                            <div class="blockui-growl-message">
                                <i class="flaticon-double-check"></i>&nbsp; Enregistré avec succès
                            </div>
                            <button id="signin" class="btn btn-dark">Enregistrer</button>

                        </div>

                    </div>
                </div>
            </div>
<?php
    $content = ob_get_clean();
    require_once "includes/template.php";
?>
<script src="public/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="public/plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js"></script>
<script src="public/plugins/notification/snackbar/snackbar.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!--  BEGIN CUSTOM SCRIPTS FILE  -->
<script src="public/assets/js/components/notification/custom-snackbar.js"></script>
<script src="public/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="public/plugins/sweetalerts/custom-sweetalert.js"></script>
<script>
    $("#signin").click(function(e) {
        e.preventDefault();
        var i = 0;
        $(".field").each(function(index, element) {

            if (!$(this).val()) {
                $(this).removeClass("form-control champ").addClass("form-control is-invalid champ");
                i++;
            } else {
                if ($(this).attr("type") === "email") {
                    if ($(this).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                        $(this).removeClass("form-control champ").addClass("form-control is-invalid champ");
                        $("#err").removeClass('valid-feedback').addClass('invalid-feedback mb-4');
                        $("#err").text("Adresse email invalide");
                        i++;
                    }
                } else $(this).removeClass("form-control is-invalid champ").addClass("form-control is-valid champ");
            }

        });
        if (i > 0) {
            Snackbar.show({
                text: "Veuillez compléter tous les champs",
                pos: 'top-right'
            });
        } else {
            var nom = $("#nom").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var status = $("#status").val();
            var domain = $("#domain").val();
            var formation = $("#formation").val();
            var id = $("#id").val();

            $.post("controllers/utilisateurs.php", {
                    nom_complet: nom,
                    email: email,
                    login: email,
                    password: password,
                    categorie_id: status,
                    domaine_id: domain,
                    formation: formation,
                    id: id,
                    action: "update"
                },
                function(data, textStatus, jqXHR) {
                    if (jqXHR.done()) {
                        if (data !== "okay") {
                            Snackbar.show({
                                text: "Erreur : verifier les données ",
                                pos: 'top-right'
                            });

                        } else {
                            location.href = 'users';
                        }
                    } else {
                        Snackbar.show({
                            text: textStatus,
                            pos: 'top-right'
                        });
                    }
                }
            );
        }

    });
</script>