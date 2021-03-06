        <!-- Modal: modalCart -->
        <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Your cart</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">

                        <!-- Classic tabs -->
                        <div class="classic-tabs">
                            <ul class="nav tabs-cyan" id="myClassicTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link  waves-light active show" id="profile-tab-classic" data-toggle="tab" href="#profile-classic"
                                        role="tab" aria-controls="profile-classic" aria-selected="true">Prepa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link waves-light" id="follow-tab-classic" data-toggle="tab" href="#follow-classic" role="tab"
                                    aria-controls="follow-classic" aria-selected="false">G1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link waves-light" id="contact-tab-classic" data-toggle="tab" href="#contact-classic" role="tab"
                                        aria-controls="contact-classic" aria-selected="false">G2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link waves-light" id="awesome-tab-classic" data-toggle="tab" href="#awesome-classic" role="tab"
                                        aria-controls="awesome-classic" aria-selected="false">G3</a>
                                </li>
                            </ul>
                            <div class="tab-content border-right border-bottom border-left rounded-bottom" id="myClassicTabContent">
                                <div class="tab-pane fade active show" id="profile-classic" role="tabpanel" aria-labelledby="profile-tab-classic">
                                    <p>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>id</th>
                                                    <th>cours</th>
                                                    <th>etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
if (isset($_SESSION['voted'])) {
    foreach ($_SESSION['voted'] as $key => $voted) {
        if ($key == "prepa") {
            foreach ($voted as $value) {
                ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value['id']?></td>
                                                    <td><?=$value['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
}
        }
    }
} else {
    ?>
                                                    <div class="alert alert-primary" role="alert">
                                                        Aucune donnée enregistrée
                                                    </div>
                                                <?php
}
?>
                                                </tbody>
                                        </table>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">
                                    <p>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>id</th>
                                                    <th>cours</th>
                                                    <th>etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
if (isset($_SESSION['voted'])) {
    foreach ($_SESSION['voted'] as $key => $voted) {
        if ($key == "G1") {
            foreach ($voted as $value) {
                ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value['id']?></td>
                                                    <td><?=$value['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
}
        }
    }
} else {
    ?>
                                                    <div class="alert alert-primary" role="alert">
                                                        Aucune donnée enregistrée
                                                    </div>
                                                <?php
}
?>
                                            </tbody>
                                        </table>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="contact-classic" role="tabpanel" aria-labelledby="contact-tab-classic">
                                    <p>
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>id</th>
                                                    <th>cours</th>
                                                    <th>etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
if (isset($_SESSION['voted'])) {
    foreach ($_SESSION['voted'] as $key => $voted) {
        if ($key == "G2") {
            foreach ($voted as $value) {
                ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value['id']?></td>
                                                    <td><?=$value['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
}
        }
    }
} else {
    ?>
                                                    <div class="alert alert-primary" role="alert">
                                                        Aucune donnée enregistrée
                                                    </div>
                                                <?php
}
?>
                                            </tbody>
                                        </table>
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="awesome-classic" role="tabpanel" aria-labelledby="awesome-tab-classic">
                                    <p>
                                    <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>id</th>
                                                    <th>cours</th>
                                                    <th>etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
if (isset($_SESSION['voted'])) {
    foreach ($_SESSION['voted'] as $key => $voted) {
        if ($key == "G3") {
            foreach ($voted as $value) {
                ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value['id']?></td>
                                                    <td><?=$value['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
}
        }
    }
} else {
    ?>
                                                    <div class="alert alert-primary" role="alert">
                                                        Aucune donnée enregistrée
                                                    </div>
                                                <?php
}
?>
                                            </tbody>
                                        </table>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <!-- Classic tabs -->
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                        <button id="valider" class="btn btn-primary">Terminer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal: modalCart -->

        <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Suggérer un cours</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3 parent">
                        <button class="btn btn-outline-danger" id="plus" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <div id="content">
                            <div class="row field">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="md-form">
                                        <input type="search" id="form-autocomplete-2" class="form-control mdb-autocomplete champs is-valid">
                                        <button class="mdb-autocomplete-clear">
                                            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="https://www.w3.org/2000/svg">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            </svg>
                                        </button>
                                        <label for="form-autocomplete-2" class="active">Intitule</label>
                                        <div id="err" class="valid-feedback err">
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <select class="browser-default custom-select champs mt-4" name="volume">
                                        <option selected disabled>Volume horaire</option>
                                        <option value="15">15 heures</option>
                                        <option value="30">30 heures</option>
                                        <option value="45">45 heures</option>
                                        <option value="60">60 heures</option>
                                        <option value="75">75 heures</option>
                                    </select>
                                </div>
                            </div>
                            <select class="browser-default custom-select champs mt-4">
                                <option selected disabled>Categorie</option>
                                <?php
                                    foreach ($categories as $key => $value) {
                                        ?>
                                <option value="<?=$value["id"]?>"><?=$value['nom']?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button id="suggest" class="btn btn-outline-unique">valider</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Central Modal Medium Success -->
        <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-notify modal-success" role="document">
            <!--Content-->
            <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Modal Success</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                <p>Vous avez terminé! Cliquer sur valider pour enregistrer</p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" id="send" class="btn btn-success">Valider <i class="far fa-gem ml-1 text-white"></i></a>
                <a type="button" id="preview" class="btn btn-outline-success waves-effect" data-dismiss="modal">Preview</a>
            </div>
            </div>
            <!--/.Content-->
        </div>
        </div>
        <!-- Central Modal Medium Success-->
