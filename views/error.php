<?php
ob_start();
?>
        <!-- error 404 -->
        <section class="container">
          
            <div class="card">
                <div class="card-content rgba-black-light text-center">
                    <div class="card-body text-center bg-transparent miscellaneous">
                        <h1 class="error-title">Mama miya page non trouvée  🥶 </h1>
                        <p class="pb-3">
                        <?=$e->getMessage()?></p>
                        <img class="img-fluid" src="public/img/404.png" alt="404 error">
                    </div>
                    <a href="accueil" class="btn btn-outline-primary mt-3">Accueil</a>
                </div>
            </div>
        </section>
        <!-- error 404 end -->
<?php $content = ob_get_clean();
require_once 'includes/template.php';
