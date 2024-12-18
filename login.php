<?php
require './connect.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT iduser, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['iduser'] = $user['iduser'];

        
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" class="bg-white p-8 rounded shadow-lg w-full max-w-sm">

        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Login</h2>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" name="email" id="email" placeholder="Your email" require class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <input type="password" name="password" id="password" placeholder="Your password" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>

        <button type="submit"class="w-full px-4 py-2 font-semibold text-white bg-violet-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-violet-400">Login</button>
        <p class="mt-4 text-sm text-center text-gray-600">Don't have an account? <a href="./register.php" class="text-violet-500 hover:underline">Register here</a></p>
    </form>
</body>
</html>

