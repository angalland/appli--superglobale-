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
            <nav class=" mt-3 navbar navbar-expand-lg navbar-light bg-light">

                <!-- Menu burger -->

                <div class="container">
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo01">

                <!-- menu -->

                <ul class="nav justify-content-center nav-pills">
                    <li class="nav-item"><a class="nav-link active me-3" href="index.php">Ajouter un produit</a></li>
                    <li class="nav-item position-relative">
                        <a class="nav-link active" href="recap.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>  <!-- importe une icone bootstraps en forme de panier -->
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> <!-- place un badge en position absolue de la <li> -->
                            <?php
                                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ // si une session n'est pas instancié alors
                                    echo "0"; // renvoie 0
                                } else {      // sinon 
                                    echo  count($_SESSION['products']); // renvoie + et le nombre d'élément en session
                                }
                            ?>
                            <span class="visually-hidden">unread messages</span>
                        </a>
                    </li>
                <ul>
            </nav>

            <!-- main -->

        <main class="container my-5">
            <h1 class="row col-12">Ajouter un produit</h1>
            <form action="traitement.php?action=addProduct" method="post" enctype="multipart/form-data" class="row col-12 "> <!-- formulaire pour ajouter un produit, les données sont envoyé sur la page traitement.php avec la methode post -->
            <!-- enctype="multipart/form-data" est obligatoire lorsqu'on veut uploader des fichiers -->
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
                <p class='col-6'>
                    <label for='file'>Fichier</label>
                    <input type='file' name='file' class="form-control w-50">
                </p>
                <p class='col-12'>
                    <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-primary" id="boutton">
                </p>
            </form>

            <!-- On indique ici le nombre de produits ajoutés -->
            <p class="bg-success rounded-pill text-center text-white col-3">
                <?php
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){ // vérifie si il n'y a pas de session présente alors
                echo "Aucun produit ajouté"; // renvoie ce message si il n'y a pas de session
                } else { // sinon
                    echo "<p class='bg-success col-3 rounded-pill text-center text-white'>Il y a ".count($_SESSION['products'])." produits ajoutés</p>"; // renvoie ce message qui compte le nombre de produits dans session
                }
                ?> 
            </p>

            <!-- Envoie un message alert lorsque l'utilisateur ajoute un produit (différe celon les données saisies) -->
                <?php
                if (isset($_SESSION['alert'])){ // si il y a un $_SESSION['alert'] alors
                    echo $_SESSION['alert'];    // renvoie $_SESSION['alert']
                    unset($_SESSION['alert']);  //Détruit $_SESSION['alert'] des qu'on recharge la page, c'est pour que le message d'alert ne reste pas permanent sur la page
                }

                if (isset($_SESSION['alertFichier'])){ // si il y a un $_SESSION['alertFichier'] alors
                    echo $_SESSION['alertFichier'];    // renvoie $_SESSION['alertFichier']
                    unset($_SESSION['alertFichier']);  //Détruit $_SESSION['alertFichier'] des qu'on recharge la page, c'est pour que le message d'alert ne reste pas permanent sur la page
                }
            ?>
           </p>
        </main> 

        <!-- Importe le js bootstrapt -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
</html>