<?php
// Include the database connection
require("../connexion.php");

// Start the session to access session variables
session_start();

// Retrieve the session variable 'cle'
$user_id = $_SESSION['cle'];

if (isset($_GET['id'])) {
    $productId = $_GET['id']; // Assuming you're passing the product ID via a query parameter

    // Retrieve all image filenames associated with the product ID
    $sqlSelectImages = "SELECT image_name FROM product_images WHERE product_id = ?";
    $stmtSelectImages = $con->prepare($sqlSelectImages);
    $stmtSelectImages->bind_param('i', $productId);
    $stmtSelectImages->execute();
    $result = $stmtSelectImages->get_result();

    // Define the image directory
    $imageDir = '../products/images/'; // Replace with your actual image directory path

    // Loop through each image
    while ($row = $result->fetch_assoc()) {
        $imageName = $row['image_name'];
        // Construct the full image path
        $imagePath = $imageDir . $imageName;

        // Check if the image file exists
        if (file_exists($imagePath)) {
            // Delete the image file
            if (unlink($imagePath)) {
                // Image file deleted successfully
                // Now delete the image record from the product_images table
                $sqlDeleteImage = "DELETE FROM product_images WHERE product_id = '$productId' AND image_name = '$imageName'";
                $con->query($sqlDeleteImage);
            } else {
                echo 'Error deleting product image file.';
            }
        } else {
            echo 'Product image file not found.';
        }
    }

    $stmtSelectImages->close(); // Close the statement handle

    // Now delete the product from the products table
    $sqlDeleteProduct = "DELETE FROM products WHERE id = '$productId'";
    $con->query($sqlDeleteProduct);

    // Optionally, you can also delete associated images or perform other cleanup tasks here

    // Redirect back to the product listing page
    require("../fonctions.php");
    redirection("../dist/landingPages.php");
    exit;
} else {
    echo 'Invalid product ID.';
}

// Close the database connection
$con->close();
