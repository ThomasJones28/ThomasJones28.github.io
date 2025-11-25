<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Form</title>
  <link rel="stylesheet" href="my_style.css">
</head>
<body>
  <?php include_once('nav.php'); ?>
  <form class="quiz-form" action="quiz_verification.php" method="get" onsubmit="return validate();">
    <fieldset>
      <legend>Tell me about your travel life!</legend>

      <label for="name">Name:</label>
      <input type="text" id="name" name="name"><br><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email"><br><br>

      <p>1. What country were you born?</p>
      <label><input type="radio" name="birth_country" value="Canada"> Canada</label><br>
      <label><input type="radio" name="birth_country" value="USA"> USA</label><br>
      <label><input type="radio" name="birth_country" value="UK"> UK</label><br>
      <label><input type="radio" name="birth_country" value="Other"> Other</label><br><br>

      <p>2. What provinces have you visited?</p>
      <label><input type="checkbox" name="province[]" value="Alberta"> Alberta</label><br>
      <label><input type="checkbox" name="province[]" value="British Columbia"> British Columbia</label><br>
      <label><input type="checkbox" name="province[]" value="Manitoba"> Manitoba</label><br>
      <label><input type="checkbox" name="province[]" value="New Brunswick"> New Brunswick</label><br>
      <label><input type="checkbox" name="province[]" value="Newfoundland and Labrador"> Newfoundland and Labrador</label><br>
      <label><input type="checkbox" name="province[]" value="Nova Scotia"> Nova Scotia</label><br>
      <label><input type="checkbox" name="province[]" value="Ontario"> Ontario</label><br>
      <label><input type="checkbox" name="province[]" value="Prince Edward Island"> Prince Edward Island</label><br>
      <label><input type="checkbox" name="province[]" value="Quebec"> Quebec</label><br>
      <label><input type="checkbox" name="province[]" value="Saskatchewan"> Saskatchewan</label><br>
      <label><input type="checkbox" name="province[]" value="Northwest Territories"> Northwest Territories</label><br>
      <label><input type="checkbox" name="province[]" value="Nunavut"> Nunavut</label><br>
      <label><input type="checkbox" name="province[]" value="Yukon"> Yukon</label><br>
      <label><input type="checkbox" name="province[]" value="None"> None</label><br><br>

      <p>3. What is the coolest country you have visited?</p>
      <label for="coolest_country">Answer:</label>
      <input type="text" id="coolest_country" name="coolest_country"><br><br>

      <p>4. If you could travel to any country you haven't been to yet, where would you go?</p>
      <label for="dream_country">Answer:</label>
      <input type="text" id="dream_country" name="dream_country"><br><br>

      <p>5. Have you ever been on a cruise?</p>
      <label><input type="radio" name="cruise" value="Yes"> Yes</label><br>
      <label><input type="radio" name="cruise" value="No"> No</label><br><br>

      <input type="submit" value="Submit">
    </fieldset>
  </form>
  <?php include_once('footer.php'); ?>
  <script>
  function validate() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();

    if (name === "") {
      alert("Please enter your name.");
      return false;
    }

    if (email === "") {
      alert("Please enter your email address.");
      return false;
    }

    const birth = document.querySelector('input[name="birth_country"]:checked');
    if (!birth) {
      alert("Please select where you were born.");
      return false;
    }

    const provinces = document.querySelectorAll('input[name="province[]"]:checked');
    if (provinces.length === 0) {
      alert("Please select at least one province you have visited.");
      return false;
    }

    const coolest = document.getElementById("coolest_country").value.trim();
    if (coolest === "") {
      alert("Please enter the coolest country you have visited.");
      return false;
    }

    const dream = document.getElementById("dream_country").value.trim();
    if (dream === "") {
      alert("Please enter the country you would like to visit.");
      return false;
    }

    const cruise = document.querySelector('input[name="cruise"]:checked');
    if (!cruise) {
      alert("Please indicate whether you have ever been on a cruise.");
      return false;
    }
    return true;
  }
</script>
</body>
</html>
