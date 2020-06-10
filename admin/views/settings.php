<?php
ob_start();
?>
<link rel="stylesheet" type="text/css" href="public/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
<link href="public/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
<link href="public/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
<script src="public/plugins/sweetalerts/promise-polyfill.js"></script>
<link href="public/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="public/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="public/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<div id="content" class="main-content">
    <div class="container">
        <div class="container">
            <div class="row">
                <div id="card_1" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Contraintes de validation</h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="demo1">Minimum Available</label>
                                        <input id="min" type="text" value="10" name="demo1">
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="demo1">Maximum Available</label>
                                        <input id="max" type="text" value="50" name="demo1">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-lg mb-4 mr-3" id="maxmin">
                                <svg style="display: none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  
                                <span>
                                    Valider
                                </span>
                            </button>
                        </div>                    
                    </div>
                </div>
                <div id="card_2" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Card 2</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="demo1">Moyenne minimum</label>
                                        <input id="moymin" type="text" value="10" name="demo1">
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="demo1">Moyenne maximum</label>
                                        <input id="moymax" type="text" value="50" name="demo1">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-lg mb-4 mr-3" id="maxmoy">
                                <svg style="display: none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  
                                <span>
                                    Valider
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$content = ob_get_clean();
require_once 'includes/template.php';
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
    $("#min, #max, #moymin, #moymax").TouchSpin({
        postfix: '%'
    });
    $(document).ready(function () {
        $("#maxmin").click(function (e) { 
            e.preventDefault();
            var min = parseFloat($("#min").val());
            var max = parseFloat($("#max").val());
            send_datas(max, min, "pondered", $(this));
        });

        $("#maxmoy").click(function (e) { 
            e.preventDefault();
            var min = parseFloat($("#moymin").val());
            var max = parseFloat($("#moymax").val());
            send_datas(max, min, "moyenne", $(this));
        });

        function send_datas(max, min, option, selecteur){
            $val = selecteur.attr('id');
            $("#"+$val).last().attr("id", "msg");
            $("#"+$val).first().addClass("active");
            if (min && max) {
                if (min < max) {
                    $(".active").show();
                    $("#msg").text("chargement");
                    $("#"+$val).attr("disabled", "disabled");
                    $.post("controllers/settings.php", {min: min, max: max, option: option},
                        function (data, textStatus, jqXHR) {
                            if (jqXHR.done()) {
                                if (data === "saved") {
                                    $(".active").hide();
                                    $("#msg").text("Valider");
                                    $("#"+$val).removeAttr("disabled");
                                     swal({
                                        title: 'Succès!',
                                        text: "Enregistré avec succès!",
                                        type: 'success',
                                        padding: '2em'
                                    });
                                    setTimeout( function(){
                                        location.reload() 
                                    }, 2000);
                                }
                                else{
                                    $(".active").hide();
                                    $("#msg").text("Valider");
                                    $("#"+$val).removeAttr("disabled");
                                    Snackbar.show({
                                        text: data,
                                        pos: 'top-right'
                                    });
                                }
                            }else{
                                $(".active").hide();
                                $("#msg").text("Valider");
                                $("#"+$val).removeAttr("disabled");
                                Snackbar.show({
                                    text: textStatus,
                                    pos: 'top-right'
                                });
                            }                    
                        }
                    );
                }
                else{
                    Snackbar.show({
                        text: "le minimum ne doit pas depasser le maximum",
                        pos: 'top-right'
                    });
                }
            }
            else{
                Snackbar.show({
                    text: "Veuillez compléter tous les champs",
                    pos: 'top-right'
                });
            }
        }
    });
</script>