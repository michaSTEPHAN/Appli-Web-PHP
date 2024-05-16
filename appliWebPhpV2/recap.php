<?php
    // On a besoin de "session_start" afin de pouvoir accéder aux données
    // de la session utilisateur.
    session_start();
    $link = "index.php";
    $linkText = "Accueil";
    $pageTitle = "Récapitulatif des produits";

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
        <?php 
            // isset — Détermine si une variable est déclarée et est différente de null
            if(!isset($_SESSION['produits']) || empty($_SESSION['produits'])) {
                echo "<p>Aucun produit en session...</p>";
            } else {
                
                echo    "<table>",        
                            "<thead>",        
                                "<tr>",
                                    "<th>#</th>",
                                    "<th>Nom</th>",
                                    "<th>Prix</th>",
                                    "<th>Quantité</th>",
                                    "<th>Total</th>",
                                "</tr>",    
                            "</thead>",
                            "<body>";
                                $totalGeneral = 0;
                                foreach($_SESSION['produits'] as $index => $produit) {
                                    echo "<tr>",
                                            "<td>".$index."</td>",
                                            "<td>".$produit['name']."</td>",
                                            "<td>".number_format($produit['price'],2,",","&nbsp;")."&nbsp;€</td>",
                                            "<td>".$produit['qtt']."</td>",
                                            "<td>".number_format($produit['total'],2,",","&nbsp;")."&nbsp;€</td>",

                                            // On ajoute le bouton "Supprimer Produit"                                            
                                            "<td>                                        
                                                <form action='traitement.php?action=suppression' method='post'>
                                                    <input type='hidden' name='id' value='" . $index . "'>
                                                    <button class='bt-suppr-prod' type='submit' name='submit'>Suppression produit</button>
                                                </form>
                                            </td>",
                                        "</tr>";
                                    $totalGeneral += $produit['total'];
                                }
                                echo "<tr>",
                                        "<td colspan=4>Total général : </td>",
                                        "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",

                                        // On ajoute le bouton "Tout Supprimer"
                                        "<td>
                                            <form action='traitement.php?action=raz' method='post'>
                                                <button class='bt-suppr' type='submit' name='submit'>RAZ sur les produits</button>
                                            </form>
                                        </td>",
                                    "</tr>",                                    
                            "</body>",
                        "</table>";
            }
        ?>
        <!-- on affiche le message que l'on a formaté dans "traitement.php" -->
        <?php echo $message; ?>
    </body>
</html>

<?php
    include 'accueil.php';
?>