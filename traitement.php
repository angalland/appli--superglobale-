<?php
    session_start(); // enregistre des données sur le serveur, ici on demarre une session. Cette fonction permet soit de demarrer une session soit de récupérer une séssion déja présente sur le serveur




    $nbSession = 0;



    if (isset($_GET['action'])){ // vérifie que la méthode get nommé action est présent
       
        switch($_GET['action']){  // vérifie pour chaque méthode get['action], les conditions suivantes
            case 'addProduct' :
                if(isset($_POST['submit'])){ // Vérification que l'utilisateur a bien appuyer sur le bouton ajouter produit

                    // Filtre pour vérifié les données saisies par l'utilisateur
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION,);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);       
            
                    if($name && $price && $qtt){ // Cette condition vérifie si les filtres ont bien fonctionné, que les variables renvoient tous sauf false, null ou 0.

                        if ($price > 0 && $qtt > 0) { // vérifie que $price et $qtt soit positif alors
            
                        $product = [ //Mets les information d'un produits dans un tableau assiocatif
                            "name"  => $name,
                            "price" => $price,
                            "qtt"   => $qtt,
                            // "total" => $price*$qtt sera traité directement sur la page recap.php
                        ];
                        
                        //Envoie un message lorsque l'utilisateur a ajouté un produit  
                        $_SESSION['alert'] = "<p class='alert alert-success w-25' role='alert'>Le produit ".$product['name']." a bien été ajouté !</p>";
                        
                        // On enregistre le produit nouvellement créer dans la superglobale SESSION a qui on fournit une clef products, $_SESSION nous renverra donc un tableau associatif products => product
                        $_SESSION['products'][] = $product;
            
                        // fonction qui trie le tableau par ordre alphabétique
                        sort($_SESSION['products']);

                        } else { // sinon renvoie cette alerte
                            if ($price <= 0){
                                $_SESSION['alert'] = "<p class='alert alert-danger w-25' role='alert'>Le prix du produit doit être un nombre décimal positif ! Le produit n'a pas été ajouté</p>";
                            }
                            if ($qtt <= 0 ){
                                $_SESSION['alert'] = "<p class='alert alert-danger w-25' role='alert'>La quantité du produit doit être un nombre entier positif ! Le produit n'a pas été ajouté</p>";
                            }
                        }
            
                    } else { //Les filtres ont renvoyé false, null ou 0
            
                        // envoie un message 
                        $_SESSION['alert'] = "<p class='alert alert-warning w-25 ' role='alert'>Votre produit n'a pas été ajouté, il est incorrect ! </p>";
                    }

                    if (isset($_FILES["file"])){ // vérifie que le fichier ai bien été enregistré

                        // Récupere les informations du fichiers
                        $tmpName = $_FILES["file"]['tmp_name']; 
                        $name = $_FILES["file"]["name"];
                        $type = $_FILES["file"]["type"];
                        $error = $_FILES["file"]["error"];
                        $size = $_FILES["file"]["size"];
                
                        // separe la chaine de caractere $name a chaque fois qu'il a un "."
                        $tabExtension = explode('.', $name);
                
                        // Prend le dernier element de $tabExtension et le renvoie en minuscule
                        $extension = strtolower(end($tabExtension));
                
                        // Introduit une variable ayant pour valeur un int
                        $tailleMax = 3000000;
                
                        //Tableau des extensions qu'on autorise 
                        $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];
                        
                        if(in_array($extension, $extensionAutorisees) && $size <= $tailleMax && $error == 0 ){ // vérifie que $extension soit compris dans $extensionAutorisees et que la taille du fichier soit <= a la valeur de $tailleMax et que le fichier ne renvoie aucune erreure
                
                            // génere un nom unique ex: 5f586bf96dcd38.73540086
                            $uniqueName = uniqid('', true);
                            // on contatene $uniqueName avec $extension = 5f586bf96dcd38.73540086.jpg
                            $fileName = $uniqueName.'.'.$extension;
                            //transfere le fichier img ($tmpName etant le chemin ou il est sur l'ordinateur dans le fichier /upload/ et lui assigne $fileName)
                            move_uploaded_file($tmpName, './uploadImage/'.$fileName); 
                
                            // créer une variable tableau des $fileName
                            $fichier = [
                                "name" => $uniqueName,
                                "fileName" => $fileName,
                            ];
                
                            // crée un tableau associatif 'fichiers' des $fichier
                            $_SESSION['fichiers'][] = $fichier;
                            
                        }
                    }
                }
            
                header("Location:index.php"); //Redirection vers index.php pour que l'utilisateur ne puisse pas atteindre la page traitement.php
                die;
                break;

                
            case 'traitement_qtt' :
                if(isset($_POST['submit'])){ // si la variable $_post['submit'] est déclaré = si on a appuyer sur le bouton + ou -
                    $indexInput = filter_input(INPUT_POST, "productIndex", FILTER_VALIDATE_INT); // créer une variable = a la valeur de l'index recuperer via type=hidden
                    $qttModifier = filter_input(INPUT_POST, "modifierQtt"); // créer une variable = a la valeur de 'modifierQtt' récuperer via type=hidden
                    
                    foreach ($_SESSION['products'] as $index => $product) { // on fait une boucle sur $_SESSION['products'] en lui assignant un index
                        if ($index == $indexInput) {  // si l'index = l'index récuperer plus haut alors
                            if ($qttModifier == '+') {  // si la valeur de qttModifier récupérer plus haut = '+' alors
                                $_SESSION['products'][$index]['qtt'] +=1;  // on ajoute 1 a la valeur de qtt dans le tableau SESSION
                            } else { //sinon 
                                if ($_SESSION['products'][$index]['qtt'] >= 2){  // si la valeur de qtt dans le tableau SESSION > 0 alors
                                $_SESSION['products'][$index]['qtt'] -=1; // on enleve 1 a la valeur de qtt dans le tableau SESSION
                                } elseif ($_SESSION['products'][$index]['qtt'] == 1) {
                                    unset($_SESSION['products'][$index]);
                                    $_SESSION['alertSupprimer'] = "<p class='alert alert-danger w-25 ' role='alert'>Le produit ".$product['name']." a bien été supprimé ! </p>";
                                }
                            }
                        }
                    }
                }
                    
                header('Location:recap.php'); // renvoie sur la page recap.php
                die;
                break;

            case 'deleteOne' :
                $indexClef = $_GET['id']; // crée une variable qui prend la valeur de l'index qu'on a par ailleur récupérer dans la boucle avec type=hidden
                $_SESSION['alertSupprimer'] = "<p class='alert alert-danger w-25 ' role='alert'>Le produit ". $_SESSION['products'][$indexClef]['name'] ." a bien été supprimé ! </p>";
                   
                unset($_SESSION['products'][$indexClef]); // supprime du tableau $_SESSION les éléments ayant l'index pris audessus
                header("Location:recap.php"); //Redirection vers recap.php pour que l'utilisateur ne puisse pas atteindre la page traitement.php
                die;
                break;

            case 'deleteAll' :                                  
                unset($_SESSION['products']); // supprime $_SESSION['products']
                $_SESSION['alertSupprimer'] = "<p class='alert alert-danger w-25 ' role='alert'>Vous avez supprimé tous les produits ! </p>";
                header('Location:recap.php'); // renvoie a la page recap.php cette page est inaccessible pour l'utilisateur
                die;
                break;
            }
    }
   
    