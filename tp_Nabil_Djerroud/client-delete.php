<?php
require_once 'connex/db.php'; // Inclure le fichier de connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Récupérer l'ID du client à supprimer
    $id = $_POST['id'];

    // Supprimer le client de la base de données
    $sql = "DELETE FROM client WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Le client a été supprimé avec succès.";
        header("Location: client-index.php");
    exit();
    } else {
        echo "Une erreur est survenue lors de la suppression du client.";
    }
} elseif (isset($_GET['id'])) {
    // Si l'ID du client est passé en tant que paramètre GET, afficher un formulaire de confirmation de suppression
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un client</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Confirmer la suppression du client</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <p>Êtes-vous sûr de vouloir supprimer ce client ?</p>
        <input type="submit" value="Supprimer">
    </form>
    <a href="agence-index.php" class="btn">Revenir à l'accueil</a>

</body>
</html>
<?php
} else {
    // echo "Aucun client sélectionné pour la suppression.";
    // rediriger vers la page d'accueil
    header("Location: client-index.php");
    exit();
}
?>
