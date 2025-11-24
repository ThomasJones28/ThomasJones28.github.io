<?php
//Model section
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
            <!--Blog posts--> 
            <article id="post-first-year">
                <h2>First Year First Semester</h2>
                <p><i>December 2022</i></p>
                <p>I first arrived to campus in the third week of August, when lacrosse training camp started. I moved into Munster residence, met my teammates, and ate at Dewies for the first time! The team performed really well, finishing with a 7-3 record, and making it to the quarter-finals before losing to Brock. More importantly, I bonded with my fellow freshmen teammates, and together we are all family already.</p>
                <p>I am also now experienced with the University. I have been to the gait, the lion, the plex, the library, the sub, and all the buildings where my classes are located. Me and my teammates often meet-up at Little Forks to hang out with the older guys on the team.</p>
            </article>
            <article id="post-second-year">
                <h2>Second Year First Semester</h2>
                <p><i>December 2023</i></p>
                <p>I moved into Little Forks with my two teammates back last May, but have just finished my first semester living off-campus! It was a rocky semester to say the least. I was named a starter to open the lacrosse season, where I was doing quite well until I got concussed in the 5th game. I used the month off to also rest my feet which have been hurting since May. My AT gave me two aircasts to wear while I was concussed. This got me lots of stares and confused looks, but it made for a great astronaut costume for Halloween!</p>
                <p>I was able to come back for our first game of playoffs, where I scored 3 goals to almost complete the comeback, but unfortunately we lost to Carleton.</p>
                <p>I met a nice girl back in September, her name is Jolie and she's from Vancouver.</p>
                <p>It was quite tough keeping up with all my. school work I missed while concussed, but I just finished exams and think I did well! We will see later I guess!</p>
                <p>I am now hoping to figure out what on earth is wrong with my heels before the summer lacrosse season starts. Hopefully I'll get some answers!</p>
            </article>
            <article id="post-third-year">
                <h2>Third Year First Semester</h2>
                <p><i>December 2024</i></p>
                <p>After significantly improving my grades last year, I think I am on track to improve them even more after just writing my first semester exams. I realized that with just a little bit of planning, and simply attending classes goes a long way! My parents were quite happy to hear about my scholarship, and I am now motivated to earn a bigger one for next year!</p>
                <p>My lacrosse season was bittersweet. We had a historically bad season, finishing 2-8 which is the worst in Gaiters Lacrosse history. However, I personally had a great season, leading the team in goals and completeing my goal of playing in all 10 games (something I was worried about with my feet problems)</p>
                <p>I am now prepping to get PRP injections in one of my heels in January, and if all goes well I will get the other one done and be ready to play my final summer season of lacrosse!</p>
                <p>Jolie and I are doing well, having celebrated our 1 year anniversary in November and catching up on FaceTime over the Xmas break.</p>
            </article>
        </main>
        <aside>
            <!--blog links-->
            <h3>Posts</h3>
            <ul>
                <li><a href="#post-first-year">First Year First Semester</a></li>
                <li><a href="#post-second-year">Second Year First Semester</a></li>
                <li><a href="#post-third-year">Third Year First Semester</a></li>
            </ul>
        </aside>
    </div>
    <?php include_once('footer.php'); ?>
</body>
</html>