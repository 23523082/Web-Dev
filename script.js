window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  const bajuBekas = document.getElementById("baju-bekas");
  const navbarContent = document.querySelector(".navbar-content");

  if (window.scrollY > 50) {
    navbar.style.backgroundColor = "white";
    if (!navbarContent.contains(bajuBekas)) {
      navbarContent.appendChild(bajuBekas);
      navbarContent.style.display = "block";
    }
  } else {
    navbar.style.backgroundColor = "transparent";
    if (navbarContent.contains(bajuBekas)) {
      document.querySelector(".hero-content").insertBefore(bajuBekas, document.querySelector(".hero-content").firstChild);
      navbarContent.style.display = "none";
    }
  }
});
