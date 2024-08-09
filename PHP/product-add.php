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
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['categorie'];
    $delivery_time = 14;

    // Start a transaction
    $con->begin_transaction();

    try {
        // Check if images_desc were uploaded
        if (isset($_FILES['images_desc'])) {
            $images_desc = $_FILES['images_desc'];

            // Retrieve file details
            $image_name2 = $images_desc['name'];
            $image_tmp_name2 = $images_desc['tmp_name'];
            $image_error2 = $images_desc['error'];

            // Check if the file upload was successful
            if ($image_error2 === UPLOAD_ERR_OK) {
                // Define the directory to store uploaded images
                $upload_directory2 = '../products/images/';
                // Define the file path for the uploaded image
                $upload_file_path2 = $upload_directory2 . basename($image_name2);

                // Move the uploaded file to the designated directory
                if (move_uploaded_file($image_tmp_name2, $upload_file_path2)) {
                    // Insert product details along with user_id into the products table
                    $stmt = $con->prepare("INSERT INTO products (user_id, categorie_id, name, image_desc, description, price, quantity, delivery_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("iisssdii", $user_id, $category_id, $name, $upload_file_path2, $description, $price, $quantity, $delivery_time);
                    $stmt->execute();
                }
            }
        }

        // Get the last inserted product ID
        $product_id = $con->insert_id;

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
                        $stmt->bind_param("iss", $product_id, $image_name, $upload_file_path);
                        $stmt->execute();
                    }
                }
            }
        }

        // Commit the transaction if all operations succeeded
        $con->commit();
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
?>