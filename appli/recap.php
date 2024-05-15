<?php
    // On a besoin de "session_start" afin de pouvoir accéder aux données
    // de la session utilisateur.
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Récapitulatif des produits</title>
    </head>
    <body>        
        <?php 
            // Soit la clé "products" du tableau de session $_SESSION n'existe pas : !isset()
            // Soit cette clé existe mais ne contient aucune donnée : empty()
            if(!isset($_SESSION['produits']) || empty($_SESSION['produits']) ) {
                echo "<p>Aucun produit en session...</p>";
            } else {
                // Affichage des données dans un tableau HTML
                //      -> thead = entête de colonne
                //      -> body  = ligne de données produits
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
                                // On parcoure le formulaire "produits"
                                foreach($_SESSION['produits'] as $index => $produit) {
                                    echo "<tr>",
                                            "<td>".$index."</td>",
                                            "<td>".$produit['name']."</td>",
                                            "<td>".number_format($produit['price'],2,",","&nbsp;")."&nbsp;€</td>",
                                            "<td>".$produit['qtt']."</td>",
                                            "<td>".number_format($produit['total'],2,",","&nbsp;")."&nbsp;€</td>",
                                        "</tr>";
                                    $totalGeneral += $produit['total'];
                                }
                                // On affiche le total général
                                echo "<tr>",
                                        "<td colspan=4>Total général : </td>",
                                        "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",
                                      "</tr>",
                            "</body>",
                        "</table>";
            }
        ?>
    </body>
</html>