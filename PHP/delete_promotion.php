<?php
include '../connexion.php'; // Ensure this file includes your database connection

// Check if the request includes the promotion ID and action
if (isset($_GET['id']) && isset($_GET['action'])) {
    $promotion_id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'delete') {
        // Begin a transaction
        $con->begin_transaction();

        try {
            // Step 1: Delete entries from product_in_promotion table
            $sql_delete_product_promotion = "DELETE FROM product_in_promotion WHERE promotion_id = ?";
            $stmt_delete_product_promotion = $con->prepare($sql_delete_product_promotion);
            $stmt_delete_product_promotion->bind_param("i", $promotion_id);
            $stmt_delete_product_promotion->execute();

            // Step 2: Delete the promotion itself
            $sql_delete_promotion = "DELETE FROM promotions WHERE id = ?";
            $stmt_delete_promotion = $con->prepare($sql_delete_promotion);
            $stmt_delete_promotion->bind_param("i", $promotion_id);
            $stmt_delete_promotion->execute();

            // Commit the transaction
            $con->commit();

            echo "Promotion deleted successfully.";
            require('../fonctions.php');
            redirection('../dist/landingPages.php');
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $con->rollback();
            echo "Error deleting promotion: " . $e->getMessage();
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$con->close();
