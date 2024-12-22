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

// Fungsi untuk membuka popup
function openPopup() {
  const popup = document.getElementById("popup");
  popup.classList.add("show");
}

// Fungsi untuk menutup popup
function closePopup() {
  const popup = document.getElementById("popup");
  popup.classList.remove("show");
}

// fungsi untuk membuka popupQris
function openPopupQris() {
  const popupQris = document.getElementById("popup-qris");
  popupQris.classList.add("show");
}

// Fungsi untuk menutup popupQris
function closePopupQris() {
  const popupQris = document.getElementById("popup-qris");
  popupQris.classList.remove("show");
}

// Event listener untuk kartu kredit
document.getElementById("credit-card").addEventListener("click", function () {
  openPopup(); // Membuka popup ketika kartu kredit diklik
});

// Event listener untuk QRIS (jika ingin menambahkan fitur serupa untuk elemen ini)
document.getElementById("qris").addEventListener("click", function () {
  openPopupQris(); // Contoh aksi jika QRIS diklik
});
