<?php
require_once 'connex/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM voiture WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header("Location: voiture-index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de la voiture.";
    }
} else {
    echo "ID de la voiture non spécifié.";
}
?>
