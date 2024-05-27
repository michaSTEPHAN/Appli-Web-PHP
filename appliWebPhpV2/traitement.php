<?php
    session_start();
    $action = $_GET['action'];                                  // On récupère le type d'action

    switch($action) {
	
        case "ajout" :
            // On vérifie que les données saisies dans le formulaire sont conformes aux données attendues
            $name  = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, "price",FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $qtt   = filter_input(INPUT_POST, "qtt",FILTER_VALIDATE_INT);

            // On appelle la fonction qui ajoute une ligne de produit
            ajoutProduit($name,$price,$qtt);
            header("Location:index.php");
            break;

        case "suppression" :
            // On récupère l'index du produit
            $id = isset($_GET["id"]) ? $_GET["id"] : null;
                
            if($id) {
                // On appelle la fonction qui supprime une ligne de produit
                suppressionProduit($id);    
                header("Location: recap.php");    
            }
            break;

        case "raz" :
            // On appelle la fonction qui supprime toutes les lignes de produits
            razProduits();  
            header("Location: recap.php");               
            break;

        case "augmentation-qtt" :
            // On récupère l'index du produit
            $id = isset($_GET["id"]) ? $_GET["id"] : null;

            if($id) {
                // On appelle la fonction qui augmente la quantité sur une ligne de produit
                augmentationQttProduit($id);    
                header("Location: recap.php");    
            } 
            break;

        case "diminution-qtt" :
            // On récupère l'index du produit
            $id = isset($_GET["id"]) ? $_GET["id"] : null;

            if($id) {
                // On appelle la fonction qui diminue la quantité sur une ligne de produit
                diminutionQttProduit($id);    
                header("Location: recap.php");    
            }
            break;
    }
 
    function suppressionProduit($id) {
        if (isset($id) && isset($_SESSION['produits'][$id])) {
            unset($_SESSION['produits'][$id]);
            $_SESSION['message'] = "Le produit a été correctement supprimé !";
        } else {
            $_SESSION['message'] = "Le produit n'a pas été supprimé";
        }
    }

    function augmentationQttProduit($id) {
        if (isset($id) && isset($_SESSION['produits'][$id])) {
            // On récpère la ligne du produit correspondant
            $produit = &$_SESSION['produits'][$id];
            // On met à jour la qté
            $produit['qtt'] += 1;
            // On recalcule le total
            $produit['total'] = $produit['price'] * $produit['qtt'];
            $_SESSION['message'] = "La quantité a été correctement modifiée !";
        } else {
            $_SESSION['message'] = "La quantité n'a pas été modifiée";
        }
    }

    function diminutionQttProduit($id) {
        if (isset($id) && isset($_SESSION['produits'][$id])) {
            // On récpère la ligne du produit correspondant
            $produit = &$_SESSION['produits'][$id];
            // On met à jour la qté
            $produit['qtt'] -= 1;
            

            // On teste si la qté devient nulle
            if ($produit['qtt'] == 0) {
                // si OUI : on supprime la ligne de produit
                suppressionProduit($id);
            } else {
                // si NON : on recalcule le total
                $produit['total'] = $produit['price'] * $produit['qtt'];
                $_SESSION['message'] = "La quantité a été correctement modifiée !";
            }               
        } else {
            $_SESSION['message'] = "La quantité n'a pas été modifiée";
        }
    }

    function razProduits() {
        if (isset($_SESSION['produits'])) {
            unset($_SESSION['produits']);
            $_SESSION['message'] = "Tous les produits ont été correctement supprimés !'";
        } else {
            $_SESSION['message'] = "Le produit n'a pas été supprimé";
        }
    }

    function ajoutProduit($name, $qtt, $price) {
        // On test qu'il y a bien TRUE dans les 3 variables
        //      => Les 3 champs de saisies ont été validés et sont conformes
        if($name && $price && $qtt) {

            // On créé un tableau associatif qui contient les données du produit
            $produit = [
                "name"  => $name,
                "price" => $price,
                "qtt"   => $qtt,
                "total" => $price*$qtt        
            ];
            
            // On enregistre le produit dans $_SESSION
            $_SESSION['produits'][] = $produit;

            // On enregistre un message de confirmation
            $_SESSION['message'] = "Produit enregistré aves succès !";
        } else {
            // On enregistre un message d'erreur'
            $_SESSION['message'] = "Erreur lors de l'enregistrement du produit";
        }
    }    