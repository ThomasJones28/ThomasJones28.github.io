function splitAtRoot(path) {
  const url = new URL(path, location.origin);
  return url.pathname;
}
function setNav(current_path) {
  fetch("nav.html")
    .then(r => r.text())
    .then(html => {
      const navElem = document.getElementById("main-nav");
      navElem.innerHTML = html;
      current_path = splitAtRoot(current_path);
      for (const link of navElem.querySelectorAll("a")) {
        const href_clean = splitAtRoot(link.href);
        const isHome =
          (current_path === "/" && href_clean.endsWith("/index.php")) ||
          (href_clean === current_path);

        if (isHome) link.classList.add("current"); // use your site’s .current class
      }
    })
    .catch(err => console.log("nav load error:", err));
}