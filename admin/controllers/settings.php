<?php
    require_once "../models/settings.php";
    extract($_POST);

    $setting = new Settings;
    $setting->update($cotation, $moyenne);
    echo "saved";