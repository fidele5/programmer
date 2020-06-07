<?php
ob_start();
?>
<link href="public/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<link href="public/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
<link href="public/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
<script src="public/plugins/sweetalerts/promise-polyfill.js"></script>
<link href="public/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="public/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="public/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="container">
                <div class="container">
                    <div id="fuSingleFile" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Charger les Utilisateurs</h4>
                                        
                                    </div>
                                </div>
                            </div>
                            <form id="form" method="post" action="controllers/utilisateurs.php" enctype="multipart/form-data">
                                <div class="widget-content widget-content-area">
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Upload (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" id="fichier" class="custom-file-container__custom-file__custom-file-input" accept="*" name="programme">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <input type="hidden" name="action" value="ajouter" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                </div>
                                <input type="submit" name="txt" class="mt-4 btn btn-primary">
                                <div class="progress br-30 mt-2">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 0%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
$content = ob_get_clean();
require_once 'includes/template.php';
?>
<script src="public/plugins/file-upload/file-upload-with-preview.min.js"></script>
<script src="public/jquery.form.js"></script>
<script src="public/plugins/notification/snackbar/snackbar.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!--  BEGIN CUSTOM SCRIPTS FILE  -->
<script src="public/assets/js/components/notification/custom-snackbar.js"></script>
<script src="public/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="public/plugins/sweetalerts/custom-sweetalert.js"></script>
<!--  END CUSTOM SCRIPTS FILE  -->

<script>
    //First upload
    var firstUpload = new FileUploadWithPreview('myFirstImage')
    //Second upload
    var secondUpload = new FileUploadWithPreview('mySecondImage')
</script>
    <!-- END PAGE LEVEL PLUGINS -->
<script>
    $(document).ready(function () {
        $("#form").submit(function (e) {
            e.preventDefault();
            if ($("#fichier").val()) {
                $(this).ajaxSubmit({
                    beforeSubmit:function(){
                        $(".progress-bar").width("0%");
                    },
                    uploadProgress:function(event, position, total, percentageComplete) {
                        $('.progress-bar').animate({
                            width: percentageComplete + '%'
                        },{
                            duration: 1000
                        });
                        $(".progress-bar").text(percentageComplete + "%");
                    },
                    success:function(data, textStatus, jqXHR) {
                        if (data == "ok") {
                            swal({
                                title: 'Succès!',
                                text: "Utilisateurs enregistrés avec succès!",
                                type: 'success',
                                padding: '2em'
                            })
                            //location.reload();
                        }
                        else {
                             Snackbar.show({
                                text: data,
                                pos: 'top-right'
                            });
                        }
                    },
                    resetForm: true
                });
            }
            else{
                Snackbar.show({
                    text: 'Veuillez selectionner un fichier.',
                    pos: 'top-right'
                });
            }
        })
    });
</script>