<?php
$errors = [];

$name = isset($_GET['name']) ? trim($_GET['name']) : '';
if ($name === '') {
    $errors[] = 'Please enter your name.';
}

$email = isset($_GET['email']) ? trim($_GET['email']) : '';
if ($email === '') {
    $errors[] = 'Please enter your email.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

$birth_country = isset($_GET['birth_country']) ? $_GET['birth_country'] : '';
if ($birth_country === '') {
    $errors[] = 'Please select where you were born.';
}

$provinces = isset($_GET['province']) ? $_GET['province'] : [];
if (!is_array($provinces)) {
    $provinces = [$provinces];
}
if (count($provinces) === 0) {
    $errors[] = 'Please select at least one province you have visited.';
}

$coolest_country = isset($_GET['coolest_country']) ? trim($_GET['coolest_country']) : '';
if ($coolest_country === '') {
    $errors[] = 'Please enter the coolest country you have visited.';
}

$dream_country = isset($_GET['dream_country']) ? trim($_GET['dream_country']) : '';
if ($dream_country === '') {
    $errors[] = 'Please enter the country you would like to visit.';
}

$cruise = isset($_GET['cruise']) ? $_GET['cruise'] : '';
if ($cruise === '') {
    $errors[] = 'Please indicate whether you have ever been on a cruise.';
}

$resultCategory = '';
$resultText = '';
$travelScore = 0;

if (empty($errors)) {
    $provinceCount = count($provinces);
    if (in_array('None', $provinces)) {
        $provinceCount = 0;
    }

    $travelScore += $provinceCount;

    if ($cruise === 'Yes') {
        $travelScore += 2;
    }

    if ($travelScore <= 1) {
        $resultCategory = 'Homebody Traveller';
        $resultText = 'You enjoy staying close to home and keeping your trips simple and relaxed.';
    } elseif ($travelScore <= 4) {
        $resultCategory = 'Canadian Explorer';
        $resultText = 'You like discovering new places at a comfortable pace across Canada.';
    } else {
        $resultCategory = 'World Adventurer';
        $resultText = 'You love travelling often, visiting many regions, and saying yes to new experiences.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel quiz result</title>
    <link rel="stylesheet" href="my_style.css">
</head>
<body>
    <?php include_once('nav.php'); ?>

    <div class="body_wrapper">
        <h1>Travel quiz result</h1>

        <?php if (!empty($errors)): ?>
            <section class="error-box">
                <h2>There were some problems:</h2>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p><a href="my_form.php">Go back to the form</a></p>
            </section>
        <?php else: ?>
            <section>
                <p>
                    Thanks for filling out the form,
                    <strong><?php echo htmlspecialchars($name); ?></strong>!
                </p>
                <p>
                    Email: <?php echo htmlspecialchars($email); ?><br>
                    Born in: <?php echo htmlspecialchars($birth_country); ?>
                </p>

                <p>
                    Provinces visited:
                    <?php echo htmlspecialchars(implode(', ', $provinces)); ?>
                </p>

                <p>
                    Coolest country you have visited:
                    <?php echo htmlspecialchars($coolest_country); ?><br>
                    Dream trip:
                    <?php echo htmlspecialchars($dream_country); ?><br>
                    Been on a cruise:
                    <?php echo htmlspecialchars($cruise); ?>
                </p>

                <p>Your travel score: <strong><?php echo $travelScore; ?></strong></p>
                <p>
                    You visited <strong><?php echo $provinceCount; ?></strong> province(s)
                    <?php if ($cruise === 'Yes'): ?>
                      and you have been on a cruise, so you got extra points for that.
                    <?php else: ?>
                       and you have not been on a cruise yet.
                 <?php endif; ?>
                </p>
            </section>

            <section class="quiz-results">
                <h2>Your travel type</h2>
                
                <article class="result-card <?php echo ($resultCategory === 'Homebody Traveller') ? 'highlight-result' : ''; ?>">
                    <h3>
                        Homebody Traveller
                        <?php if ($resultCategory === 'Homebody Traveller'): ?>
                            <span class="result-badge">Your result</span>
                        <?php endif; ?>
                    </h3>
                    <p>You prefer shorter trips and familiar places.</p>
                </article>

                <article class="result-card <?php echo ($resultCategory === 'Canadian Explorer') ? 'highlight-result' : ''; ?>">
                    <h3>
                        Canadian Explorer
                        <?php if ($resultCategory === 'Canadian Explorer'): ?>
                            <span class="result-badge">Your result</span>
                        <?php endif; ?>
                    </h3>
                    <p>You like exploring different regions and mixing travel with your regular routine.</p>
                </article>

                <article class="result-card <?php echo ($resultCategory === 'World Adventurer') ? 'highlight-result' : ''; ?>">
                    <h3>
                        World Adventurer
                        <?php if ($resultCategory === 'World Adventurer'): ?>
                            <span class="result-badge">Your result</span>
                        <?php endif; ?>
                    </h3>
                    <p>You love to travel often, try new things, and visit many places.</p>
                </article>

                <p>
                    Based on your answers, you are a
                    <strong><?php echo htmlspecialchars($resultCategory); ?></strong>.
                </p>
                <p><?php echo htmlspecialchars($resultText); ?></p>
            </section>

        <?php endif; ?>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
