<?php
require_once 'connex/db.php';
require_once 'Classe/Client.php'; 

// Récupérer la liste des clients depuis la base de données
$sql = "SELECT * FROM client";
$stmt = $pdo->query($sql);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Agence de location de voitures</h1>
    <div class="container">
        <h2>Liste des clients</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= $client['id'] ?></td>
                    <td><?= $client['nom'] ?></td>
                    <td><?= $client['email'] ?></td>
                    <td><?= $client['telephone'] ?></td>
                    <td>
                        <a href="client-edit.php?id=<?= $client['id'] ?>">Modifier</a>
                        <a href="client-delete.php?id=<?= $client['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="client-create.php" class="btn">Ajouter un nouveau client</a>
        <a href="agence-index.php" class="btn">Revenir à l'accueil</a>

    </div>
</body>
</html>
