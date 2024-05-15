<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajout Produit</title>
    </head>
    <body>
        <h1>Ajouter un produit</h1>

        <!-- la balise <form> comporte deux attributs : -->
        <!--   -> action (qui indique la cible du formulaire, le fichier à atteindre lorsque l'utilisateur soumettra le formulaire) -->
        <!--   -> method (qui précise par quelle méthode HTTP les données du formulaire seront transmises au serveur) -->
        <form action="traitement.php" method="post">
            <p>
                <!-- label = champ de saisie -->
                <label>
                    Nom de produit :
                    <input type="text" name="name">
                </label>
            </p>
            <p>
                <label>
                    Prix du produit :
                    <input type="number" step="any" name="price">
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée :
                    <input type="number" name="qtt" value="1">
                </label>        
            </p>
            <p>
                <!-- bouton de soumission du formulaire -->
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </body>
</html>