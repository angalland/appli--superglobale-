<?php

session_start();

if (isset($_GET['supprimer'])){
    $indexClef = $_GET['index'];
    unset($_SESSION['products'][$indexClef]);
}

if (isset($_GET['supprimerTableau'])){
    unset($_SESSION['products']);
}

if (isset($_GET['+'])){
    $_SESSION['products']['qtt']++;
} 


header('Location:recap.php');