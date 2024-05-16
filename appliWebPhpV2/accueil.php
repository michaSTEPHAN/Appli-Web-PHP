<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title><?= $pageTitle; ?></title>
    </head>
    <body>
        <div class="container">
            <header>
                <nav>
                    <ul>
                        <li>
                            <a href="<?= $link; ?>"><?= $linkText; ?></a>
                        </li>
                    </ul>
                </nav>
                <!-- isset        -> Détermine si une variable est déclarée et est différente de null -->
                <!-- array_sum    -> Fait une somme sur les données d'un tableau -->
                <!-- array_column -> Sélectionne les données d'une colonne d'un tableau -->
                <i class="panier">Il y a <?= array_sum(array_column($_SESSION['produits'] ? $_SESSION['produits'] : [], 'qtt')); ?> produit(s) dans le panier !</i>
            </header>
        </div>
    </body>
</html>