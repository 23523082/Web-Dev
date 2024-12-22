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

// Function to update the order summary
function updateOrderSummary() {
  const selectedItems = document.querySelectorAll(".select-item:checked");
  const summaryList = document.getElementById("summary-list");
  const totalPriceElement = document.getElementById("total-price");

  summaryList.innerHTML = ""; // Clear the current summary
  let totalPrice = 0;

  selectedItems.forEach((checkbox) => {
    const name = checkbox.dataset.name;
    const price = parseFloat(checkbox.dataset.price);

    // Create a list item for each selected product
    const listItem = document.createElement("li");
    listItem.textContent = `${name} `;
    const priceSpan = document.createElement("span");
    priceSpan.textContent = `$${price}`;
    listItem.appendChild(priceSpan);
    summaryList.appendChild(listItem);

    // Add to total price
    totalPrice += price;
  });

  // Update the total price
  totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
}

// Add event listeners to checkboxes
document.querySelectorAll(".select-item").forEach((checkbox) => {
  checkbox.addEventListener("change", updateOrderSummary);
});

// Initialize the summary on page load
updateOrderSummary();

// Function to handle quantity update and item removal
function updateQuantity(button, action) {
  const quantityElement = button.parentElement.querySelector("span");
  const cartItem = button.closest(".cart-item");
  const checkbox = cartItem.querySelector(".select-item");
  const price = parseFloat(checkbox.dataset.price);

  let quantity = parseInt(quantityElement.textContent);

  // Update quantity based on action
  if (action === "increase") {
    quantity += 1;
  } else if (action === "decrease" && quantity > 0) {
    quantity -= 1;
  }

  // Update quantity element
  quantityElement.textContent = quantity;

  // Remove item if quantity reaches 0
  if (quantity === 0) {
    cartItem.remove();
    checkbox.checked = false; // Uncheck the item
  }

  // Update the price in the checkbox dataset
  checkbox.dataset.price = (price * quantity).toFixed(2);

  // Update the order summary
  updateOrderSummary();
}

// Add event listeners to the buttons
document.querySelectorAll(".quantity button").forEach((button) => {
  button.addEventListener("click", (event) => {
    const action = event.target.textContent === "+" ? "increase" : "decrease";
    updateQuantity(event.target, action);
  });
});

// Function to update the order summary
function updateOrderSummary() {
  const selectedItems = document.querySelectorAll(".select-item:checked");
  const summaryList = document.getElementById("summary-list");
  const totalPriceElement = document.getElementById("total-price");

  summaryList.innerHTML = ""; // Clear the current summary
  let subtotal = 0;

  selectedItems.forEach((checkbox) => {
    const name = checkbox.dataset.name;
    const price = parseFloat(checkbox.dataset.price);

    // Create a list item for each selected product
    const listItem = document.createElement("li");
    listItem.textContent = `${name} `;
    const priceSpan = document.createElement("span");
    priceSpan.textContent = `$${price.toFixed(2)}`;
    listItem.appendChild(priceSpan);
    summaryList.appendChild(listItem);

    // Add to subtotal
    subtotal += price;
  });

  // Calculate Sales Tax (PPN 11%)
  const salesTax = subtotal * 0.11;

  // Update the total price (subtotal + tax)
  const total = subtotal + salesTax;
  totalPriceElement.textContent = `$${total.toFixed(2)}`;
}

// Initialize the summary on page load
updateOrderSummary();

// Function to discard an item
function discardItem(button) {
  const cartItem = button.closest(".cart-item");
  const checkbox = cartItem.querySelector(".select-item");

  // Uncheck the item to ensure it's removed from the summary
  checkbox.checked = false;

  // Remove the item from the cart
  cartItem.remove();

  // Update the order summary
  updateOrderSummary();
}

// Add event listeners to the discard buttons
document.querySelectorAll(".remove-item").forEach((button) => {
  button.addEventListener("click", () => discardItem(button));
});

function redirectToProducts() {
  // Ganti URL di bawah dengan URL halaman katalog produk
  window.location.href = "products.html";
}
