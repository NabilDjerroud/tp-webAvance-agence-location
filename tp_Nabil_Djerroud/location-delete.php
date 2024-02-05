<?php
require_once 'connex/db.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM location WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header("Location: location-index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de la location.";
    }
} else {
    echo "ID de la location non spécifié.";
}
?>
