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
    $nouvelleQtt = $_GET['indexQtt'];
    $nouvelleQtt++;
};

header('Location:recap.php');