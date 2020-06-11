<?php
ob_start();
?>
    <link rel="stylesheet" type="text/css" href="public/plugins/table/datatable/custom_dt_miscellaneous.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="public/plugins/table/datatable/dt-global_style.css">
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Details votes cours <?=$cour[0]['intitule']?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive mb-4">
                                <table id="individual-col-search" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nom</th>
                                            <th>Domaine</th>
                                            <th>Categorie</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($details as $num => $valeur) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?=$num + 1?></td>
                                            <td><?=$valeur["nom_complet"]?></td>
                                            <td><?=$valeur["domaine"]?></td>
                                            <td><?=$valeur["categorie"]?></td>
                                            <td class="text-center"><a href="javascript:void(0);" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nom</th>
                                            <th>Domaine</th>
                                            <th>Categorie</th>
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
$content = ob_get_clean();
require_once 'includes/template.php';
?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="public/plugins/table/datatable/datatables.js"></script>
    <script src="public/plugins/table/datatable/custom_miscellaneous.js"></script>