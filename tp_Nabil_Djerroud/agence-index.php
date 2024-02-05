<?php
require_once 'connex/db.php'; 

$sql = "
SELECT DISTINCT
    c.id AS client_id, c.nom AS nom_client, c.email AS email_client,
    l.date_location AS date_location, l.date_retour AS date_retour,
    v.marque AS marque_voiture, v.modele AS modele_voiture, v.annee AS annee_voiture, v.prix_location AS prix_location_voiture
FROM
    client c
LEFT JOIN
    location l ON c.id = l.client_id
LEFT JOIN
    voiture v ON l.voiture_id = v.id
ORDER BY 
    l.id DESC
";



$stmt = $pdo->query($sql);
$informations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur les locations, clients et voitures</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Informations sur les locations, clients et voitures</h1>
    <div class="container">
        <table>
            <tr>
                <th>Client ID</th>
                <th>Nom du client</th>
                <th>Email du client</th>
                <th>Marque de la voiture</th>
                <th>Modèle de la voiture</th>
                <th>Année de la voiture</th>
                <th>Prix de location de la voiture</th>
                <th>Date de location</th>
                <th>Date de retour</th>
            </tr>
            <?php foreach ($informations as $info): ?>
                <tr>
                    <td><?= $info['client_id'] ?></td>
                    <td><?= $info['nom_client'] ?></td>
                    <td><?= $info['email_client'] ?></td>
                    <td><?= $info['marque_voiture'] ?></td>
                    <td><?= $info['modele_voiture'] ?></td>
                    <td><?= $info['annee_voiture'] ?></td>
                    <td><?= $info['prix_location_voiture'] ?></td>
                    <td><?= $info['date_location'] ?></td>
                    <td><?= $info['date_retour'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="client-create.php" class="btn">Ajouter un client</a>
        <a href="client-index.php" class="btn">Modifier un client</a>
        <a href="location-index.php" class="btn">Modifier une location</a>
        <a href="voiture-index.php" class="btn">Modifier une voiture</a>
    </div>
</body>
</html>
