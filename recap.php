<?php
    session_start(); // Fait appelle de la session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
    <title>Recapitulatif des produits</title>
</head>
<body>
        <nav class='mt-3 navbar navbar-expand-lg navbar-light bg-light'>

            <!-- Menu burger -->
            <div class="container">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse justify-content-center navbar-collapse" id="navbarTogglerDemo01">

            <!-- Menu -->
            <ul class='nav justify-content-center nav-pills'>
                <li class='nav-item me-3'>
                    <a class='nav-link active' href='index.php'>Ajouter un produit</a>
                </li>
                <li class='nav-item position-relative'>
                    <a class='nav-link active' href='recap.php'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg> 
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php
                                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                                    echo "0";
                                } else {
                                    echo  count($_SESSION['products']);
                                }
                            ?>
                        <span class="visually-hidden">unread messages</span>
                    </a>
                </li>
            <ul>
        </nav>
    <?php
        // var_dump($_SESSION);
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ // vérifie si $_SESSION['products'] est non déclaré et null alors
            echo
                "<main class='container d-flex flex-column vh-100 justify-content-center align-items-center'>", 
                    "<p class='h1'>Aucun produit en session....</p>";
                    if (isset($_SESSION['alertSupprimer'])){ // si il y a un $_SESSION['alertSupprimer'] alors
                        echo $_SESSION['alertSupprimer'];    // renvoie $_SESSION['alertSupprimer']
                        unset($_SESSION['alertSupprimer']);  //Détruit $_SESSION['alertSupprimer'] des qu'on recharge la page, c'est pour que le message d'alert ne reste pas permanent sur la page
                    }        
                 "</main>";
        }
        else { // sinon (si elle est déclaré ou non null = il existe un $_SESSION['products'] = on a créer des produits)
            echo            
            "<main class='container d-flex vh-100 justify-content-center align-items-start flex-column'>",
                    "<table class='table table-striped table-bordered border-danger table-sm text-center'>", // créer un tableau 
                        "<thead>",
                            "<tr class='table-primary table-bordered border-danger'>",
                                // "<th class='text-center'>#</th>",
                                "<th scope='col'>Nom</th>",
                                "<th scope='col'>Prix</th>",
                                "<th scope='col'>Quantité</th>",
                                "<th scope='col'>Total</th>",
                                "<th scope='col'>Supprimer produit</th>",
                            "</tr>",
                    "</thead>",
                    "<tbody class='table-group-divider'>";

            $totalGeneral = 0; // créer une variable pour calculer le prix général
            foreach($_SESSION['products'] as $index => $product) {  //fait une boucle de $_SESSION['products'] en fournissant un $index pour chaque $product
                echo "<tr scope='row'>",
                        // "<td>".$index."</td>", // renvoie l'index
                        "<td>",
                            "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#".$product['name']."'>"
                            .$product['name']. // renvoie le nom sous formr de boutton qui servira a la modale
                            "</button> ",

                            //   Modale : affiche l'image dans une nouvelle fenetre modale
                                "<div class='modal fade' id='".$product['name']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>", // Recupere le nom pour assigner la modale au bouton du nom
                                    "<div class='modal-dialog'>",
                                        "<div class='modal-content'>",
                                            "<div class='modal-header'>",
                                                "<h1 class='modal-title fs-5' id='exampleModalLabel'>Image du produit</h1>",
                                                "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>",
                                            "</div>",
                                            "<div class='modal-body'>",
                                                "<img src='".$product['fichier']."' witdh=200px height=200px>",  // récupére le chemin d'acces au fichier du tableau
                                            "</div>",
                                            "<div class='modal-footer'>",
                                                "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>",
                                            "</div>",
                                        "</div>",
                                    "</div>",
                                "</div>",

                        "</td>", // renvoie le nom du roduit

                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>", // renvoie le prix sous forme de 2 décimale max, séparateur virgule.
                        "<td>",

                            "<form action='traitement.php?action=traitement_qtt' method='post' class='btn'>",  //crée un formumaire qui renvoie les données sur traitement_qtt?action=traitement_qtt
                                "<input type='hidden' name='productIndex' value='".$index."'>", //renvoie un élément qui ne peut etre ni modifier ni vue par l'utilisateur ici la valeur d'index
                                "<input type='hidden' name='modifierQtt' value='+'>", // ici la valeur '+'
                                "<input type='submit' name='submit' value='+' class='btn btn-primary'>", // crée le bouton + avec type=submit
                            "</form>" 
                            .$product['qtt']. // renvoie la quantité                                              
                            "<form action='traitement.php?action=traitement_qtt' method='post' class='btn'>", 
                               "<input type='hidden' name='productIndex' value='".$index."'>",
                                "<input type='hidden' name='modifierQtt' value='-'>", // ici la valeur '-'
                                "<input type='submit' name='submit' value='-' class='btn btn-primary'>", // crée le bouton - avec type=submit
                            "</form>",
                        "</td>",

                        "<td>".number_format($product['qtt']*$product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>", // renvoie le total du prix (qtt*prix) sous format 2 décimale, sépareteur virgule

                        "<td>",
                            "<a href='traitement.php?action=deleteOne&id=".$index."'>",  //  renvoie les données vers la page traitement.php?action=deleteOne&
                                "<button type='submit' name='supprimer' value='supprimer' class='btn btn-danger'>supprimer</button>", // crée le bouton supprimer avec type=submit
                            "</a>",
                        "</td>",
                    "</tr>";

                $totalGeneral+= $product['qtt']*$product['price']; // fait le calcule du totale générale, a chaque boucle qtt*price de chaque produit s'additionnera
            }

            echo   "<tr>",
                        "<td colspan=3 class='text-end'>Total général : </td>",
                        "<td><strong class='bg-warning'>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>", // renvoie le total général

                        "<td>", // crée un bouton supprimer tous les produits
                            "<a href='traitement.php?action=deleteAll'>", // renvoie les données vers la page traitement.php?action=deleteAll                               
                                "<button type='submit' name='supprimerTableau' class='btn btn-danger'>supprimer tous les produits</button>",
                            "</a>",

                    "</tr>",
                    "</tbody>",
                "</table>";

            echo "<p class='bg-success col-3 rounded-pill text-center text-white'>Il y a ".count($_SESSION['products'])." produits ajoutés</p>"; // Renvoie le nombre total de produits dans le tableau SESSION 
            
            if (isset($_SESSION['alertSupprimer'])){ // si il y a un $_SESSION['alertSupprimer'] alors
                echo $_SESSION['alertSupprimer'];    // renvoie $_SESSION['alertSupprimer']
                unset($_SESSION['alertSupprimer']);  //Détruit $_SESSION['alertSupprimer'] des qu'on recharge la page, c'est pour que le message d'alert ne reste pas permanent sur la page
            }               
                "</main>";
        }   
            ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
                            