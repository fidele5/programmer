<?php
ob_start();
// if (isset($_SESSION['voted'])) {
//     echo "<pre>";
//     print_r($_SESSION['voted']);
//     echo "</pre>";
// }
// echo $_SESSION['id'];
//session_destroy();
?>
<div class='container my-5 py-5 z-depth-1'>
   <section class="px-md-5 mx-md-5 text-lg-left dark-grey-text">
        <!--Grid row-->
        <div class="cover" style="display: none">
            <div id="cover-spin"></div>
            <div id="loader">
                <span class="ball"></span>
                <span class="ball"></span>
                <span class="ball"></span>
            </div>
        </div>
        <div class="text-center">
            <div class="breadcrumb text-center">
                <a class="breadcrumb__step <?=($page == "prepa" || $page == "accueil") ? 'breadcrumb__step--active page' : ""?>" href="prepa">Prepa</a>
                <a class="breadcrumb__step <?=($page == "G1") ? 'breadcrumb__step--active page' : ""?>" href="G1">G1</a>
                <a class="breadcrumb__step <?=($page == "G2") ? 'breadcrumb__step--active page' : ""?>" href="G2">G2</a>
                <a class="breadcrumb__step <?=($page == "G3") ? 'breadcrumb__step--active page' : ""?>" href="G3">G3</a>
            </div>
        </div>
        <div class="progress md-progress" style="height: 20px">
            <div class="progress-bar" role="progressbar" style="width: 0%; height: 20px" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row d-flex justify-content-center contenu">
            <!-- Material form register -->
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <div class="card card-image"
                    style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">

                    <!-- Content -->
                    <div class="rgba-black-strong py-5 px-4">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 col-xl-12">

                                <!--Accordion wrapper-->
                                <div class="accordion md-accordion accordion-5" id="accordionEx5" role="tablist"
                                    aria-multiselectable="true">
                                    <?php foreach ($categories as $cle => $valeur) {?>
                                    <!-- Card -->
                                    <!-- Accordion card -->
                                    <div class="card card-form-2 mb-4">
                                        <!-- Card header -->
                                        <div class="card-header p-0 z-depth-1" role="tab" id="heading3<?=$cle?>">
                                            <a data-toggle="collapse" data-parent="#accordionEx5" href="#collapse3<?=$cle?>" aria-expanded="true"
                                                aria-controls="collapse3<?=$cle?>">
                                                <?=$icons[$valeur['nom']]?>
                                                <h4 class="white-text mb-0 py-3 mt-1">
                                                <?=$valeur['nom']?>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapse3<?=$cle?>" class="collapse <?=($cle == 0) ? "show" : ""?>" role="tabpanel" aria-labelledby="heading3<?=$cle?>"
                                                data-parent="#accordionEx5">
                                            <div class="card-body rgba-black-light white-text z-depth-1 justify-content-start">
                                                <?php foreach ($cour->select_by_category($valeur['id']) as $key => $value) {?>
                                                <!--  checkbox -->
                                                <div class="form-check pl-0">
                                                    <input type="checkbox" class="form-check-input" id="filledInCheckbox<?=$value['id']?>" volume="<?=$value['volhoraire']?>"  valeur="<?=$value['id']?>" <?=(is_checked($value['id'])) ? "disabled checked" : ""?>>
                                                    <label class="form-check-label" for="filledInCheckbox<?=$value['id']?>"><?=$value['intitule']?></label>
                                                     &nbsp;[ <a href="#" class="text-info" data-toggle="modal" data-target="#details<?=$value['id']?>">details</a> ]
                                                     <?php include"details.php";?>
                                                </div>
                                                <!--  checkbox -->
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                    <!-- accordeon card -->
                                </div>
                                <!--/.Accordion wrapper-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="justify-content-center">
                    <button id="next" page="<?=$page?>"  class="btn btn-outline-secondary" type="button">
                        <?php if ($page == "G3" || $page == "L3") {?>
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <span class="clearfix d-none d-md-inline-block">
                        Terminer
                        </span>
                        <?php } else {?>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <span class="clearfix d-none d-md-inline-block">
                        G<?=($page != "prepa" || $page != "accueil") ? (int) $page[1] + 1 : 1?>
                        </span>
                        <?php }?>
                    </button>
                    <button id="back" class="btn btn-outline-primary back" page='<?=$page[1]?>' type="button" <?=($page != "prepa" || $page != "accueil") ? "" : "disabled"?>>
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        <span class="clearfix d-none d-md-inline-block">
                        Retour
                        </span>
                    </button>
                    <button class="btn btn-outline-dark" type="button" data-toggle="modal" data-target="#modalRegisterForm">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="clearfix d-none d-md-inline-block">
                             Suggerer
                        </span>
                    </button>
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalCart">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <span class="clearfix d-none d-md-inline-block">
                             Preview
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <?php require_once "preview.php";?>
    </section>
</div>
<?php $content = ob_get_clean();
require_once 'includes/template.php';
?>