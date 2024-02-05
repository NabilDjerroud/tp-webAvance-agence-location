<?php
require_once 'connex/db.php'; 


$sql = "
    SELECT 
        c.id AS client_id, c.nom AS nom_client, c.email AS email_client,
        v.marque AS marque_voiture, v.modele AS modele_voiture, v.annee AS annee_voiture, v.prix_location AS prix_location_voiture,
        l.date_location AS date_location, l.date_retour AS date_retour
    FROM
        location l
    LEFT JOIN
        client c ON l.client_id = c.id
    LEFT JOIN
        voiture v ON l.id = v.id
    ORDER BY
        v.id DESC
";

$stmt = $pdo->query($sql);
$informations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les informations du dernier client ajouté s'il existe
$last_client = null;
$sql_last_client = "SELECT * FROM client ORDER BY id DESC LIMIT 1";
$stmt_last_client = $pdo->query($sql_last_client);
$last_client = $stmt_last_client->fetch(PDO::FETCH_ASSOC);

// Récupérer les informations de la dernière voiture ajoutée si elle existe
$last_voiture = null;
$sql_last_voiture = "SELECT * FROM voiture ORDER BY id DESC LIMIT 1";
$stmt_last_voiture = $pdo->query($sql_last_voiture);
$last_voiture = $stmt_last_voiture->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur les locations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Informations sur les locations actuelles</h1>
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
                <?php if ($last_client !== false && $last_voiture !== false): ?>
                <tr>
                <td><?= $last_client['id'] ?></td>
                    <td><?= $last_client['nom'] ?></td>
                    <td><?= $last_client['email'] ?></td>
                    <td><?= $last_voiture['marque'] ?></td>
                    <td><?= $last_voiture['modele'] ?></td>
                    <td><?= $last_voiture['annee'] ?></td>
                    <td><?= $last_voiture['prix_location'] ?></td>
                    <td><?= $info['date_location'] ?></td>
                    <td><?= $info['date_retour'] ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>        
        </table>
        <a href="client-create.php" class="btn">Ajouter un client</a>
        <a href="client-index.php" class="btn">Modifier un client</a>
        <a href="location-index.php" class="btn">Modifier une location</a>
        <a href="voiture-index.php" class="btn">Modifier une voiture</a>
    </div>
</body>
</html>
