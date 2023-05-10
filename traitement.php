<?php
    session_start();

    if(isset($_POST['submit'])){
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "gtt", FILTER_VALIDATE_INT);
    }
    header("Location:index.php");