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
?>
                    <div class="card card-form-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fa fa-code" aria-hidden="true"></i> Programmation</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox" volume="90"  valeur="1" <?=(is_checked(1)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox">Java</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check purple-checkbox pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox4" valeur="2" volume="90" <?=(is_checked(2)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox4">C#</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check blue-checkbox pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox1" valeur="3" volume="120" <?=(is_checked(3)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox1">PHP</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check teal-checkbox pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox2" valeur="4" volume="60" <?=(is_checked(4)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox2">JavaScript</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox3" valeur="5" volume="60" <?=(is_checked(5)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox3">C</label>
                            </div>
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox5" valeur="6" volume="60" <?=(is_checked(6)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox5">Python</label>
                            </div>
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox30" valeur="30" volume="60" <?=(is_checked(30)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox30">VBA</label>
                            </div>
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox31" volume="60" valeur="31" <?=(is_checked(31)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox31">Html/CSS</label>
                            </div>
                        </div>
                    </div>
                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fas fa-project-diagram"></i> Modelisation</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox6" volume="60"  valeur="6" <?=(is_checked(6)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox6">UML</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check purple-checkbox pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox7" valeur="7" volume="60" <?=(is_checked(7)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox7">Merise</label>
                            </div>
                        </div>
                    </div>
                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fa fa-database" aria-hidden="true"></i> Base des données</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox8" volume="45"  valeur="8" <?=(is_checked(8)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox8">SQL Server</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox9" volume="45" valeur="9" <?=(is_checked(9)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox9">Oracle</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox10" volume="30" valeur="10" <?=(is_checked(10)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox10">Mysql</label>
                            </div>

                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox29" volume="30" valeur="29" <?=(is_checked(29)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox29">Ms Access</label>
                            </div>
                        </div>
                    </div>
                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"> <i class="fas fa-network-wired"></i> Architecture Reseau</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox11" volume="60"  valeur="11" <?=(is_checked(11)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox11">TCP-IP</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox12" volume="60" valeur="12" <?=(is_checked(12)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox12">Windows Server</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox13" volume="60" valeur="13" <?=(is_checked(13)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox13">Linux</label>
                            </div>
                        </div>
                    </div>

                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fas fa-image"></i> Design</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox14" volume="30"  valeur="14" <?=(is_checked(14)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox14">Introduction au design</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox15" volume="45" valeur="15" <?=(is_checked(15)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox15">Photoshop</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox16" volume="60" valeur="16" <?=(is_checked(16)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox16">Photographie</label>
                            </div>
                        </div>
                    </div>

                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fa fa-wifi" aria-hidden="true"></i> Telecommunication</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox17" volume="45"  valeur="17" <?=(is_checked(17)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox17">Television</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox18" volume="45" valeur="18" <?=(is_checked(18)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox18">Communication satelite</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox19" valeur="19" volume="60" <?=(is_checked(19)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox19">Telephonie</label>
                            </div>
                        </div>
                    </div>

                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fa fa-calculator" aria-hidden="true"></i> Mathematiques</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox20" volume="60"  valeur="20" <?=(is_checked(20)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox20">Algèbre</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox21" volume="45" valeur="21" <?=(is_checked(21)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox21">Maths discrètes</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox22" volume="30" valeur="22" <?=(is_checked(22)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox22">Logique math</label>
                            </div>
                        </div>
                    </div>

                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fa fa-comment" aria-hidden="true"></i> Communication</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox23" volume="45" valeur="23" <?=(is_checked(23)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox23">EOE</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox24" volume="45" valeur="24" <?=(is_checked(24)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox24">Marketing</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox25" volume="45" valeur="25" <?=(is_checked(25)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox25">Leaderhip</label>
                            </div>
                        </div>
                    </div>

                    <div class="card card-form-2 mt-2">
                        <div class="card-body">
                            <h6 class="mt-2 mb-4 font-weight-bold"><i class="fas fa-chart-pie"></i> Management</h6>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox26" volume="90" valeur="26" <?=(is_checked(26)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox26">Comptabilite</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox27" volume="45" valeur="27" <?=(is_checked(27)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox27">Business Intellignce</label>
                            </div>
                            <!--  checkbox -->
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="filledInCheckbox28" volume="45" valeur="28" <?=(is_checked(28)) ? "disabled checked" : ""?>>
                                <label class="form-check-label" for="filledInCheckbox28">Gestion des budget</label>
                            </div>
                        </div>
                    </div>
                <!-- Material form register -->
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
            console.log($(".field").length);

            if (size >= 3) {
                $(this).attr("disabled", "disabled");
            }

            $("#suggest").click(function (e) {
                e.preventDefault();
                var elements = [];
                var elt = "";
                $(".champ").each(function (index, element) {
                    // elements.push({intitule: $(this).val() });
                    if ($(this).prop("tagName") == "INPUT") {
                        var elt = $(this).val()
                    }
                    else elements.push({intitule: elt, volume: $(this).val()})
                    console.log(elt + " " + $(this).prop("tagName"));
                });
                console.log(elements);
            });
        });
    });
</script>