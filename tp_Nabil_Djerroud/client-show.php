<?php
require_once 'connex/db.php'; // Inclure le fichier de connexion à la base de données
require_once 'Classe/Client.php'; // Inclure la classe Client

if (isset($_GET['id'])) {
    // Récupérer l'ID du client à afficher
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
} else {
    echo "ID du client non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du client</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Détails du client</h2>
        <form action="client-show.php" method="GET">
            <label for="client_id">ID du client :</label><br>
            <input type="text" id="client_id" name="id" required><br><br>
            <input type="submit" value="Afficher le client">
        </form>
        <br>
        <?php if (isset($client)): ?>
            <p>ID: <?= $client['id'] ?></p>
            <p>Nom: <?= $client['nom'] ?></p>
            <p>Email: <?= $client['email'] ?></p>
            <p>Téléphone: <?= $client['telephone'] ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
