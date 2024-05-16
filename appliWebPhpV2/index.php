<?php
    session_start();
    $link       = "recap.php";
    $linkText   = "Panier";
    $pageTitle  = "Ajout de produits au panier";

    if (isset($_SESSION['message'])) {
        // stock le message dans une variable
        $message = $_SESSION['message'];

        // supprime le message de la session pour éviter qu'il réapparaisse
        unset($_SESSION['message']);
    } else {
        $message = '';
    }


    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Ajouter un produit</h1>
        <!-- <form action="traitement.php" method="post"> -->
        <!-- On dit ici à traitement.php d'executer la fonction "ajout" de -->
        <form action="traitement.php?action=ajout" method="post">
            <p>
                <label>
                    Nom de produit :
                    <input class="champSaisie" type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input class="champSaisie" type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input class="champSaisie" type="number" name="qtt" value="1">
                </label>        
            </p>
            <p>
                <input class="btnajouter" type="submit" name="submit" value="Ajouter le produit">

                <!-- on affiche le message que l'on a formaté dans "traitement.php" -->
                <?php echo $message; ?>
            </p>
        </form>
    </body>
</html>

<?php
    require_once "accueil.php";
?>