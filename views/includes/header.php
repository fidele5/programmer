<!DOCTYPE html>
    <html lang="">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?=$page?></title>

            <!-- Bootstrap CSS -->
            <link href="public/css/fontawesome-all.css" rel="stylesheet">
            <link rel="stylesheet" href="public/css/font-awesome.min.css">
            <link rel="icon" href="public/img/favicon.png">
            <!-- Bootstrap core CSS -->
            <link href="public/css/bootstrap.min.css" rel="stylesheet">
            <!-- Material Design Bootstrap -->
            <link href="public/css/mdb.min.css" rel="stylesheet">
            <link href="public/css/addons-pro/stepper.css" rel="stylesheet">
            <!-- Stepper CSS - minified-->
            <link href="public/css/addons-pro/stepper.min.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css" />
            <link rel="stylesheet" type="text/css" href="public/css/fontawesome.css" />
            <link rel="stylesheet" type="text/css" href="public/css/iDashboard.css" />
            <![endif]-->
        </head>
    <?php
        if (is_connected()) {
            ?>
        <body class="fixed-sn light-blue-skin">
        <!--Main Navigation-->
        <!--Navbar -->
        <nav class="mb-1 navbar navbar-expand-lg navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Progammer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
                aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                <button class="btn btn-outline-secondary waves-effect ml-auto" type="button">Deconnexion</button>
            </div>
        </nav>
        <!--/.Navbar -->
        <?php
        }
        else {
        ?>
            <body class="yoo-white-bg">
        <?php
        }
        ?>
