<?php
// Include the database connection
require("../connexion.php");

if (isset($_GET['id'])) {
    $imageId = $_GET['id']; // Assuming you're passing the image ID via a query parameter

    // Retrieve the image name from the database (replace with your actual query)
    $sql = "SELECT image_name FROM product_images WHERE id = ?";
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        echo "Error in preparing statement: " . $con->error;
        exit; // Exit script if there's an error
    }
    $stmt->bind_param('i', $imageId);
    if (!$stmt->execute()) {
        echo "Error in executing statement: " . $stmt->error;
        exit; // Exit script if there's an error
    }
    $stmt->bind_result($imageName);
    if (!$stmt->fetch()) {
        echo "No image found with ID: " . $imageId;
        exit; // Exit script if no image found
    }

    // Define the image directory
    $imageDir = '../products/images/'; // Replace with your actual image directory path

    // Construct the full image path
    $imagePath = $imageDir . $imageName;

    echo '<br> image name : ' . $imageName;
    echo '<br> image dir : ' . $imageDir;
    echo '<br> image path : ' . $imagePath;

    // Check if the image file exists
    if (file_exists($imagePath)) {
        // Delete the image file
        if (unlink($imagePath)) {

            $stmt->close();

            $sqlDelete = "DELETE FROM product_images WHERE id = ?";
            $stmtDelete = $con->prepare($sqlDelete);
            if (!$stmtDelete) {
                echo "Error in preparing delete statement: " . $con->error;
                exit; // Exit script if there's an error
            }
            $stmtDelete->bind_param('i', $imageId);
            if (!$stmtDelete->execute()) {
                echo "Error in executing delete statement: " . $stmtDelete->error;
                exit; // Exit script if there's an error
            }
            require("../fonctions.php");
            redirection("../dist/landingPages.php");
        } else {
            echo 'Error deleting image file.';
        }
    } else {
        echo ' Image file not found.';
    }
} else {
    echo 'Invalid image ID.';
}

// Close the database connection
$con->close();
