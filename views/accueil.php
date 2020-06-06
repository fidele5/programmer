<?php
ob_start();
if (isset($_SESSION['voted'])) {
     /* echo "<pre>";
    print_r($_SESSION['voted']);
     echo "</pre>"; */
}
// session_destroy();
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
                <a class="breadcrumb__step <?=($page == "prepa" || $page == "accueil") ? 'breadcrumb__step--active' : ""?>" href="prepa">Prepa</a>
                <a class="breadcrumb__step <?=($page == "G1") ? 'breadcrumb__step--active' : ""?>" href="G1">G1</a>
                <a class="breadcrumb__step <?=($page == "G2") ? 'breadcrumb__step--active' : ""?>" href="G2">G2</a>
                <a class="breadcrumb__step <?=($page == "G3") ? 'breadcrumb__step--active' : ""?>" href="G3">G3</a>
            </div>
        </div>
        <?php
function is_checked($id)
{
    if (isset($_SESSION['voted'])) {
        foreach ($_SESSION['voted'] as $value) {
            foreach ($value as $val) {
                if (in_array($id, $val)) {
                    return true;
                }
            }
        }
    } else {
        return false;
    }

}
?>
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
                                    <?php
foreach ($categories as $cle => $valeur) {
    ?>
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
                                                <?php
foreach ($cour->select_by_category($valeur['id']) as $key => $value) {
        ?>
                                                <!--  checkbox -->
                                                <div class="form-check pl-0">
                                                    <input type="checkbox" class="form-check-input" id="filledInCheckbox<?=$value['id']?>" volume="<?=$value['volhoraire']?>"  valeur="<?=$value['id']?>" <?=(is_checked($value['id'])) ? "disabled checked" : ""?>>
                                                    <label class="form-check-label" for="filledInCheckbox<?=$value['id']?>"><?=$value['intitule']?></label>
                                                </div>
                                                <!--  checkbox -->
                                                <?php
}
    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
}
?>
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
                        <?php
if ($page == "G3" || $page == "L3") {
    ?>
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <span class="clearfix d-none d-md-inline-block">
                        Terminer
                        </span>
                        <?php
} else {
    ?>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <span class="clearfix d-none d-md-inline-block">
                        G<?=($page != "prepa" || $page != "accueil") ? (int) $page[1] + 1 : 1?>
                        </span>
                        <?php
}
?>

                    </button>
                    <button id="back" class="btn btn-outline-primary back" type="button" <?=($page != "prepa" || $page != "accueil") ? "" : "disabled"?>>
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

        <?php
require_once "preview.php";
?>

    </section>
</div>
<?php $content = ob_get_clean();
require_once 'includes/template.php';
?>
<script>
    $(document).ready(function () {

        $.getJSON("views/json_data.php",
                function (data, textStatus, jqXHR) {
                    $.each(data, function (cle, val) {
                        $.each(val, function (key, valeur) {
                            console.log(cle)
                            $(".form-check-input").each(function (index, element) {
                                if (valeur.id == $(this).attr("valeur")) {
                                    if ($(this).prop('disabled')) {
                                        if (cle === "<?=$page?>") {
                                           $(this).removeAttr("disabled");
                                        }
                                        if (cle =="prepa") {
                                            $(this).parent().find("label").append("<span class='text-success'><small><i> Selectionné pour "+cle+"</i></small></span>");
                                        }
                                        else if (cle == "G1") {
                                            $(this).parent().find("label").append("<span class='text-default'><small><i> Selectionné pour "+cle+"</i></small></span>");
                                        }
                                        else if (cle =="G2") {
                                            $(this).parent().find("label").append("<span class='text-warning'><small><i> Selectionné pour "+cle+"</i></small></span>");
                                        }
                                        else if (cle == "G3") {
                                            $(this).parent().find("label").append("<span class='text-danger'><small><i> Selectionné pour "+cle+"</i></small></span>");
                                        }
                                    }
                                }
                            });
                        });
                    });
                }
            );

        var val = 0;
        var pourc = 0;
        $(".form-check-input").change(function (e) {
            e.preventDefault();
            if ($(this).is(":checked")) {
                val = val + parseInt($(this).attr("volume"));
                valeur = val/2000;
                pourc = valeur*100;

                if (pourc > 25 && pourc <=50) {
                    $(".progress-bar").addClass("bg-success");
                }
                else if (pourc > 50 && pourc <=75) {
                    $(".progress-bar").addClass("bg-warning");
                }
                else if (pourc > 75 && pourc <=100) {
                    $(".progress-bar").addClass("bg-danger");
                }

                $(".progress-bar").animate({width: pourc+"%"});
                $(".progress-bar").html(val+"h");
            }
            else {
                val = val - parseInt($(this).attr("volume"));
                valeur = val/2000;
                pourc = valeur*100;

                if (pourc > 25 && pourc <=50) {
                    $(".progress-bar").addClass("bg-success");
                }
                else if (pourc > 50 && pourc <=75) {
                    $(".progress-bar").addClass("bg-warning");
                }
                else if (pourc > 75 && pourc <=100) {
                    $(".progress-bar").addClass("bg-danger");
                }

                $(".progress-bar").animate({width: pourc+"%"});
                $(".progress-bar").html(val+"h");
            }

            if (pourc >= 50) {
                toastr.warning("Vous avez depassé le volume horaire prévu");
                $(".form-check-input").each(function (index, element) {
                    if (!$(this).is(":checked")) {
                        $(this).attr("disabled", 'disabled');
                    }
                });
            }
            else {
                $(".form-check-input").each(function (index, element) {
                    if (!$(this).is(":checked")) {
                        $(this).removeAttr('disabled');
                    }
                });
            }
        });

        $("#next").click(function (e) {
            e.preventDefault();
            var itemArray = [];
            $(".form-check-input").each(function(){
                if($(this).is(":checked") && !$(this).prop("disabled")){
                   itemArray.push({label: $(this).parent().find("label").html(), state: $(this).val(), id: $(this).attr("valeur")});
                }
            });
            var page = $(this).attr("page");
            var i = 1;
            if ($(this).attr("page") == "prepa" || $(this).attr("page") == "accueil") {
                var next = "G"+i;
                page = "prepa";
            }
            else{
                var next = "G"+ (parseInt(<?=$page[1]?>)+1);
            }

            $(".cover").fadeIn("slow");
            if (itemArray.length == 0) {
                itemArray = "empty";
            }
            $.post("controllers/votes.php", {data:itemArray, action:"next", promotion: page},
                function (data, textStatus, jqXHR) {
                    if(jqXHR.done()){
                        if (data == "okay") {
                            $(".cover").delay(2500).fadeOut(1600 ,function() {
                                if (next=="G4") {
                                    $('#modalCart').modal('show');
                                    toastr.info("Terminé");
                                }
                                else location.href = next;
                            });

                        }
                        else{
                            toastr.warning(data);
                        }
                    }
                    else if (jqXHR.fail()) {
                        toastr.warning("La requête n'a pas abouti veuillez réesayer");
                    }
                    else if (jqXHR.error()) {
                        toastr.warning(textStatus);
                    }
                }
            );
        });

        $("#back").click(function (e) {
            e.preventDefault();
            var prev = "G"+ (parseInt(<?=$page[1]?>)-1);
            if(prev == "G0"){
                location . assign("prepa");
            }
            else location.assign(prev);
        });

        $("#valider").click(function (e) {
            e.preventDefault();
                $.post("controllers/votes.php", {action: "ajouter"},
                    function (data, textStatus, jqXHR) {
                        if (data == "ok") {
                            location.reload(true);
                        }
                });
        });


        $("#plus").click(function (e) {
            e.preventDefault();
            var field = $("#content").html();

            $(".parent").append(field);

            var size = $(".field").length;

            if (size >= 3) {
                $(this).attr("disabled", "disabled");
            }
        });

        $("#suggest").click(function (e) {
            e.preventDefault();
            var elements = [];
            var elt = "";
            var hours = 0;
            $(".champs").each(function (index, element) {
                if ($(this).prop("tagName") == "INPUT") {
                    elt = $(this).val();
                }
                else{
                    elements.push({intitule: elt, volume: $(this).val()})
                    hours+= parseInt($(this).val());
                }
            });

            val+= hours;
            valeur = val/2000;
            pourc = valeur*100;

            if (pourc > 25 && pourc <=50) {
                $(".progress-bar").addClass("bg-success");
            }
            else if (pourc > 50 && pourc <=75) {
                $(".progress-bar").addClass("bg-warning");
            }
            else if (pourc > 75 && pourc <=100) {
                $(".progress-bar").addClass("bg-danger");
            }

            $(".progress-bar").animate({width: pourc+"%"});
            $(".progress-bar").html(val+"h");

            if (pourc >= 50) {
                toastr.warning("Vous avez depassé le volume horaire prévu");
                $("#suggest").attr("disabled", "disabled");
            }
            else {
                $("#suggest").removeAttr('disabled');
                if(elements.length == 0){
                    toastr.warning("Veuillez completer tous les champs");
                }
                else
                {
                    var i = 0;
                    $.each(elements, function (indexe, valeur) {
                        if (valeur.intitule === "" || valeur.volume === "Volume horaire") {
                            i++;
                        }
                    });

                    if (i > 0) {
                        toastr.warning("veuillez compléter tous les champs");
                    }
                    else{
                        var page = "<?=$page?>";
                        if(page === "accueil") {
                            page = "prepa";
                        }
                        $.post("controllers/cours.php",
                        {
                            data:elements,
                            action: 'ajouter',
                            promotion: page
                        },
                        function (data, textStatus, jqXHR) {
                            if (jqXHR.done()) {
                                if(data === "ok")
                                {
                                    $('#modalRegisterForm').modal('hide');
                                    toastr.info("Suggesttion enregistrée");
                                }
                                else{
                                    toastr.warning("Une erreur s'est produite veuillez réesayer");
                                }
                            }
                            else{
                                toastr.warning(textStatus);
                            }
                        });
                    }
                }
            }
        });

         var subjects = [
            "Laravel",
            "Symphony",
            "JQuery",
            "Angular",
            "React",
            "Vue",
            "Codeigniter",
            "CakePhp",
            "Django",
            "Arduino",
            "Ruby"
        ];

        $('#form-autocomplete-2').mdb_autocomplete({
            data: subjects
        });

    });

$(".breadcrumb__step").each(function (index, element) {
    if ($(this).hasClass("breadcrumb__step--active")) {
        return false;
    }
    else $(this).addClass("breadcrumb__step--active");    
});
</script>