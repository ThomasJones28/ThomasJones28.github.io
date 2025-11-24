<?php
//Model section
//Loads blog posts from JSON file
//Useful for changing content without changing HTML structure
$blog_file = 'blog.json';
$posts = [];

if (file_exists($blog_file)) {
    $json_data = file_get_contents($blog_file);
    $data = json_decode($json_data, true);

    if (is_array($data)) {
        $posts = $data;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include_once('nav.php'); ?>
    <section class="hero">
        <h1>My University Journey</h1>
        <p>This blog covers my 4 year journey as a student-athelete at Bishop's University. It will cover key events in my academic, athletic, and personal lives and how these events played a roll into shaping where I am currently at today.</p>
    </section> 
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