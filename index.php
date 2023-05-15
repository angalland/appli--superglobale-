<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- import le css bootsrapt -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"       integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">    

        <title>Ajout produit</title>
    </head>
    <body>
        <?php
            session_start(); // Fait appelle a la session
        ?>
        <main class="container my-5">
            <nav> <!-- menu -->
                <ul class="nav justify-content-center nav-pills">
                    <li class="nav-item"><a class="nav-link active me-3" href="index.php">Ajouter un produit</a></li>
                    <li class="nav-item position-relative">
                        <a class="nav-link active" href="recap.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg> 
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= count($_SESSION['products']) ?>+
                            <span class="visually-hidden">unread messages</span>
                        </a>
                    </li>
                <ul>
            </nav>
            <h1 class="row col-12">Ajouter un produit</h1>
            <form action="traitement.php?action=addProduct" method="post" class="row col-12 justify-content-center"> <!-- formulaire pour ajouter un produit, les données sont envoyé sur la page traitement.php avec la methode post -->
                <p class="col-12">
                    <label>
                        Nom du produit : 
                        <input type="text" name="name" class="form-control">
                    </label>
                </p>
                <p class="col-12">
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price" class="form-control">
                    </label>
                </p>
                <p class="col-12">
                    <label>
                        Quantité désirée : 
                        <input type="number" name="qtt" value="1" class="form-control">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-primary" id="boutton">
                </p>
            </form>
            <p class="bg-success w-25 rounded-pill text-center text-white">
                <?php
                //  if(($_SESSION['products']) != null || $_SESSION != 0 || $_SESSION != false) { // Si il y a un $_SESSION de créer alors
                // echo "Il y a ".count($_SESSION['products'])." produits ajoutés."; // renvoie le nombre total d'element dans $_SESSION['products']
                // } elseif ($_SESSION['products'] == null ){
                //     echo "Aucun produit ajouté."; // sinon renvoie cette phrase;
                // } else {
                //     echo "";
                // }
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo "Aucun produit ajouté";
                } else {
                    echo "<p class='bg-success w-25 rounded-pill text-center text-white'>Il y a ".count($_SESSION['products'])." produits ajoutés</p>";
                }
                ?> 
            </p>
             <?php 
                if (isset($_SESSION['alert'])){ // si il y a un $_SESSION['alert'] alors
                    echo $_SESSION['alert'];    // renvoie $_SESSION['alert']
                    unset($_SESSION['alert']);  //Détruit $_SESSION['alert'] des qu'on recharge la page, c'est pour que le message d'alert ne reste pas permanent sur la page
                }
            ?>
           </p>
        </main> 

        <!-- Importe le js bootstrapt -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
</html>