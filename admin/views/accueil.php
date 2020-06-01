
<?php
    ob_start();
?>
 <div class='container-fluid mt-4'>
    <h1 class='text-center'>Hello World</h1>
    <p>Je suis content de voir tout ca fonctionnner<p>
</div>
<?php $content = ob_get_clean();
    require_once 'includes/template.php';