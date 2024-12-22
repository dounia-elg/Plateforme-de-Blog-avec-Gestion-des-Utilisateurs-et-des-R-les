<?php
require '../connect.php';
session_start();

if (isset($_GET['idcomment'])) {
    $idcomment = (int) $_GET['idcomment'];
    $iduser = $_SESSION['iduser']; 

    
    $stmt = $conn->prepare("DELETE FROM comments WHERE idcomment = ? AND iduser = ?");
    $stmt->bind_param("ii", $idcomment, $iduser);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            
            header("Location: ../index.php?status=success");
        } else {
            
            echo "You are not authorized to delete this comment.";
        }
    } else {
        echo "Error deleting comment: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No comment ID provided.";
}
?>
