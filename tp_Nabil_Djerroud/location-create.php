<?php
require_once 'connex/db.php';

// Récupérer les informations du dernier client ajouté
$sql_last_client = "SELECT * FROM client ORDER BY id DESC LIMIT 1";
$stmt_last_client = $pdo->query($sql_last_client);
$last_client = $stmt_last_client->fetch(PDO::FETCH_ASSOC);

// Récupérer les informations de la dernière voiture ajoutée
$sql_last_voiture = "SELECT * FROM voiture ORDER BY id DESC LIMIT 1";
$stmt_last_voiture = $pdo->query($sql_last_voiture);
$last_voiture = $stmt_last_voiture->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $client_id = $_POST['client_id'];
    $voiture_id = $_POST['voiture_id'];
    $date_location = $_POST['date_location'];
    $date_retour = $_POST['date_retour']; // Ajout de la date de retour

    // Validation de l'ID de la voiture
    $stmt_validate_voiture = $pdo->prepare("SELECT id FROM voiture WHERE id = :voiture_id");
    $stmt_validate_voiture->bindParam(':voiture_id', $voiture_id);
    $stmt_validate_voiture->execute();

    if ($stmt_validate_voiture->rowCount() == 0) {
        echo "Erreur : ID de voiture invalide.";
        exit();
    }

    // Insérer les données dans la table 'location'
    $sql = "INSERT INTO location (date_location, date_retour, client_id, voiture_id) VALUES (:date_location, :date_retour, :client_id, :voiture_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':date_location', $date_location);
    $stmt->bindParam(':date_retour', $date_retour);
    $stmt->bindParam(':client_id', $client_id);
    $stmt->bindParam(':voiture_id', $voiture_id);

    if ($stmt->execute()) {
        // Rediriger vers la page d'affichage des locations après l'ajout
        header("Location: agence-index.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la location.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une location</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter une location</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="client_id">ID du client :</label><br>
            <input type="text" id="client_id" name="client_id" value="<?php echo $last_client['id']; ?>" required><br>
            <label for="voiture_id">ID de la voiture :</label><br>
            <input type="text" id="voiture_id" name="voiture_id" value="<?php echo $last_voiture['id']; ?>" required><br>
            <label for="date_location">Date de location :</label><br>
            <input type="date" id="date_location" name="date_location" required><br>
            <label for="date_retour">Date de retour :</label><br>
            <input type="date" id="date_retour" name="date_retour" required><br><br>
            <input type="submit" value="Ajouter la location">
        </form>
        <a href="agence-index.php" class="btn">Revenir à l'accueil</a>
    </div>
</body>
</html>
