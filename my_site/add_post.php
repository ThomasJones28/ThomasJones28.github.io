<?php
// Model section
// Page for adding new blog post
require_once 'config.php';
session_start();

$is_logged_in = !empty($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;

$blog_file = 'blog.json';
$posts = [];
$error = '';
$success = '';

$id = '';
$title = '';
$date = '';
$paragraphs_text = '';

// Load existing posts
if (file_exists($blog_file)) {
    $json_data = file_get_contents($blog_file);
    $data = json_decode($json_data, true);
    if (is_array($data)) {
        $posts = $data;
    }
}

// Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$is_logged_in) {
        $error = 'You must be logged in to add a post.';
    } else {
        // Get form values
        $id = isset($_POST['id']) ? trim($_POST['id']) : '';
        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $date = isset($_POST['date']) ? trim($_POST['date']) : '';
        $paragraphs_text = isset($_POST['paragraphs']) ? trim($_POST['paragraphs']) : '';

        // Field Validation
        if ($id === '' || $title === '' || $date === '' || $paragraphs_text === '') {
            $error = 'Please fill in all fields.';
        } else {
            // Ensure id is unique
            foreach ($posts as $post) {
                if ($post['id'] === $id) {
                    $error = 'This post id is already used. Please choose another one.';
                    break;
                }
            }
        }

        if ($error === '') {
            // Split paragraphs
            $lines = preg_split('/\r\n|\r|\n/', $paragraphs_text);
            $paragraphs = [];
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line !== '') {
                    $paragraphs[] = $line;
                }
            }

            // Build new post
            $new_post = [
                'id' => $id,
                'title' => $title,
                'date' => $date,
                'paragraphs' => $paragraphs
            ];

            $posts[] = $new_post;

            // Saves back to JSON file
            $result = file_put_contents($blog_file, json_encode($posts, JSON_PRETTY_PRINT));

            if ($result === false) {
                $error = 'Could not save the new post to the blog file.';
            } else {
                $success = 'New post added successfully.';
                // Displays form values after a successful insert
                $id = '';
                $title = '';
                $date = '';
                $paragraphs_text = '';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Blog Post</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include_once('nav.php'); ?>

    <div class="body_wrapper">
        <h1>Add a New Blog Post</h1>

        <?php if (!$is_logged_in): ?>
            <!-- User must be logged in-->
            <p>You must be logged in to add a blog post.</p>
            <p><a href="login.php?redirect=add_post.php">Go to login page</a></p>
        <?php else: ?>
            <!-- Display error/sucess messages -->
            <?php if ($error !== ''): ?>
                <p class="blog-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if ($success !== ''): ?>
                <p class="blog-message" style="color: green;"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>

            <!-- View section, form to add post -->
            <form action="add_post.php" method="post">
                <fieldset>
                    <legend>Add a new blog entry</legend>

                    <p>
                        <label for="id">Post id (for the anchor, no spaces, e.g. post-fourth-year):</label><br>
                        <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    </p>

                    <p>
                        <label for="title">Title:</label><br>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>">
                    </p>

                    <p>
                        <label for="date">Date (text):</label><br>
                        <input type="text" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
                    </p>

                    <p>
                        <label for="paragraphs">Text (write each paragraph on a new line):</label><br>
                        <textarea id="paragraphs" name="paragraphs" rows="8" cols="60"><?php
                            echo htmlspecialchars($paragraphs_text);
                        ?></textarea>
                    </p>

                    <p>
                        <input type="submit" value="Add post">
                    </p>
                </fieldset>
            </form>

            <p><a href="blog.php">Back to blog</a></p>
        <?php endif; ?>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
