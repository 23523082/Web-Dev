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

function toggleDropdown() {
  const dropdownMenu = document.getElementById("dropdownMenu");
  const moreDetailsButton = document.getElementById("moreDetailsButton");
  const moreDetailsContainer = document.getElementById("moreDetailsContainer");
  const dropdownIcon = moreDetailsButton.querySelector(".dropdown-icon");

  if (dropdownMenu.style.display === "flex") {
    // Close the dropdown
    dropdownMenu.style.display = "none";
    moreDetailsButton.classList.remove("open");
    moreDetailsContainer.style.textAlign = "center"; // Return the button to center position
    moreDetailsButton.style.marginLeft = "0"; // Reset margin to center
    moreDetailsButton.style.width = "500px"; // Reset to initial width
    dropdownIcon.style.display = "none"; // Hide dropdown icon when dropdown is closed
    dropdownIcon.style.transform = "rotate(0deg)"; // Reset rotation to initial state
  } else {
    // Open the dropdown
    dropdownMenu.style.display = "flex";
    moreDetailsContainer.style.textAlign = "left"; // Align container to the left
    moreDetailsButton.classList.add("open");
    moreDetailsButton.style.width = "1100px"; // Expand width to match elements above
    dropdownIcon.style.display = "inline-block"; // Show dropdown icon when dropdown is open
    dropdownIcon.style.transform = "rotate(180deg)"; // Rotate icon to 180 degrees
  }
}
