<?php
require_once 'connex/db.php';

// Récupérer la liste des voitures depuis la base de données
$sql = "SELECT * FROM voiture";
$stmt = $pdo->query($sql);
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des voitures</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Liste des voitures</h1>
    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Prix de location</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($voitures as $voiture): ?>
                <tr>
                    <td><?= $voiture['id'] ?></td>
                    <td><?= $voiture['marque'] ?></td>
                    <td><?= $voiture['modele'] ?></td>
                    <td><?= $voiture['annee'] ?></td>
                    <td><?= $voiture['prix_location'] ?></td>
                    <td>
                        <a href="voiture-edit.php?id=<?= $voiture['id'] ?>">Modifier</a>
                        <a href="voiture-delete.php?id=<?= $voiture['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="voiture-create.php" class="btn">Ajouter une nouvelle voiture</a>
        <a href="agence-index.php" class="btn">Revenir à l'accueil</a>

    </div>
</body>
</html>
