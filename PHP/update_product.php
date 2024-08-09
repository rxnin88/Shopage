<meta charset="UTF-8">
<?php

// Include the database connection
require("../connexion.php");

// Start the session to access session variables
session_start();

// Check if form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the session variable 'cle'
    $user_id = $_SESSION['cle'];

    // Get form data
    $product_id = $_POST['product_id'];

    // Initialize variables for updated data
    $update_data = [];

    // Check and add updated fields to the update_data array
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $update_data['name'] = $_POST['name'];
    }
    if (isset($_POST['description']) && !empty($_POST['description'])) {
        $update_data['description'] = $_POST['description'];
    }
    if (isset($_POST['price']) && !empty($_POST['price'])) {
        $update_data['price'] = $_POST['price'];
    }

    // Start a transaction
    $con->begin_transaction();

    try {
        // Update product details in the products table
        if (!empty($update_data)) {
            // Build the SET clause for the UPDATE query dynamically
            $set_clause = '';
            $types = '';
            $param_values = [];
            foreach ($update_data as $key => $value) {
                $set_clause .= "$key = ?, ";
                if ($key === 'price') {
                    // If the key is 'price', cast the value to float
                    $types .= 'd'; // 'd' for double (float)
                    $param_values[] = (float)$value;
                } else {
                    // For other keys, assume string
                    $types .= 's';
                    $param_values[] = $value;
                }
            }
            $set_clause = rtrim($set_clause, ', ');

            // Prepare and execute the UPDATE query
            $stmt = $con->prepare("UPDATE products SET $set_clause WHERE id = ?");
            $types .= 'i'; // Append 'i' for the product ID parameter
            $param_values[] = $product_id;
            $stmt->bind_param($types, ...$param_values);
            $stmt->execute();

            // Debugging: Output a message to confirm that the update query was executed
            echo "Product details updated successfully. <br>";
        }


        // Check if images were uploaded
        if (isset($_FILES['images'])) {

            $images = $_FILES['images'];

            // Iterate through each uploaded file
            for ($i = 0; $i < count($images['name']); $i++) {

                // Retrieve file details
                $image_name = $images['name'][$i];
                $image_tmp_name = $images['tmp_name'][$i];
                $image_error = $images['error'][$i];


                // Check if the file upload was successful
                if ($image_error === UPLOAD_ERR_OK) {
                    // Define the directory to store uploaded images
                    $upload_directory = '../products/images/';
                    // Define the file path for the uploaded image
                    $upload_file_path = $upload_directory . basename($image_name);

                    // Move the uploaded file to the designated directory
                    if (move_uploaded_file($image_tmp_name, $upload_file_path)) {
                        // Insert image details into the product_images table

                        $stmt = $con->prepare("INSERT INTO product_images (product_id, image_name, image_url) VALUES (?, ?, ?)");
                        $alt_text = ''; // Optional: You can set the alt text to a default value
                        $stmt->bind_param("iss", $product_id, $image_name, $upload_file_path);
                        $stmt->execute();
                    }
                }
            }
        } else {
        }

        // Commit the transaction if all operations succeeded
        $con->commit();

        // Debugging: Output a message to confirm that the transaction was committed
        echo "<br>Transaction committed. <br>";

        // Redirect back to the product listing page
        require("../fonctions.php");
        redirection("../dist/landingPages.php");
    } catch (Exception $e) {
        // Rollback the transaction if an error occurred
        $con->rollback();
        echo "An error occurred: " . $e->getMessage();
    }
}

// Close the database connection
$con->close();
