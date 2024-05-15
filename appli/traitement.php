<?php
    session_start();

    // Nous vérifions alors l'existence de la clé "submit" dans le tableau $_POST, 
    // celle clé correspondant à l'attribut "name" du bouton <input type="submit" name="submit"> du formulaire
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

    // Redirection vers index.php   
    header("Location:index.php");