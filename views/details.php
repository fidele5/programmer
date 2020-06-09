    <!-- Central Modal Medium Success -->
    <div class="modal fade right" id="details<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-side modal-notify modal-info modal-right" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">Details <?=$value['intitule']?></p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-bell fa-4x animated rotateIn mb-4"></i>
                        <p><?=(empty($value['details']))?"Aucun detail enregistré":$value['details']?>
                        </p>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <a type="button" class="btn btn-info">Ok<i class="far fa-gem ml-1 text-white"></i></a>
                    <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Fermer</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Central Modal Medium Success-->