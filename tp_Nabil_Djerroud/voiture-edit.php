<?php
require_once 'connex/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $prix_location = $_POST['prix_location'];

    $sql = "UPDATE voiture SET marque = :marque, modele = :modele, annee = :annee, prix_location = :prix_location WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':marque', $marque);
    $stmt->bindParam(':modele', $modele);
    $stmt->bindParam(':annee', $annee);
    $stmt->bindParam(':prix_location', $prix_location);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: voiture-index.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de la voiture.";
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM voiture WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $voiture = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "ID de la voiture non spécifié.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une voiture</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Modifier une voiture</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $voiture['id']; ?>">
            <label for="marque">Marque :</label><br>
            <input type="text" id="marque" name="marque" value="<?php echo $voiture['marque']; ?>" required><br>
            <label for="modele">Modèle :</label><br>
            <input type="text" id="modele" name="modele" value="<?php echo $voiture['modele']; ?>" required><br>
            <label for="annee">Année :</label><br>
            <input type="number" id="annee" name="annee" value="<?php echo $voiture['annee']; ?>" required><br>
            <label for="prix_location">Prix de location :</label><br>
            <input type="number" id="prix_location" name="prix_location" value="<?php echo $voiture['prix_location']; ?>" required><br><br>
            <input type="submit" value="Modifier la voiture">
        </form>
        <a href="agence-index.php" class="btn">Revenir à l'accueil</a>

    </div>
</body>
</html>
