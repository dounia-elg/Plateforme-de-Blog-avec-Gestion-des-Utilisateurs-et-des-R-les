<?php
session_start();
require 'connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    
    if (!empty($email) && !empty($password)) {
        
        $query = $db->prepare('SELECT * FROM users WHERE email = ? ');
        $query->bind_param('s', $email, $email);
        $query->execute();
        $result = $query->get_result();
        $email = $result->fetch_assoc();

        
        if ($email && password_verify($password, $user['password'])) {
            
            $_SESSION['user'] = $user['iduser'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['idrole'];

            
            header('Location: index.php');
            exit();
        } else {
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Connexion</h2>

       
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        
        <form action="login.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium">Email</label>
                <input type="text" name="username" id="username" 
                       class="w-full mt-2 p-3 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                       required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">Mot de passe</label>
                <input type="password" name="password" id="password" 
                       class="w-full mt-2 p-3 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            
            <button type="submit" 
                    class="w-full bg-violet-600 text-white py-3 rounded-lg hover:bg-violet-700 transition">Connexion</button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">Pas encore inscrit ? <a href="./register.php" class="text-violet-600 hover:underline">Créer un compte</a></p>
    </div>

</body>
</html>
