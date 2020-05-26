<!-- Button trigger modal-->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCart">Launch modal</button>

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
                                                    foreach ($_SESSION['voted'] as $voted) {
                                                        if (key($voted) == "prepa") {
                                                            foreach ($voted as $value) {
                                                                for ($j = 0; $j < count($value); $j++) {
                                                                    ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value[$j]['id']?></td>
                                                    <td><?=$value[$j]['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }else {
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
                                                    foreach ($_SESSION['voted'] as $voted) {
                                                        if (key($voted) == "G1") {
                                                            foreach ($voted as $value) {
                                                                for ($j = 0; $j < count($value); $j++) {
                                                                    ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value[$j]['id']?></td>
                                                    <td><?=$value[$j]['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }else {
                                                    ?>
                                                    <div class="alert alert-primary" role="alert">
                                                        Aucune donnée enregistrée
                                                    </div>
                                                <?php
                                                }
                                                ?>
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
                                                    foreach ($_SESSION['voted'] as $voted) {
                                                        if (key($voted) == "G2") {
                                                            foreach ($voted as $value) {
                                                                for ($j = 0; $j < count($value); $j++) {
                                                                    ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value[$j]['id']?></td>
                                                    <td><?=$value[$j]['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }else {
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
                                                    foreach ($_SESSION['voted'] as $voted) {
                                                        if (key($voted) == "G3") {
                                                            foreach ($voted as $value) {
                                                                for ($j=0; $j < count($value); $j++) {
                                                                    ?>
                                                <tr>
                                                    <th scope="row">#</th>
                                                    <td><?=$value[$j]['id']?></td>
                                                    <td><?=$value[$j]['label']?></td>
                                                    <td><a><i class="fas fa-times"></i></a></td>
                                                </tr>
                                                <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }else {
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
                        <button class="btn btn-primary">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal: modalCart -->
