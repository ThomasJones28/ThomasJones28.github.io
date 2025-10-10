


function compute_days(){
     const dobStr = get_dob();
     if (!dobStr) {
        write_answer_days("Please enter your date of birth.");
        return;
    }
    const dob = new Date(dobStr);
    const today = new Date();
    const diffDays = Math.floor((today - dob) / (1000 * 60 * 60 * 24));
  write_answer_days(`You are approximately ${diffDays.toLocaleString()} days old.`);
}



function compute_circle(){
  const screen = get_screen_dims();
  const radius = Math.floor(Math.min(screen.width, screen.height) / 2);
  const area = Math.PI * radius * radius;
  write_answer_circle(
    `Screen: ${screen.width} × ${screen.height}<br>` +
    `Radius: ${radius}px<br>` +
    `Area: ${area.toFixed(2)} px²`
  );
}


function check_palindrome(){
const text_input = get_palindrome();
  const cleaned = (text_input || "")
    .toLowerCase()
    .replace(/[^a-z0-9]/g, "");

  let isPal = true;
  for (let i = 0, j = cleaned.length - 1; i < j; i++, j--) {
    if (cleaned[i] !== cleaned[j]) {
      isPal = false;
      break;
    }
  }

  write_answer_palindrome(
    `"${text_input}" ${isPal ? "is" : "is NOT"} a palindrome.`
  );
}



function create_fibo() {
  const n = parseInt(document.getElementById("fibo_length").value);
  if (isNaN(n) || n < 0) {
    write_answer_fibo("Please enter a non-negative integer.");
    return;
  }

  const seq = [];
  if (n > 0) seq.push(0);
  if (n > 1) seq.push(1);
  for (let i = 2; i < n; i++) {
    seq.push(seq[i - 1] + seq[i - 2]);
  }

  write_answer_fibo(seq.join(", "));
}


