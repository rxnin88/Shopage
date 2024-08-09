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
    // Get the product ID and promotion ID from the POST request
    $product_id = intval($_POST['product_id']);
    $promotion_id = intval($_POST['promotion_id']);

    // Validate inputs
    if ($product_id > 0 && $promotion_id > 0) {
        // Get the discount percentage from the promotion
        $stmt = $con->prepare("SELECT discount_percentage FROM promotions WHERE id = ?");
        $stmt->bind_param("i", $promotion_id);
        $stmt->execute();
        $stmt->bind_result($discount_percentage);
        $stmt->fetch();
        $stmt->close();

        // Insert the product into the product_in_promotion table
        $stmt = $con->prepare("INSERT INTO product_in_promotion (user_id, product_id, promotion_id) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $promotion_id);

        if ($stmt->execute()) {
            // Redirect to the page where the products are displayed
            require('../fonctions.php');
            redirection('../dist/dashboard.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid product ID or promotion ID.";
    }
} else {
    echo "Invalid request method.";
}

$con->close();
