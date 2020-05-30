$(document).ready(function() {
    $("#signin").click(function(e) {
        e.preventDefault();
        var i = 0;
        $(".field").each(function(index, element) {

            if (!$(this).val()) {
                $(this).removeClass("form-control champ").addClass("form-control is-invalid champ");
                i++;
            } else {
                if ($(this).attr("type") === "email") {
                    if ($(this).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                        $(this).removeClass("form-control champ").addClass("form-control is-invalid champ");
                        $("#err").removeClass('valid-feedback').addClass('invalid-feedback mb-4');
                        $("#err").text("Adresse email invalide");
                        i++;
                    }
                } else $(this).removeClass("form-control is-invalid champ").addClass("form-control is-valid champ");
            }

        });
        console.log(i);
        if (i > 0) {
            toastr.warning("Veuillez compléter tous les champs");
        } else {
            var nom = $("#nom").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var status = $("#status").val();
            var domain = $("#domain").val();

            $.post("controllers/utilisateurs.php", {
                    nom_complet: nom,
                    email: email,
                    login: email,
                    password: password,
                    categorie_id: status,
                    domaine_id: domain,
                    action: "ajouter"
                },
                function(data, textStatus, jqXHR) {
                    if (jqXHR.done()) {
                        if (data !== "okay") {
                            toastr.warning("Une erreur s'est produite veuillez réesayer");
                        } else {
                            location.href = 'accueil';
                        }
                    } else {
                        toastr.warning(textStatus);
                    }
                }
            );
        }

    });

    $("#login").click(function(e) {
        e.preventDefault();
        e.preventDefault();
        var i = 0;
        $(".champs").each(function(index, element) {

            if (!$(this).val()) {
                $(this).removeClass("form-control champ").addClass("form-control is-invalid champ");
                i++;
            } else {
                $(this).removeClass("form-control is-invalid champ").addClass("form-control is-valid champ");
            }
        });
        console.log(i);
        if (i > 0) {
            toastr.warning("Veuillez compléter tous les champs");
        } else {
            var login = $("#nom").val();
            var password = $("#password").val();

            $.post("controllers/utilisateurs.php", {
                    login: login,
                    password: password,
                    action: "login"
                },
                function(data, textStatus, jqXHR) {
                    if (jqXHR.done()) {
                        if (data !== "okay") {
                            toastr.warning("Une erreur s'est produite veuillez réesayer");
                        } else {
                            location.href = 'accueil';
                        }
                    } else {
                        toastr.warning(textStatus);
                    }
                }
            );
        }
    });
});