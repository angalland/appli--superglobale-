<?php

session_start(); // fait appelle a la session

if (isset($_GET['supprimer'])){ // si $_GET['supprimer'] est déclarer = si on appuie sur le bouton supprimer alors
    $indexClef = $_GET['index']; // crée une variable qui prend la valeur de l'index qu'on a par ailleur récupérer dans la boucle avec type=hidden
    unset($_SESSION['products'][$indexClef]); // supprime du tableau $_SESSION les éléments ayant l'index pris audessus
}

if (isset($_GET['supprimerTableau'])){ // Si $_GE['supprimerTableau'] est déclarer = si on appuie sur le bouton supprimer tableau alors
    unset($_SESSION['products']); // supprime $_SESSION['products']
}

header('Location:recap.php'); // renvoie a la page recap.php cette page est inaccessible pour l'utilisateur