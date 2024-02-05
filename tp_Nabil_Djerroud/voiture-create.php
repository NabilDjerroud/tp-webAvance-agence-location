<?php
require_once 'connex/db.php';
require_once 'Classe/Voiture.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $prix_location = $_POST['prix_location'];

    // Créer une nouvelle instance de la classe Voiture
    $voiture = new Voiture(null, $marque, $modele, $annee, $prix_location);

    // Insérer les données dans la table 'voiture'
    $sql = "INSERT INTO voiture (marque, modele, annee, prix_location) VALUES (:marque, :modele, :annee, :prix_location)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':marque', $marque);
    $stmt->bindParam(':modele', $modele);
    $stmt->bindParam(':annee', $annee);
    $stmt->bindParam(':prix_location', $prix_location);

    if ($stmt->execute()) {
        // Rediriger vers la page d'accueil après l'ajout
        header("Location: agence-index.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la voiture.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une voiture</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
        <h2>Ajouter une voiture</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="marque">Marque :</label><br>
            <input type="text" id="marque" name="marque" required><br>
            <label for="modele">Modèle :</label><br>
            <input type="text" id="modele" name="modele" required><br>
            <label for="annee">Année :</label><br>
            <input type="text" id="annee" name="annee" required><br>
            <label for="prix_location">Prix de location :</label><br>
            <input type="text" id="prix_location" name="prix_location" required><br><br>
            <input type="submit" value="Ajouter la voiture">
        </form>
        <a href="voiture-index.php" class="btn">Revenir à la liste des voitures</a>
    </div>
</body>
</html>
