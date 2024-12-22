<?php
require '../connect.php';
session_start();

if (isset($_GET['idcomment'])) {
    $idcomment = $_GET['idcomment'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $content = $_POST['content'];

       
        $stmt = $conn->prepare("UPDATE comments SET content = ? WHERE idcomment = ?");
        $stmt->bind_param("si", $content, $idcomment);

       
        if ($stmt->execute()) {
            header("Location: ../index.php");
        } else {
            echo "Error: " . $stmt->error;
        }

       
        $stmt->close();
    } else {
        
        $stmt = $conn->prepare("SELECT content FROM comments WHERE idcomment = ?");
        $stmt->bind_param("i", $idcomment);
        $stmt->execute();
        $stmt->bind_result($content);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    echo "No comment ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Comment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-violet-600 mb-6">Update Comment</h1>
        <form method="POST">
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Comment:</label>
                <textarea id="content" name="content" rows="6" class="w-full px-4 py-2 border rounded-lg" required><?= htmlspecialchars($content) ?></textarea>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600">Update Comment</button>
        </form>
    </div>
</body>
</html>