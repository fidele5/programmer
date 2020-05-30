$(document).ready(function() {
    $("#signin").click(function(e) {
        e.preventDefault();
        var i = 0;
        $(".field").each(function(index, element) {

            if (!$(this).val()) {
                $(this).addClass("is-invalid");
                i++;
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
                $(this).addClass("is-invalid");
                i++;
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