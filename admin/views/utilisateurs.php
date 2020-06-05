<?php
    // ob_start();
?>
<div class='container' style="background-color: aliceblue;">
    <?php 
        // echo "<pre>";
        // print_r($spreadSheetAry);
        // echo "</pre>";

        $sheetCount = $spreadSheet->getSheetCount();
        for ($i = 0; $i < $sheetCount; $i++) {
            $sheet = $spreadSheet->getSheet($i);
            $sheetData = $sheet->toArray();
            echo "<pre>";
            echo "Sheet ".$i."<br>";
            print_r($sheetData);
            echo "</pre>";

        }

    ?>

</div>
<?php
    // $content = ob_get_clean();
    // require_once 'includes/template.php';