<?php
require './connect.php'; 
$query = "SELECT articles.idarticle, articles.title, articles.content,articles.image, users.username, articles.created_at 
          FROM articles 
          JOIN users ON articles.iduser = users.iduser 
          ORDER BY articles.created_at DESC";

$result = $conn->query($query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">

     <!---------------- Navbar ------------------>
    <nav class="bg-white shadow-md py-4 px-6 flex items-center justify-between">
        <div class="text-2xl font-bold text-violet-600">BlogPlatform</div>

        <div class="flex gap-6 text-gray-700 font-bold">
            <a href="./index.php" class="hover:text-violet-500 " >Home</a>
            <a href="./tags.php" class="hover:text-violet-500">Tags</a>
            <a href="#" class="hover:text-violet-500">About</a>
            <a href="./my-articles.php" class="hover:text-violet-500">My Articles</a>
        </div>


        <div class="flex gap-4">
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
        </div>

    </nav>



    <!-------------------------- Hero--------------------->
    <div class="relative bg-cover bg-center h-[500px]" style="background-image: url('./hero4.jpg');">
        
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white gap-6">
            <h2 class="text-4xl font-bold mb-4">Unleash Your Creativity:<br> Create, Share, and Connect with the World</h2>
            <a href="./create-article.php" class="px-6 py-3 text-white bg-violet-500 rounded-lg text-lg font-semibold hover:bg-violet-600">Create Article</a>
        </div>
    </div>

    <!---------------------Articles----------------------->
    <div class="bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-6">Latest Articles</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc())  : ?>
                    <div class="p-6 bg-white rounded-lg shadow-md">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-violet-600 mb-2"><?= htmlspecialchars($row['title']) ?></h3>
                            <div class="text-[12px] text-gray-500">By <?= htmlspecialchars($row['username']) ?> on <?= date("j/M/Y", strtotime($row['created_at'])) ?></div>
                        </div>
  
                
                        <?php if (!empty($row['image'])): ?>
                            <img src="<?= $row['image'] ?>" alt="Article Image" class="w-full h-auto rounded-lg mb-4">
                        <?php else: ?>
                            <p class="text-red-500">Image not available</p>
                        <?php endif; ?>                        
                            <p class="text-gray-700 mb-4"><?= nl2br(htmlspecialchars($row['content'])) ?></p>
                           

                            <!---------------- Comments------------->
                            <h4 class="text-lg font-bold mb-2">Comments:</h4>
                            <?php
                            $idarticle = $row['idarticle'];
                            $stmt = $conn->prepare("SELECT c.idcomment, c.content, c.created_at, u.username FROM comments c INNER JOIN users u ON c.iduser = u.iduser WHERE c.idarticle = ? ORDER BY c.created_at ASC");
                            $stmt->bind_param("i", $idarticle);
                            $stmt->execute();
                            $comments = $stmt->get_result();

                            if ($comments->num_rows > 0):
                                while ($comment = $comments->fetch_assoc()):
                            ?>
                                    <div class="mb-2 p-2 border rounded-lg">
                                        <div class="flex justify-between items-center">
                                            <p class="text-sm text-gray-500"><?= htmlspecialchars($comment['username']) ?>:</p>
                                            <p class="text-[10px] text-gray-400"><?= date("F j, Y, g:i a", strtotime($comment['created_at'])) ?></p>
                                        </div>
                                        <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                                        <div class="flex gap-2 justify-end">
                                            
                                            <a href="./Comments/update-comment.php?idcomment=<?= $comment['idcomment'] ?>" class="p-2 text-blue-500 hover:text-blue-700">
                                                <i class="fa-solid fa-pen" style="color: #916dfd;"></i> 
                                            </a>
                                            
                                            <a href="./Comments/delete-comment.php?idcomment=<?= $comment['idcomment'] ?>" class="p-2 text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this comment?')">
                                                <i class="fa-solid fa-trash-can" style="color: #e92b2b;"></i> 
                                            </a>
                                        </div>
                                        
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-gray-500">No comments yet.</p>
                            <?php endif; ?>
                            <?php $stmt->close(); ?>

                            <!------------- add comment-------------->
                            <a href="./Comments/create-comment.php?idarticle=<?= $idarticle ?>" class="block mt-4 px-4 py-2 bg-violet-500 text-white text-center rounded-lg hover:bg-violet-600">Add Comment</a>

                            <div class="flex gap-4 justify-end">
                                <a href="./update-article.php?idarticle=<?= $row['idarticle'] ?>" class="p-2  text-blue ">
                                    <i class="fa-solid fa-pen-to-square" style="color: #916dfd;"></i>
                                </a>
                                <a href="./delete-article.php?idarticle=<?= $row['idarticle'] ?>" class="p-2 text-red " onclick="return confirm('Are you sure you want to delete this article?')">
                                    <i class="fa-solid fa-trash-can" style="color: #e92b2b;"></i>
                                </a>

                            </div>
                    </div>
                <?php endwhile; ?>

            <?php else: ?>
                <p>No articles found!</p>
            <?php endif; ?>

            </div>
        </div>
    </div>

    



</body>
</html>



