<?php
require '../connect.php';

if (isset($_GET['idcomment'])) {
    $idcomment = (int) $_GET['idcomment'];
    $stmt = $conn->prepare ("DELETE FROM comments WHERE idcomment = ?");
    $stmt->bind_param("i", $idcomment);

    if ($stmt->execute()){
        header("Location: ../index.php?status=success");
    }else{
        echo "Error:" . $stmt->error;
    }

    $stmt->close();
}else {
        echo "Error deleting comment: " . $stmt->error;
    echo "No comment ID provided.";
}
?>