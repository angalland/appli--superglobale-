<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <title>Ajout produit</title>
    </head>
    <body>
            <nav>
                <ul class="nav justify-content-center nav-pills">
                    <li class="nav-item"><a class="nav-link" href="index.php">Ajouter un produit</a></li>
                    <li class="nav-item"><a class="nav-link active" href="recap.php">Récapitulation</a></li>
                <ul>
            </nav>
        <main class="container text-center vh-100 d-flex flex-wrap align-content-center">
            <h1 class="row col-12 justify-content-center align-items-end align-self-center">Ajouter un produit</h1>
            <form action="traitement.php" method="post" class="row col-12 justify-content-center">
                <p class="col-3">
                    <label>
                        Nom du produit : 
                        <input type="text" name="name" class="form-control">
                    </label>
                </p>
                <p class="col-3">
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price" class="form-control">
                    </label>
                </p>
                <p class="col-3">
                    <label>
                        Quantité désirée : 
                        <input type="number" name="qtt" value="1" class="form-control">
                    </label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-primary">
                </p>
            </form>
        </main> 
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
</html>