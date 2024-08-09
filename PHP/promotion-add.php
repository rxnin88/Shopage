<?php
session_start();
require("../connexion.php");

// Check if the user is logged in
if (!isset($_SESSION['cle'])) {
    require("../fonctions.php");
    redirection("../authentification/login.php");
    exit();
}

$user_id = $_SESSION['cle'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $discount_percentage = $_POST['discount_percentage'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO promotions (user_id, name, discount_percentage, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdss", $user_id, $name, $discount_percentage, $start_date, $end_date);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Promotion created successfully.";
        require("../fonctions.php");
        redirection("../dist/landingPages.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();
} else {
    echo "Invalid request method.";
}
