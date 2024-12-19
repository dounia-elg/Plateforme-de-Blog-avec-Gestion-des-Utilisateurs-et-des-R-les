<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

     <!---------------- Navbar ------------------>
    <nav class="bg-white shadow-md py-4 px-6 flex items-center justify-between">
        <div class="text-2xl font-bold text-violet-600">BlogPlatform</div>

        <div class="flex gap-6 text-gray-700 font-bold">
            <a href="./index.php" class="hover:text-violet-500 " >Home</a>
            <a href="./tags.php" class="hover:text-violet-500">Tags</a>
            <a href="#" class="hover:text-violet-500">About</a>
            <a href="#" class="hover:text-violet-500">My Article</a>
        </div>


        <!-- <div class="flex gap-4">
            <?php
            session_start();
            if (isset($_SESSION['username'])) {
                echo '<span class="text-2xl font-bold text-violet-600 ">Welcome , ' . htmlspecialchars($_SESSION['username']) . '!</span>';
                
                echo '<a href="./logout.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Logout</a>';
            } else {
                echo '<a href="./login.php" class="px-4 py-2 bg-violet-500 text-white rounded-lg hover:bg-violet-600">Login</a>';
                echo '<a href="./register.php" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Sign up</a>';
            }
            ?>
        </div> -->

    </nav>



    <!-------------------------- Hero--------------------->
    <div class="relative bg-cover bg-center h-[500px]" style="background-image: url('./hero4.jpg');">
        
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white gap-6">
            <h2 class="text-4xl font-bold mb-4">Unleash Your Creativity:<br> Create, Share, and Connect with the World</h2>
            <a href="./create-article.php" class="px-6 py-3 text-white bg-violet-500 rounded-lg text-lg font-semibold hover:bg-violet-600">Create Article</a>
        </div>
    </div>



</body>
</html>



