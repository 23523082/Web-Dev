// Function to update the order summary dynamically from the backend
function fetchAndUpdateOrderSummary() {
  const summaryList = document.getElementById("summary-list");
  const totalPriceElement = document.getElementById("total-price");

  fetch("fetch_order_summary.php")
    .then((response) => response.json())
    .then((data) => {
      // Debug the data to check the entire response
      console.log(data);

      if (data.success) {
        // Clear the current summary
        summaryList.innerHTML = "";

        let items = data.data.items;
        let grandTotal = data.data.grandTotal;

        // Add items to the summary list
        items.forEach((item) => {
          const listItem = document.createElement("li");

          // Ensure price is valid and show it correctly
          if (item.price !== undefined) {
            listItem.textContent = `${item.title} - Rp${item.price.toFixed(2)}`;
          } else {
            listItem.textContent = `${item.title} - Price not available`;
          }

          summaryList.appendChild(listItem);
        });

        // Update the total price (grand total including VAT)
        totalPriceElement.textContent = `Rp${grandTotal.toFixed(2)}`;
      } else {
        console.error(data.error || "Failed to fetch order summary.");
      }
    })
    .catch((error) => {
      console.error("Error fetching order summary:", error);
    });
}

// Function to handle quantity update and item removal
function updateQuantity(button, action) {
  const quantityElement = button.parentElement.querySelector("span");
  const cartItem = button.closest(".cart-item");
  const checkbox = cartItem.querySelector(".select-item");
  const basePrice = parseFloat(checkbox.dataset.basePrice); // Use a base price for quantity calculation
  let quantity = parseInt(quantityElement.textContent);

  if (action === "increase") {
    quantity += 1;
  } else if (action === "decrease" && quantity > 0) {
    quantity -= 1;
  }

  quantityElement.textContent = quantity;

  if (quantity === 0) {
    cartItem.remove();
    checkbox.checked = false; // Uncheck the item
  }

  checkbox.dataset.price = (basePrice * quantity).toFixed(2);
  updateOrderSummary();
}

// Delegate event listeners to the parent container (using event delegation)
document.addEventListener("click", function(event) {
  if (event.target.closest(".quantity")) {
    const action = event.target.textContent === "+" ? "increase" : "decrease";
    updateQuantity(event.target, action);
  }
});

// Function to update the order summary (front-end only, for real-time updates)
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
    priceSpan.textContent = `Rp${price.toFixed(2)}`;
    listItem.appendChild(priceSpan);
    summaryList.appendChild(listItem);

    // Add to subtotal
    subtotal += price;
  });

  // Calculate Sales Tax (PPN 11%)
  const salesTax = subtotal * 0.11;

  // Update the total price (subtotal + tax)
  const total = subtotal + salesTax;
  totalPriceElement.textContent = `Rp${total.toFixed(2)}`;
}

// Fetch the backend data to update summary on page load
document.addEventListener("DOMContentLoaded", function() {
  fetchAndUpdateOrderSummary();
});
