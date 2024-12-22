function toggleMenu() {
  const menuBar = document.getElementById("menuBar");
  const overlay = document.getElementById("overlay");

  if (menuBar.classList.contains("hidden")) {
    // Show menu bar and overlay
    menuBar.classList.remove("hidden");
    menuBar.classList.add("show");
    overlay.classList.remove("hidden");
    overlay.classList.add("show");
  } else {
    // Hide menu bar and overlay
    menuBar.classList.remove("show");
    menuBar.classList.add("hidden");
    overlay.classList.remove("show");
    overlay.classList.add("hidden");
  }
}

const user = {
  type: "<?php echo $_SESSION['type']; ?>", // Correctly echo the session variable
};

function checkUsertype() {
  const addButton = document.getElementById("addButton");

  if (user.type === "customer") {
    addButton.style.display = "none"; // Hide the Add button if user is a customer
  } else {
    addButton.style.display = "block"; // Show the Add button for other user types
  }
}

// Call the function on page load
window.onload = checkUsertype;
function scrollToCategories() {
  document.querySelector(".categories").scrollIntoView({ behavior: "smooth" });
}

window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  const logo = document.querySelector(".logo img");
  const heroTitle = document.querySelector(".hero-title");

  if (window.scrollY > 50) {
    // Tambahkan background warna pada navbar
    navbar.classList.add("scrolled");
    navbar.classList.remove("transparent");

    // Tampilkan logo navbar
    logo.style.opacity = "1";
    logo.style.visibility = "visible";

    // Sembunyikan hero-title dengan transisi
    heroTitle.classList.add("hidden");
  } else {
    // Jadikan navbar transparan
    navbar.classList.remove("scrolled");
    navbar.classList.add("transparent");

    // Sembunyikan logo navbar
    logo.style.opacity = "0";
    logo.style.visibility = "hidden";

    // Tampilkan hero-title kembali dengan transisi
    heroTitle.classList.remove("hidden");
  }
});

// Set initial state saat DOM selesai dimuat
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");
  navbar.classList.add("transparent");

  const logo = document.querySelector(".logo img");
  logo.style.opacity = "0";
  logo.style.visibility = "hidden"; // Mulai dengan logo tersembunyi
});
