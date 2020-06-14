<?php
ob_start();
?>
    <link rel="stylesheet" type="text/css" href="public/plugins/table/datatable/custom_dt_miscellaneous.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="public/plugins/table/datatable/dt-global_style.css">
    <script src="public/plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="public/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="public/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="public/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="public/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Liste detaillée des cours votés</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <table id="individual-col-search" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Intitule</th>
                                            <th>Promotion</th>
                                            <th>Filiere</th>
                                            <th>Details</th>
                                            <th>Volume horaire</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
foreach ($courses as $num => $course) {
    ?>
                                        <tr>
                                            <td class="text-center"><?=$num + 1?></td>
                                            <td><?=$course["intitule"]?></td>
                                            <td class="selectable promotion"><?=$course["designation"]?></td>
                                            <td class="filiere"><?=$course["nom"]?></td>
                                            <td><?=$course["details"]?></td>
                                            <td><?=$course["volhoraire"]?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a id="<?=$course['id']?>" class="btn btn-outline-primary btn-sm edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </a>
                                                    <a id="<?=$course['id']?>" class="btn btn-outline-danger btn-sm warning confirm">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete Permanently" class="feather feather-trash permanent-delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                    </a>
                                                  </div>
                                            </td>
                                        </tr>
                                        <?php
}
?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Intitule</th>
                                            <th>Promotion</th>
                                            <th>Filiere</th>
                                            <th>Details</th>
                                            <th>Volume horaire</th>
                                            <th class="invisible"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once "modals.php";
?>
<?php
$content = ob_get_clean();
require_once 'includes/template.php';
?>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="public/plugins/table/datatable/datatables.js"></script>
    <script src="public/plugins/table/datatable/custom_miscellaneous.js"></script>
    <script src="public/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script src="public/plugins/sweetalerts/custom-sweetalert.js"></script>
    <!-- END THEME GLOBAL STYLE -->
    <script>
    $(document).ready(function () {
        $('.widget-content .warning.confirm').on('click', function (e) {
        e.preventDefault();
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            padding: '2em'
            }).then(function() {
                var id = $(".warning.confirm").attr("href");
                console.log(id);
                $.post("controllers/cours.php", {id: id, action: "delete"},
                    function (data, textStatus, jqXHR) {
                        if (jqXHR.done()) {
                            if (data != "deleted") {
                                swal(
                                {
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    type: 'success'
                                });
                                setTimeout(() => {
                                    location.reload(true);
                                }, 2000);
                            }
                        }
                    }
                );
            })
        });

        $(".edit").click(function (e) {
            e.preventDefault();
            console.log($(this).parent().parent().siblings());
            $(this).parent().parent().attr('id', 'actions');
            $(this).parent().parent().siblings().addClass('editable');

            var id = $(this).attr("id");

            $(".editable").each(function (index, element) {
                var val = $(this).text();
                if ($(this).hasClass("selectable promotion")) {
                    $(this).html(
                        "<select size='1' class='form-control champs' id='promotion'>"+
                            '<option value="prepa">'+
                                "prepa"+
                            "</option>"+
                            '<option value="G1">'+
                                "G1"+
                            '</option>'+
                            '<option value="G2">'+
                                "G2"+
                            '</option>'+
                            ' <option value="G3">'+
                                "G3"+
                            "</option>"+

                        "</select>");
                }else if($(this).hasClass("filiere")){
                    $(this).html("<input type='text' class='form-control' value='"+val+"' id='field"+index+"' disabled>");
                }
                else if ($(this).hasClass("text-center")) {
                    $(this).html("<input type='text' class='form-control' value='"+val+"' id='field"+index+"' disabled>");
                }
                else $(this).html("<input type='text' class='form-control champs' value='"+val+"' id='field"+index+"'>");
            });

            $(this).hide();
            $("#delete").hide();
            $('#actions').html('<a id="save"></a>');
            $("#save").addClass('btn btn-outline-info m-0 waves-effect');
            $("#save").html('Save');
            $('#save').click(function (e) {
                e.preventDefault();
                var fields = [];
                var reponse = {};

                $(".champs").each(function (index, element) {
                    fields.push($(this).val());
                });
                $.post("controllers/cours.php",
                    {
                        action: 'modifier',
                        id: id,
                        champs: fields
                    },
                    function (data, textStatus, jqXHR) {
                        if (jqXHR.done()) {
                            if (data === "ok") {
                                swal({
                                    type: 'success',
                                    title: 'Terminé',
                                    text: "Enregistrement effectué avec succès"

                                });
                                setTimeout(() => {
                                    location . reload(true);
                                }, 2000);
                            }
                            else {
                                swal.insertQueueStep({
                                    type: 'error',
                                    title: "Impossible d'effectuer la modification"
                                });
                            }
                        }
                        else {
                            swal.insertQueueStep({
                                type: 'error',
                                title: textStatus
                            });
                        }
                    }
                );
            });
        });
    });

    </script>