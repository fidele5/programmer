<?php
    session_start();
    echo (isset($_SESSION['voted']))?json_encode($_SESSION['voted']):json_encode([]);