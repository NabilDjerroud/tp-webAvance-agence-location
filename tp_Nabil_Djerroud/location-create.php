<?php
require_once 'connex/db.php'; 
require_once 'Classe/Location.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $date_location = $_POST['date_location'];
    $date_retour = $_POST['date_retour'];
    $client_id = $_POST['client_id'];

    // Créer une nouvelle instance de la classe Location
    $location = new Location(null, $date_location, $date_retour, $client_id);

    // Insérer les données dans la base de données
    $sql = "INSERT INTO location (date_location, date_retour, client_id) VALUES (:date_location, :date_retour, :client_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':date_location', $date_location);
    $stmt->bindParam(':date_retour', $date_retour);
    $stmt->bindParam(':client_id', $client_id);
    
    if ($stmt->execute()) {
        // Rediriger vers la page d'affichage des locations après l'ajout
        header("Location: location-index.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de l'ajout de la location.";
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
    <h2>Ajouter une location</h2>
    <form action="" method="post">
        <label for="date_location">Date de location :</label><br>
        <input type="date" id="date_location" name="date_location" required><br>

        <label for="date_retour">Date de retour :</label><br>
        <input type="date" id="date_retour" name="date_retour" required><br>

        <label for="client_id">ID du client :</label><br>
        <input type="text" id="client_id" name="client_id" required><br><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
