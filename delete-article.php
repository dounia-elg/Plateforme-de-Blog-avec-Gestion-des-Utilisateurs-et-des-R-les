<?php
require './connect.php';

if (isset($_GET['idarticle'])){
    $idarticle = $_GET['idarticle'];

    $stmt = $conn->prepare ("DELETE FROM articles WHERE idarticle = ?");
    $stmt->bind_param("i", $idarticle);

    if ($stmt->execute()){
        header("Location: index.php");
    }else{
        echo "Error:" . $stmt->error;
    }

    $stmt->close();
}else {
    echo "No article ID provided.";
}

?>