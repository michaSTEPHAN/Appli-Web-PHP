<?php
    session_start();
    $action = $_GET['action'];                                  // On récupère le type d'action
    
    if(isset($_POST['submit'])) {

        switch($action) {
	
            case "ajout" :
                // On vérifie que les données saisies dans le formulaire sont conformes aux données attendues
                $name  = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $price = filter_input(INPUT_POST, "price",FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt   = filter_input(INPUT_POST, "qtt",FILTER_VALIDATE_INT);
                ajoutProduit($name,$price,$qtt);
                header("Location:index.php");
                break;

            case "suppression" :
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);  // On récupère l'index du produit
                // On supprime une ligne de produit
                suppressionProduit($id);    
                header("Location: recap.php");    
                break;

            case "raz" :
                // On supprime tous les produits
                razProduits();  
                header("Location: recap.php");               
                break;

            case "augmentation-qtt" :
                break;

            case "diminution-qtt" :
                break;
        }
    }

    function suppressionProduit() {
        if (isset($id) && isset($_SESSION['products'][$id])) {
            unset($_SESSION['produits'][$id]);
            $_SESSION['message'] = "Le produit a été correctement supprimé !";
        } else {
            $_SESSION['message'] = "Le produit n'a pas été supprimé";
        }
    }

    function razProduits() {
        if (isset($_SESSION['produits'])) {
            unset($_SESSION['produits']);
            $_SESSION['message'] = "Tous les produits ont été correctement supprimés !'";
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