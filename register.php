<?php
require './connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    
    $idrole = 2; 

    
    $roleCheck = $conn->prepare("SELECT idrole FROM roles WHERE idrole = ?");
    $roleCheck->bind_param("i", $idrole);
    $roleCheck->execute();
    $roleCheck->store_result();

    if ($roleCheck->num_rows > 0) {
        
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, idrole) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $email, $hashedPassword, $idrole);
        

        if ($stmt->execute()) {
            echo "Registration successful. <a href='./login.php'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: The specified role does not exist. Please contact the administrator.";
    }

    $roleCheck->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('./fooorm.jpg');">
    <form method="POST" class="bg-white p-8 rounded shadow-lg w-full max-w-sm">

        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Register</h2>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
            <input type="text" name="name" id="name" placeholder="Your name" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" name="email" id="email" placeholder="Your email" require class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
            <input type="password" name="password" id="password" placeholder="Your password" required class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-400">
        </div>
        <button type="submit"class="w-full px-4 py-2 font-semibold text-white bg-violet-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-violet-400">Register</button>
        <p class="mt-4 text-sm text-center text-gray-600">Already have an account?<a href="./login.php" class="text-violet-500 hover:underline">Login here</a></p>
    </form>
</body>
</html>
