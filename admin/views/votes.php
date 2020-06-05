<?php
    ob_start();
?>
<div class='container'>
    
</div>
<?php
    $content = ob_get_clean();
    require_once 'includes/template.php';