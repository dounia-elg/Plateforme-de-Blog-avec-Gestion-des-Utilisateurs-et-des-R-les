<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!------------ Navbar ---------->
    <nav class="bg-violet-900 text-white p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Blog</a>
            <div>
                <a href="#" class="hover:text-gray-200">Accueil</a>
                <a href="#" class="ml-4 hover:text-gray-200">Tags</a>
                <a href="./login.php" class="ml-4 hover:text-gray-200">Connexion</a>
                <a href="./register.php" class="ml-4 hover:text-gray-200">Inscription</a>
                
            </div>
        </div>
    </nav>

    <!----------- Hero Section ---------->
    <section class="bg-violet-700 text-white text-center py-16">
        <h1 class="text-4xl font-bold">Bienvenue sur notre Blog</h1>
        <p class="mt-4 text-lg">Lisez et partagez vos idées.</p>
    </section>

    <!---------- Articles List ----------->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Articles</h2>

            
            <div class="bg-white p-6 mb-4 shadow-md rounded-lg">
                <h3 class="text-xl font-semibold text-gray-800">Titre de l'Article</h3>
                <p class="mt-2 text-gray-600">description de l'article</p>
                <a href="#" class="text-blue-600 mt-2 inline-block">Lire plus</a>
            </div>

            
            
        </div>
    </section>

    <!----------- Tags Section --------------->
    <section class="py-8 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tags</h2>
            <div>
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-full inline-block mb-2 mr-2">Technologie</a>
                <a href="#" class="bg-green-500 text-white px-4 py-2 rounded-full inline-block mb-2 mr-2">Design</a>
                <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded-full inline-block mb-2 mr-2">Éducation</a>
            </div>
        </div>
    </section>

</body>
</html>
