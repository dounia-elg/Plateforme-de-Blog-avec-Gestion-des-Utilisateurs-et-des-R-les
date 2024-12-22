<?php
require './connect.php'; 
session_start();


if (isset($_GET['idarticle'])) {
    $idarticle = $_GET['idarticle'];

    
    $stmt = $conn->prepare("SELECT * FROM articles WHERE idarticle = ? AND iduser = ?");
    $stmt->bind_param("ii", $idarticle, $_SESSION['iduser']);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();

    if (!$article) {
        die("You are not authorized to edit this article.");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_POST['image'];

        $stmt = $conn->prepare("UPDATE articles SET title = ?, content = ?, image = ? WHERE idarticle = ?");
        $stmt->bind_param("sssi", $title, $content, $image, $idarticle);

        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

} else {
    die("No article ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-violet-600 mb-6">Update Article</h1>

        <form method="POST">
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-lg" 
                       value="<?= htmlspecialchars($article['title']) ?>" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content:</label>
                <textarea id="content" name="content" rows="6" class="w-full px-4 py-2 border rounded-lg" required><?= htmlspecialchars($article['content']) ?></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image URL:</label>
                <input type="text" id="image" name="image" class="w-full px-4 py-2 border rounded-lg" 
                       value="<?= htmlspecialchars($article['image']) ?>" required>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600">Update Article</button>
        </form>
    </div>
</body>
</html>
