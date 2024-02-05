<?php
require_once 'connex/db.php'; 

// Récupérer la liste des locations depuis la base de données
$sql = "SELECT * FROM location";
$stmt = $pdo->query($sql);
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des locations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Liste des locations</h1>
    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Date de location</th>
                <th>Date de retour</th>
                <th>Client ID</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($locations as $location): ?>
                <tr>
                    <td><?= $location['id'] ?></td>
                    <td><?= $location['date_location'] ?></td>
                    <td><?= $location['date_retour'] ?></td>
                    <td><?= $location['client_id'] ?></td>
                    <td>
                        <a href="location-edit.php?id=<?= $location['id'] ?>">Modifier</a>
                        <a href="location-delete.php?id=<?= $location['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette location ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="location-create.php" class="btn">Ajouter une nouvelle location</a>
        <a href="agence-index.php" class="btn">Revenir à l'accueil</a>
    </div>
</body>
</html>
