<?php
session_start();
require("../connexion.php");

// Check if the user is logged in
if (!isset($_SESSION['cle'])) {
    require("../fonctions.php");
    redirection("../authentification/login.php");
    exit();
}

// Retrieve the logged-in user's ID from the session
$user_id = $_SESSION['cle'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product ID from the POST request
    $product_id = intval($_POST['product_id']);

    // Validate input
    if ($product_id > 0) {
        // Delete the product from the product_in_promotion table
        $stmt = $con->prepare("DELETE FROM product_in_promotion WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);

        if ($stmt->execute()) {
            // Redirect to the page where the products are displayed
            require('../fonctions.php');
            redirection('../dist/dashboard.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid product ID.";
    }
} else {
    echo "Invalid request method.";
}

$con->close();
