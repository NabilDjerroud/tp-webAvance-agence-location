<?php
require_once 'connex/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Mettre à jour les informations du client dans la base de données
    $sql = "UPDATE client SET nom = :nom, email = :email, telephone = :telephone WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Les informations du client ont été mises à jour avec succès.";
        header("Location: client-index.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de la mise à jour des informations du client.";
    }
} elseif (isset($_GET['id'])) {
    // Récupérer l'ID du client à mettre à jour
    $id = $_GET['id'];

    // Récupérer les informations du client depuis la base de données
    $sql = "SELECT * FROM client WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        echo "Client non trouvé.";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Modifier un client</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $client['id'] ?>">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" value="<?= $client['nom'] ?>" required><br>

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" value="<?= $client['email'] ?>" required><br>

        <label for="telephone">Téléphone :</label><br>
        <input type="text" id="telephone" name="telephone" value="<?= $client['telephone'] ?>"><br><br>

        <input type="submit" value="Mettre à jour">
    </form>
    <a href="agence-index.php" class="btn">Revenir à l'accueil</a>

</body>
</html>
<?php
} else {
    echo "ID du client non spécifié.";
    exit();
}
?>
