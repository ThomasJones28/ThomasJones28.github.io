<?php
//Model section
//See if user is logged in
require_once 'config.php';
session_start();

//Loads blog posts from JSON file
//Useful for changing content without changing HTML structure
$blog_file = 'blog.json';
$posts = [];
$delete_message = '';
//Load JSOn posts if they exist
if (file_exists($blog_file)) {
    $json_data = file_get_contents($blog_file);
    $data = json_decode($json_data, true);

    if (is_array($data)) {
        $posts = $data;
    }
    //Delete request while logged in
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['delete_id']) &&
        !empty($_SESSION['is_logged_in']) &&
        $_SESSION['is_logged_in'] === true
    ) {
        $delete_id = $_POST['delete_id'];

        $kept_posts = [];
        foreach ($posts as $post) {
            if ($post['id'] !== $delete_id) {
                $kept_posts[] = $post;
            }
        }

        // Only updats file if something was deleted
        if (count($kept_posts) < count($posts)) {
            $result = file_put_contents($blog_file, json_encode($kept_posts, JSON_PRETTY_PRINT));
            
            if ($result === false) {
                $delete_message = 'Could not save changes to blog file.';
            } else {
            $posts = $kept_posts;
            $delete_message = 'Post deleted successfully.';
            }
        } else {
            $delete_message = 'Could not delete post.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="my_style.css">
    <script src="blog.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include_once('nav.php'); ?>
    <div class="blog-login">
        <?php if (!empty($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
            <!-- Log out button for logged in users -->
            <form action="login.php" method="post" style="display: inline;">
                <input type="hidden" name="logout" value="1">
                <button type="submit">Log out</button>
            </form>
        <?php else: ?>
            <!-- Link to login page for users not logged in-->
            <a href="login.php?redirect=blog.php">Login</a>
        <?php endif; ?>
    </div>
    <section class="hero">
        <h1>My University Journey</h1>
        <p>This blog covers my 4 year journey as a student-athelete at Bishop's University. It will cover key events in my academic, athletic, and personal lives and how these events played a roll into shaping where I am currently at today.</p>
    </section>
    <?php if (!empty($delete_message)): ?>
        <p class="blog-message"><?php echo htmlspecialchars($delete_message); ?></p>
    <?php endif; ?>

    <div class="blog-layout">
        <main>
            <!--View section-->
            <!--Blog posts--> 
            <!--Loops posts from JSON File to display each article-->
            <?php foreach ($posts as $post): ?>
            <article id="<?php echo htmlspecialchars($post['id']); ?>">
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><i><?php echo htmlspecialchars($post['date']); ?></i></p>

                <?php if (!empty($post['paragraphs']) && is_array($post['paragraphs'])): ?>
                    <?php foreach ($post['paragraphs'] as $para): ?>
                        <p><?php echo htmlspecialchars($para); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                    <!--Delete button only when logged in-->
                    <form class="delete-post-form" action="blog.php" method="post">
                        <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($post['id']); ?>">
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
        </main>
        <aside>
            <!-- Aside section for quick links to blog posts -->
            <h3>Posts</h3>
            <ul>
                <?php foreach ($posts as $post): ?>
                    <li>
                        <a href="#<?php echo htmlspecialchars($post['id']); ?>">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
    <?php include_once('footer.php'); ?>
</body>
</html>