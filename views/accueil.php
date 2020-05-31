<?php
ob_start();
if (isset($_SESSION['voted'])) {
    // echo "<pre>";
    // print_r($_SESSION['voted']);
    // echo "</pre>";
}
// session_destroy();
?>
<style>
.contenu {
  background: rgba(255,255,255,0.7);
}

#cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;

}


div#loader {
  position:fixed;
    /*width:100%;*/
    left:0;right:0;top:0;bottom:0;
  margin-top: 50vh;
  text-align: center;
  width: inherit;
  height: inherit;
  /*margin-left: auto;
  margin-right: auto; */
  z-index:9999;
}

@keyframes juggler {
  0% {
    transform: translateX(0px) translateY(0px);
  }
  12.5% {
    transform: translateX(-20px) translateY(40px) scale(1.1);
  }
  25% {
    transform: translateX(-40px) translateY(0px);
  }
  37.5% {
    transform: translateX(-20px) translateY(-40px);
  }
  50% {
    transform: translateX(0px) translateY(0px);
  }
  62.5% {
    transform: translateX(20px) translateY(40px) scale(1.1);
  }
  75% {
    transform: translateX(40px) translateY(0px);
  }
  87.5% {
    transform: translateX(20px) translateY(-40px);
  }
  100% {
    transform: translateX(0px) translateY(0px);
  }
}

span.ball {
  position: absolute;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  animation: juggler 1.8s linear infinite;
}
span.ball:nth-child(1) {
  background: radial-gradient(ellipse at center, #c52214 0%,#da3628 100%);
  animation-delay: -0.6s;
}
span.ball:nth-child(2) {
  background: radial-gradient(ellipse at center, #306ed6 0%,#4285f4 100%);
  animation-delay: -1.2s;
}
span.ball:nth-child(3) {
  background: radial-gradient(ellipse at center, #d29d04 0%,#fbbc05 100%);
}
.bc-icons-2 .breadcrumb-item + .breadcrumb-item::before {
content: none; }
.bc-icons-2 .breadcrumb-item.active {
color: #455a64; }
</style>
<div class='container my-5 py-5 z-depth-1'>
   <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
        <!--Grid row-->
        <div class="cover" style="display: none">
            <div id="cover-spin"></div>
            <div id="loader">
                <span class="ball"></span>
                <span class="ball"></span>
                <span class="ball"></span>
            </div>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb indigo lighten-4">
                <li class="breadcrumb-item" <?=($page == "prepa") ? 'active text-default' : ""?>><a class="black-text" href="prepa">Prepa</a><i class="fas fa-caret-right mx-2"
                    aria-hidden="true"></i></li>
                <li class="breadcrumb-item <?=($page == "G1") ? 'active text-default' : ""?>"><a class="black-text" href="G1">G1</a><i class="fas fa-caret-right mx-2"
                    aria-hidden="true"></i></li>
                <li class="breadcrumb-item <?=($page == "G2") ? 'active text-default' : ""?>">G2</li>
                <li class="breadcrumb-item <?=($page == "G3") ? 'active text-default' : ""?>"><a class="black-text" href="G3">G3</a><i class="fas fa-caret-right mx-2"
                    aria-hidden="true"></i></li>
            </ol>
        </nav>
        <?php
        function is_checked($id)
        {
            if (isset($_SESSION['voted'])) {
                foreach ($_SESSION['voted'] as $value) {
                    foreach ($value as $val) {
                        for ($j = 0; $j < count($val); $j++) {
                            if (in_array($id, $val[$j])) {
                                return true;
                            }
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
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <?php
                        if (isset($_GET['action'])) {?>
                    <button id="reset" class="btn btn-amber">Modifier pour <?=$page?></button>
                    <?php
                        }
                        foreach ($categories as $cle => $valeur) {
                                    ?>
                    <div class="card card-form-2 mb-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold">
                                <?=$icons[$valeur['nom']]?>
                                <?=$valeur['nom']?>
                            </h6>
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
                    <?php
                                }
                    ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="justify-content-center">
                    <button id="next" page="<?=$page?>"  class="btn btn-outline-secondary" type="button">
                        <?php
                            if ($page == "G3" || $page == "L3") {
                        ?>
                        <i class="fa fa-check" aria-hidden="true"></i>
                        Terminer
                        <?php
                            } else {
                        ?>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        G<?=($page != "prepa" || $page != "accueil") ? (int) $page[1] + 1 : 1?>
                        <?php
                            }
                        ?>
                    </button>
                    <button id="back" class="btn btn-outline-primary back" type="button" <?=($page != "prepa" || $page != "accueil") ? "" : "disabled"?>>
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Retour
                    </button>
                    <button class="btn btn-outline-dark" type="button" data-toggle="modal" data-target="#modalRegisterForm">
                        <i class="fa fa-plus" aria-hidden="true"></i> Suggerer
                    </button>
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalCart">
                        <i class="fa fa-eye" aria-hidden="true"></i> Preview
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
                            $.each(valeur, function (index, value) {
                                console.log(value)
                                $(".form-check-input").each(function (index, element) {
                                    if (value.id == $(this).attr("valeur")) {
                                        if ($(this).prop('disabled')) {
                                            if (key =="prepa") {
                                                $(this).parent().find("label").append("<span class='text-success'><small><i> Selectionné pour "+key+"</i></small></span>");
                                            }
                                            else if (key == "G1") {
                                                $(this).parent().find("label").append("<span class='text-default'><small><i> Selectionné pour "+key+"</i></small></span>");
                                            }
                                            else if (key =="G2") {
                                                $(this).parent().find("label").append("<span class='text-warning'><small><i> Selectionné pour "+key+"</i></small></span>");
                                            }
                                            else if (key == "G3") {
                                                $(this).parent().find("label").append("<span class='text-danger'><small><i> Selectionné pour "+key+"</i></small></span>");
                                            }
                                        }
                                    }

                                });
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
                location . assign("prepa"+"-reset");
            }
            else location.assign(prev+"-reset");
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

        $("#reset").click(function (e) {
            e.preventDefault();
            var tableau = {};
            $.getJSON("views/json_data.php",
                function (data, textStatus, jqXHR) {
                    $.each(data, function (cle, val) {
                        $.each(val, function (key, valeur) {
                            if (key == "<?=$page?>") {
                                $.each(valeur, function (index, value) {
                                    console.log(value)
                                    $(".form-check-input").each(function (index, element) {
                                        if (value.id == $(this).attr("valeur")) {
                                            if ($(this).prop('disabled')) {
                                                $(this).removeAttr("disabled");
                                            }
                                        }

                                    });
                                });
                            }
                        });
                    });
                }
            );

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
   

</script>