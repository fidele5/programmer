 $(document).ready(function() {
     var active = "prepa";
     $(".breadcrumb__step").each(function(index, element) {
         if ($(this).hasClass("page")) {
             active = $(this).attr("href");
         } else return;
     });
     $.getJSON("views/json_data.php",
         function(data, textStatus, jqXHR) {
             $.each(data, function(cle, val) {
                 $.each(val, function(key, valeur) {
                     console.log(cle);
                     $(".breadcrumb__step").each(function(a, b) {
                         if ($(this).attr('href') === cle) $(this).addClass('breadcrumb__step--active');
                         else return;
                     });
                     $(".form-check-input").each(function(index, element) {
                         if (valeur.id == $(this).attr("valeur")) {
                             if ($(this).prop('disabled')) {
                                 if (cle === active) {
                                     $(this).removeAttr("disabled");
                                 }
                                 if (cle == "prepa") {
                                     $(this).parent().find("label").append("<span class='text-success'><small><i> Selectionné pour " + cle + "</i></small></span>");

                                 } else if (cle == "G1") {
                                     $(this).parent().find("label").append("<span class='text-default'><small><i> Selectionné pour " + cle + "</i></small></span>");
                                 } else if (cle == "G2") {
                                     $(this).parent().find("label").append("<span class='text-warning'><small><i> Selectionné pour " + cle + "</i></small></span>");
                                 } else if (cle == "G3") {
                                     $(this).parent().find("label").append("<span class='text-danger'><small><i> Selectionné pour " + cle + "</i></small></span>");
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
     $(".form-check-input").change(function(e) {
         e.preventDefault();
         if ($(this).is(":checked")) {
             val = val + parseInt($(this).attr("volume"));
             valeur = val / 2000;
             pourc = valeur * 100;

             if (pourc > 25 && pourc <= 50) {
                 $(".progress-bar").addClass("bg-success");
             } else if (pourc > 50 && pourc <= 75) {
                 $(".progress-bar").addClass("bg-warning");
             } else if (pourc > 75 && pourc <= 100) {
                 $(".progress-bar").addClass("bg-danger");
             }

             $(".progress-bar").animate({
                 width: pourc + "%"
             });
             $(".progress-bar").html(val + "h");
         } else {
             val = val - parseInt($(this).attr("volume"));
             valeur = val / 2000;
             pourc = valeur * 100;

             if (pourc > 25 && pourc <= 50) {
                 $(".progress-bar").addClass("bg-success");
             } else if (pourc > 50 && pourc <= 75) {
                 $(".progress-bar").addClass("bg-warning");
             } else if (pourc > 75 && pourc <= 100) {
                 $(".progress-bar").addClass("bg-danger");
             }

             $(".progress-bar").animate({
                 width: pourc + "%"
             });
             $(".progress-bar").html(val + "h");
         }

         if (pourc >= 50) {
             toastr.warning("Vous avez depassé le volume horaire prévu");
             $(".form-check-input").each(function(index, element) {
                 if (!$(this).is(":checked")) {
                     $(this).attr("disabled", 'disabled');
                 }
             });
         } else {
             $(".form-check-input").each(function(index, element) {
                 if (!$(this).is(":checked")) {
                     $(this).removeAttr('disabled');
                 }
             });
         }
     });

     $("#next").click(function(e) {
         e.preventDefault();
         var itemArray = [];
         $(".form-check-input").each(function() {
             if ($(this).is(":checked") && !$(this).prop("disabled")) {
                 itemArray.push({
                     label: $(this).parent().find("label").html(),
                     state: $(this).val(),
                     id: $(this).attr("valeur")
                 });
             }
         });
         var page = $(this).attr("page");
         var i = 1;
         if ($(this).attr("page") == "prepa" || $(this).attr("page") == "accueil") {
             var next = "G" + i;
             page = "prepa";
         } else {
             var next = "G" + (parseInt(page[1]) + 1);
         }

         $(".cover").fadeIn("slow");
         if (itemArray.length == 0) {
             itemArray = "empty";
         }
         $.post("controllers/votes.php", {
                 data: itemArray,
                 action: "next",
                 promotion: page
             },
             function(data, textStatus, jqXHR) {
                 if (jqXHR.done()) {
                     if (data == "okay") {
                         $(".cover").delay(2500).fadeOut(1600, function() {
                             if (next == "G4") {
                                 $('#centralModalSuccess').modal('show');
                                 $("#preview").click(function(e) {
                                     e.preventDefault();
                                     $('#modalCart').modal('show');
                                 });
                                 $("#send").click(function(e) {
                                     e.preventDefault();
                                     $("#valider").click();
                                 });
                             } else location.href = next;
                         });

                     } else {
                         toastr.warning(data);
                     }
                 } else if (jqXHR.fail()) {
                     toastr.warning("La requête n'a pas abouti veuillez réesayer");
                 } else if (jqXHR.error()) {
                     toastr.warning(textStatus);
                 }
             }
         );
     });

     $("#back").click(function(e) {
         e.preventDefault();
         var page = $(this).attr("page");
         var prev = "G" + (parseInt(page[1]) - 1);
         if (prev == "G0") {
             location.assign("prepa");
         } else location.assign(prev);
     });

     $("#valider").click(function(e) {
         e.preventDefault();
         $.post("controllers/votes.php", {
                 action: "ajouter"
             },
             function(data, textStatus, jqXHR) {
                 if (data == "ok") {
                     location.reload(true);
                 }
             });
     });


     $("#plus").click(function(e) {
         e.preventDefault();
         var field = $("#content").html();

         $(".parent").append(field);

         var size = $(".field").length;

         if (size >= 2) {
             $(this).attr("disabled", "disabled");
         }
     });


     $(".mdb-autocomplete").keyup(function(e) {
         $.get('controllers/checkcourses.php?cours=' + $(this).val(), function(data) {
             if (data != "ok") {
                 $(".err").text("Ce cours existe");
                 $(".err").css("color", "red");
                 $("#suggest").attr("disabled", "disabled");
             } else {
                 $(".err").text("");
                 $(".err").css("color", "green");
                 $("#suggest").removeAttr("disabled");
             }
         });
     });

     $("#suggest").click(function(e) {
         e.preventDefault();
         var elements = [];
         var elt = "";
         var volume = "";
         var hours = 0;
         $(".champs").each(function(index, element) {
             if ($(this).prop("tagName") == "INPUT") {
                 elt = $(this).val();
             } else if ($(this).attr("name") == "volume") {
                 volume = $(this).val();
             } else {
                 elements.push({
                     intitule: elt,
                     volume: volume,
                     categorie: $(this).val()
                 })
                 hours += parseInt(volume);
             }
         });

         console.log(elements),

             val += hours;
         valeur = val / 2000;
         pourc = valeur * 100;

         if (pourc > 25 && pourc <= 50) {
             $(".progress-bar").addClass("bg-success");
         } else if (pourc > 50 && pourc <= 75) {
             $(".progress-bar").addClass("bg-warning");
         } else if (pourc > 75 && pourc <= 100) {
             $(".progress-bar").addClass("bg-danger");
         }

         $(".progress-bar").animate({
             width: pourc + "%"
         });
         $(".progress-bar").html(val + "h");

         if (pourc >= 50) {
             toastr.warning("Vous avez depassé le volume horaire prévu");
             $("#suggest").attr("disabled", "disabled");
         } else {
             $("#suggest").removeAttr('disabled');
             if (elements.length == 0) {
                 toastr.warning("Veuillez completer tous les champs");
             } else {
                 var i = 0;
                 $.each(elements, function(indexe, valeur) {
                     if (valeur.intitule === "" || valeur.volume === "Volume horaire") {
                         i++;
                     }
                 });

                 if (i > 0) {
                     toastr.warning("veuillez compléter tous les champs");
                 } else {
                     var page = "<?=$page?>";
                     if (page === "accueil") {
                         page = "prepa";
                     }
                     $.post("controllers/cours.php", {
                             data: elements,
                             action: 'ajouter',
                             promotion: page
                         },
                         function(data, textStatus, jqXHR) {
                             if (jqXHR.done()) {
                                 if (data === "ok") {
                                     $('#modalRegisterForm').modal('hide');
                                     toastr.info("Suggesttion enregistrée");
                                 } else {
                                     toastr.warning(data);
                                 }
                             } else {
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