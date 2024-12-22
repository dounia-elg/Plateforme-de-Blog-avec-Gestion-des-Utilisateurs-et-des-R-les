<?php
require './connect.php';
session_start();

if (isset($_GET['idarticle'])) {
    $idarticle = $_GET['idarticle'];

    
    $stmt = $conn->prepare("SELECT iduser FROM articles WHERE idarticle = ?");
    $stmt->bind_param("i", $idarticle);
    $stmt->execute();
    $stmt->bind_result($iduser);
    $stmt->fetch();
    $stmt->close();

    
    if ($iduser !== $_SESSION['iduser']) {
        die("You are not authorized to delete this article.");
    }

    
    $stmt = $conn->prepare("DELETE FROM articles WHERE idarticle = ?");
    $stmt->bind_param("i", $idarticle);

    if ($stmt->execute()) {
        header("Location: index.php?status=deleted");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No article ID provided.";
}
?>
