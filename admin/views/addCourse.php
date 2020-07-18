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
                                            <h5 class="">Ajouter un cours</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="intitule">Intitulé</label>
                                                                <input type="text" class="form-control field mb-4" name="intitule" id="intitule" placeholder="Intitule">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="volhor">Volume horaire</label>
                                                                <input type="text" class="form-control field mb-4" name="volhor" id="volhor" placeholder="Volume horaire">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="country">Promotion</label>
                                                                <select class="form-control field" name="promotion" id="promotion">
                                                                    <?php foreach ($promotions as $promotion) {?>
                                                                        <option value="<?=$promotion['id']?>"><?=$promotion['designation']?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="categorie">Categorie</label>
                                                                   <select class="form-control field" name="categorie" id="categorie">
                                                                    <?php foreach ($categories as $categorie) {?>
                                                                        <option value="<?=$categorie['id']?>"><?=$categorie['nom']?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="details">Details</label>
                                                                <textarea class="form-control field" id="details" name="details" placeholder="Details sur le cours"></textarea>
                                                            </div>
                                                        </div>
                                                        <input class="form-control" type="hidden" name="action" value="add">
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
                $(this).addClass("is-invalid");
                i++;
            } else {
                $(this).removeClass("is-invalid").addClass("is-valid");
            }

        });
        if (i > 0) {
            Snackbar.show({
                text: "Veuillez compléter tous les champs",
                pos: 'top-right'
            });
        } else {
            var fields = $('#contact').serialize();
            $.ajax({
                type: "POST",
                url: "controllers/cours.php",
                data: fields,
                success: function (data) {
                    if (data !== "ok") {
                        console.log(data);
                        Snackbar.show({
                            text: "Erreur : verifier les données ",
                            pos: 'top-right'
                        });
                    } else {
                        location.href = 'courses';
                    }
                       
                },
                error: function (param) {
                    Snackbar.show({
                        text: param,
                        pos: 'top-right'
                    });
                }
            });
        }

    });
</script>