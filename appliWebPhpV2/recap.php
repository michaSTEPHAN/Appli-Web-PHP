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
                                    "<th> </th>",
                                    "<th>Qté</th>",
                                    "<th> </th>",
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

                                            // On ajoute le bouton "+"                                            
                                            "<td>                                        
                                                <a class='btn-qtPlus' href='traitement.php?action=augmentation-qtt&id=$index'>+</a>
                                            </td>",

                                            "<td>".$produit['qtt']."</td>",    
                                            
                                            // On ajoute le bouton "-"                                            
                                            "<td>                                        
                                                <a class='btn-qtMoins' href='traitement.php?action=diminution-qtt&id=$index'>-</a>
                                            </td>",

                                            "<td>".number_format($produit['total'],2,",","&nbsp;")."&nbsp;€</td>",

                                            // On ajoute le bouton "Supprimer Produit"                                            
                                            "<td>                                        
                                               <a class='btn-sup' href='traitement.php?action=suppression&id=$index'>Supprimer</a>
                                            </td>",

                                        "</tr>";
                                    $totalGeneral += $produit['total'];
                                }
                                echo "<tr>",
                                        "<td colspan=6>Total général : </td>",
                                        "<td><strong>".number_format($totalGeneral,2,",","&nbsp;")."&nbsp;€</strong></td>",

                                        // On ajoute le bouton "Tout Supprimer"
                                        "<td>                                        
                                            <a class='btn-raz' href='traitement.php?action=raz'>RAZ</a>
                                        </td>",

                                        // "<td>
                                        //     <form action='traitement.php?action=raz' method='post'>
                                        //         <button class='bt-suppr' type='submit' name='submit'>RAZ sur les produits</button>
                                        //     </form>
                                        // </td>",
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