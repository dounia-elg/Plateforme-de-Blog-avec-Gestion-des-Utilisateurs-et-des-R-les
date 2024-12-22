<?php
require '../connect.php';
session_start();

if (!isset($_SESSION['iduser'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['idarticle'])) {
    die("Article ID not provided.");
}

$idarticle = intval($_GET['idarticle']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $iduser = $_SESSION['iduser'];

    $stmt = $conn->prepare("INSERT INTO comments (idarticle, iduser, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $idarticle, $iduser, $content);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Failed to add comment.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-2xl mx-auto mt-10 bg-white p-8 shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-violet-600 mb-6">Add a Comment</h1>

    <?php if (isset($error)): ?>
        <p class="text-red-500"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Your Comment:</label>
            <textarea id="content" name="content" rows="5" class="w-full px-4 py-2 border rounded-lg" required></textarea>
        </div>
        <button type="submit" class="w-full px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600">Add Comment</button>
    </form>
</div>
</body>
</html>
