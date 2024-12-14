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

document.querySelector(".save-button").addEventListener("click", (e) => {
  e.preventDefault();
  alert("Your personal details have been saved!");
});

// Ambil elemen terkait
const firstNameInput = document.getElementById("first-name");
const lastNameInput = document.getElementById("last-name");
const titleDropdown = document.getElementById("title-dropdown");
const fullNameInput = document.getElementById("full-name");

// Fungsi untuk memperbarui nama lengkap di Title
function updateFullName() {
  const firstName = firstNameInput.value.trim();
  const lastName = lastNameInput.value.trim();
  document.querySelector(
    ".readonly-name"
  ).textContent = `${firstName} ${lastName}`;
}

// Event listeners
firstNameInput.addEventListener("input", updateFullName);
lastNameInput.addEventListener("input", updateFullName);

// Inisialisasi awal
updateFullName();

// Tangkap elemen ikon dan dropdown
const dropdownIcon = document.querySelector(".title-container::after");
const dropdownSelect = document.getElementById("title-dropdown");

// Tambahkan event listener untuk ikon
dropdownIcon.addEventListener("click", () => {
  dropdownSelect.focus(); // Fokuskan ke dropdown saat ikon diklik
  dropdownSelect.click(); // Buka dropdown
});

// Ambil elemen
const selectedOption = document.getElementById("selected-option");
const optionsList = document.getElementById("options-list");
const options = document.querySelectorAll("#options-list li");

// Tampilkan atau sembunyikan opsi saat klik
selectedOption.addEventListener("click", () => {
  optionsList.style.display =
    optionsList.style.display === "none" || optionsList.style.display === ""
      ? "block"
      : "none";
});

// Tangkap opsi yang dipilih
options.forEach((option) => {
  option.addEventListener("click", () => {
    const value = option.getAttribute("data-value");
    selectedOption.textContent = value; // Tampilkan teks pilihan
    optionsList.style.display = "none"; // Sembunyikan opsi lagi
  });
});

// Klik di luar dropdown untuk menutupnya
document.addEventListener("click", (event) => {
  if (!event.target.closest(".custom-dropdown")) {
    optionsList.style.display = "none";
  }
});
