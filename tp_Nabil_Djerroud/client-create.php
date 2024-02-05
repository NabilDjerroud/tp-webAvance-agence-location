<?php
require_once 'connex/db.php'; 
require_once 'Classe/Client.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Créer une nouvelle instance de la classe Client
    $client = new Client(null, $nom, $email, $telephone);

    // Insérer les données dans la base de données
    $sql = "INSERT INTO client (nom, email, telephone) VALUES (:nom, :email, :telephone)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    
    if ($stmt->execute()) {
        echo "Le client a été ajouté avec succès.";
        header("Location: voiture-create.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de l'ajout du client.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Ajouter un client</h2>
    <form action="" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br>

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="telephone">Téléphone :</label><br>
        <input type="text" id="telephone" name="telephone"><br><br>

        <input type="submit" value="Ajouter">
    </form>
    <a href="agence-index.php" class="btn">Revenir à l'accueil</a>

</body>
</html>
