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

document.querySelector(".find-product-btn").addEventListener("click", () => {
  window.location.href = "findProduct.html"; // Ubah ke URL halaman pencarian produk
});

function toggleFilterMenu(type) {
  console.log(`Filter ${type} menu clicked`);
  // Tambahkan logika sesuai kebutuhan, misalnya memunculkan dropdown
}
