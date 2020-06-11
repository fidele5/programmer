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
                                            <td><?=$course["designation"]?></td>
                                            <td><?=$course["nom"]?></td>
                                            <td><?=$course["details"]?></td>
                                            <td><?=$course["volhoraire"]?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-dark btn-sm">Actions</button>
                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference4">
                                                      <a class="dropdown-item" href="edit-<?=$course['id']?>">modifier</a>
                                                      <a class="dropdown-item" href="delete-<?=$course['id']?>">Supprimer</a>
                                                    </div>
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
$content = ob_get_clean();
require_once 'includes/template.php';
?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="public/plugins/table/datatable/datatables.js"></script>
    <script src="public/plugins/table/datatable/custom_miscellaneous.js"></script>