<?php
    session_start();
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
    <?php
        // var_dump($_SESSION);
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit en session....</p>";
        }
        else {
            echo "<main class='container text-center vh-100 d-flex flex-wrap align-content-center'>",
                    "<nav>",
                        "<ul>",
                            "<li><a href='index.php'>Ajouter un produit</a></li>",
                            "<li><a href='recap.php'>Récapitulation</a></li>",
                        "<ul>",
                    "</nav>",
                    "<table class='table table-striped table-bordered border-danger table-sm text-center'>",
                        "<thead>",
                            "<tr class='table-primary table-bordered border-danger'>",
                                "<th class='text-center'>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "</tr>",
                    "</thead>",
                    "<tbody class='table-group-divider'>";

            $totalGeneral = 0;
            foreach($_SESSION['products'] as $index => $product) {
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>".$product['qtt']."</td>",
                        "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "</tr>";
                $totalGeneral+= $product['total'];
            }

            echo   "<tr>",
                        "<td colspan=4 class='text-end'>Total général : </td>",
                        "<td><strong class='bg-warning'>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                    "</tr>",

                    "</tbody>",
                "</table>",
                "</main>";
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>