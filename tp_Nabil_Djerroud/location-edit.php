<?php
require_once 'connex/db.php'; 
require_once 'Classe/Location.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $date_location = $_POST['date_location'];
    $date_retour = $_POST['date_retour'];
    $client_id = $_POST['client_id'];

    // Mettre à jour les données dans la table 'location'
    $sql = "UPDATE location SET date_location = :date_location, date_retour = :date_retour, client_id = :client_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':date_location', $date_location);
    $stmt->bindParam(':date_retour', $date_retour);
    $stmt->bindParam(':client_id', $client_id);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Rediriger vers la page d'affichage des locations après la modification
        header("Location: location-index.php");
        exit();
    } else {
        echo "Erreur lors de la modification de la location.";
    }
} elseif (isset($_GET['id'])) {
    // Récupérer l'ID de la location à modifier depuis l'URL
    $id = $_GET['id'];

    // Récupérer les informations de la location depuis la base de données
    $sql = "SELECT * FROM location WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $location = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$location) {
        echo "Location non trouvée.";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une location</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <h2>Modifier une location</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $location['id'] ?>">
        <label for="date_location">Date de location :</label><br>
        <input type="date" id="date_location" name="date_location" value="<?= $location['date_location'] ?>" required><br>

        <label for="date_retour">Date de retour :</label><br>
        <input type="date" id="date_retour" name="date_retour" value="<?= $location['date_retour'] ?>" required><br>

        <label for="client_id">ID du client :</label><br>
        <input type="text" id="client_id" name="client_id" value="<?= $location['client_id'] ?>" required><br><br>

        <input type="submit" value="Modifier">
    </form>
</body>
</html>
<?php
} else {
    echo "ID de la location non spécifié.";
    exit();
}
?>
