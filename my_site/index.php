<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Thomas">
        <title>Thomas</title>
        <link rel="stylesheet" href="my_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
      <?php include_once('nav.php'); ?>
        <div class="body_wrapper">
            <h1>Welcome! I'm Thomas.</h1>
            <p>
                I am a <em>4th year</em> student at <strong>Bishop's University</strong>
                I am from Ottawa, Ontario. <br>
                And I play on the lacrosse team here at school.
            </p>
            <hr>
            <h2><b>Facts about me:</b></h2>
            <ul>
                <li>DOB: July 28, 2004</li>
                <li>Hometown: Ottawa</li>
                <li>Program: Business Technology &amp Analytics</li>
                <li>Graduation Year: 2026</li>
            </ul>
        </div>
        <div class="slideshow">
            <div class="slideshow_img"><img src="images/gameday.jpg" alt="Gameday" style="width:100%"></div>
            <div class="slideshow_img"><img src="images/opoy.jpg" alt="Offensive Player of the Year" style="width:100%"></div>
            <div class="slideshow_img"><img src="images/schedule.jpg" alt="Team Schedule" style="width:100%"></div>
            
            <a id="prev" href="#" onclick="previous(event)">previous</a>
            <a id="next" href="#" onclick="next(event)">next</a>
        </div>
        <p>
          Here's my GitHub repository: 
          <a href="https://github.com/ThomasJones28/ThomasJones28.github.io">View my repo</a>
        </p>        
        <script>
          let current_slide = 0;
          showSlide(current_slide);

          function showSlide(n) {
            const slides = document.getElementsByClassName("slideshow_img");
            if (n >= slides.length) current_slide = 0;
            if (n < 0) current_slide = slides.length - 1;
            for (let i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
            }
            slides[current_slide].style.display = "block";
          }

          function next(event) {
            if (event) event.preventDefault();
            current_slide++;
            showSlide(current_slide);
          }

          function previous(event) {
            if (event) event.preventDefault();
            current_slide--;
            showSlide(current_slide);
          }
        </script>
      <?php include_once('footer.php'); ?>
    </body>
</html>