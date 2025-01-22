<?php
session_start();
include '../dbconnections.php'; 

header('Content-Type: application/json'); // Return JSON response

$response = ['success' => false, 'data' => null, 'error' => null];

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $query = "SELECT id, title, price FROM orders"; // Assuming `price` column exists in `orders` table
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $items = [];
        $totalPrice = 0;

        while ($row = $result->fetch_assoc()) {
            // Ensure all fields are valid before adding them
            if (isset($row['title'], $row['price'])) {
                $items[] = [
                    'title' => $row['title'],
                    'price' => (float) $row['price']  // Ensure price is a valid number
                ];
                $totalPrice += $row['price'];
            }
        }

        $salesTax = $totalPrice * 0.11; // 11% VAT
        $grandTotal = $totalPrice + $salesTax; // No shipping fee as it's free

        $response['success'] = true;
        $response['data'] = [
            'items' => $items,
            'totalPrice' => $totalPrice,
            'salesTax' => $salesTax,
            'grandTotal' => $grandTotal
        ];
    } else {
        $response['error'] = "No items found in the orders table.";
    }
} catch (Exception $e) {
    $response['error'] = "An error occurred: " . $e->getMessage();
}

$conn->close();
echo json_encode($response);
exit();
?>
