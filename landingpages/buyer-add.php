<?php
// Include the connection script
require("connexion.php");
session_start();
$user_id = $_SESSION['cle'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data for client
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $shipping_address = $_POST['shipping_address'];

    // Insert into clients table
    $sql_client = "INSERT INTO clients (fullname, email, address, user_id) VALUES (?, ?, ?, ?)";
    $stmt_client = $con->prepare($sql_client);
    $stmt_client->bind_param("sssi", $full_name, $email, $shipping_address, $user_id);

    // Execute the client statement
    if ($stmt_client->execute()) {
        // Get the client ID of the inserted record
        $client_id = $stmt_client->insert_id;

        // Get form data for order
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Fetch the price of the product considering promotions and the delivery time
        $sql_product = "SELECT IFNULL(promotions.discount_percentage, 0) AS discount_percentage, 
        (products.price - (products.price * IFNULL(promotions.discount_percentage, 0) / 100)) AS discounted_price,
        products.delivery_time
 FROM products
 LEFT JOIN product_in_promotion ON products.id = product_in_promotion.product_id
 LEFT JOIN promotions ON product_in_promotion.promotion_id = promotions.id
 WHERE products.id = ?";
        $stmt_product = $con->prepare($sql_product);
        $stmt_product->bind_param("i", $product_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
        $row_product = $result_product->fetch_assoc();

        $total_price = $row_product['discounted_price'] * $quantity;
        $delivery_time = $row_product['delivery_time']; // Fetch delivery time from the product table

        // Calculate the delivery date
        $created_at = new DateTime(); // Current date and time
        $created_at->add(new DateInterval('P' . $delivery_time . 'D')); // Add delivery time in days
        $delivery_date = $created_at->format('Y-m-d H:i:s'); // Format the delivery date

        // Prepare SQL statement for commandes
        $sql_commande = "INSERT INTO commandes (client_id, product_id, quantity, total_price, delivery_date, user_id) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters for commandes
        $stmt_commande = $con->prepare($sql_commande);
        $stmt_commande->bind_param("iiidsi", $client_id, $product_id, $quantity, $total_price, $delivery_date, $user_id);

        // Execute the commandes statement
        if ($stmt_commande->execute()) {
            echo "New record inserted successfully";

            // Redirect back to the referring page after successful insertion
            $referer = $_SERVER['HTTP_REFERER'] ?? 'user_index.php'; // Default to landing page if no referer
            header("Location: $referer");
            exit; // Ensure that subsequent code is not executed
        } else {
            echo "Error: " . $sql_commande . "<br>" . $con->error;
        }
    } else {
        echo "Error: " . $sql_client . "<br>" . $con->error;
    }

    // Close statements
    $stmt_client->close();
    $stmt_product->close();
    $stmt_commande->close();
} else {
    // If the form is not submitted, redirect or display an error message
    echo "Form not submitted!";
}

// Close connection
$con->close();
