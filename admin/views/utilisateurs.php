<?php
    // ob_start();
?>
<div class='container' style="background-color: aliceblue;">
    <?php
        $sheetCount = $spreadSheet->getSheetCount();
        for ($i = 0; $i < $sheetCount; $i++) {
            $nom = $spreadSheet->getSheetNames();
            $sheet = $spreadSheet->getSheet($i);
            $sheetData = $sheet->toArray();
            echo $nom[$i] . "<br>";
            echo "<pre>";
            print_r($sheetData);
            echo "</pre>";

        }

    ?>

</div>
<?php
    // $content = ob_get_clean();
    // require_once 'includes/template.php';