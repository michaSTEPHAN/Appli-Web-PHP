<?php
    session_start();

    if(isset($_POST['submit'])) {

        // On vérifie que les données saisies dans le formulaire sont conformes aux données attendues
        $name  = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price",FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt   = filter_input(INPUT_POST, "qtt",FILTER_VALIDATE_INT);

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
        }
    }

    header("Location:index.php");