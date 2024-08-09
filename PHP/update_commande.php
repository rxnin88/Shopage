<?php
include '../connexion.php'; // Ensure this file includes your database connection
session_start(); // Ensure session is started

// Retrieve the logged-in user's ID from the session
$user_id = $_SESSION['cle'];

if (isset($_GET['id']) && isset($_GET['action'])) {
    $commande_id = intval($_GET['id']);
    $action = $_GET['action'];

    // Start a transaction
    $con->begin_transaction();

    try {
        if ($action == 'confirm') {
            // Update the status of the order to 'Confirmed'
            $sql_update_status = "UPDATE commandes SET status = 'Confirmed' WHERE id = ?";
            $stmt_update_status = $con->prepare($sql_update_status);
            $stmt_update_status->bind_param("i", $commande_id);

            if (!$stmt_update_status->execute()) {
                throw new Exception($stmt_update_status->error);
            }

            // Fetch the product_id and quantity from the commandes table
            $sql_fetch_commande = "SELECT product_id, quantity FROM commandes WHERE id = ?";
            $stmt_fetch_commande = $con->prepare($sql_fetch_commande);
            $stmt_fetch_commande->bind_param("i", $commande_id);
            $stmt_fetch_commande->execute();
            $result_commande = $stmt_fetch_commande->get_result();
            $commande = $result_commande->fetch_assoc();

            $product_id = $commande['product_id'];
            $quantity_ordered = $commande['quantity'];

            // Update the quantity_in_stock of the product
            $sql_update_stock = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
            $stmt_update_stock = $con->prepare($sql_update_stock);
            $stmt_update_stock->bind_param("ii", $quantity_ordered, $product_id);

            if (!$stmt_update_stock->execute()) {
                throw new Exception($stmt_update_stock->error);
            }

            // Commit the transaction
            $con->commit();

            echo "Order confirmed and stock updated successfully.";
        } elseif ($action == 'delete') {
            // Fetch the client_id associated with the commande
            $sql_fetch_client_id = "SELECT client_id FROM commandes WHERE id = ?";
            $stmt_fetch_client_id = $con->prepare($sql_fetch_client_id);
            $stmt_fetch_client_id->bind_param("i", $commande_id);
            $stmt_fetch_client_id->execute();
            $result_client_id = $stmt_fetch_client_id->get_result();
            $commande = $result_client_id->fetch_assoc();
            $client_id = $commande['client_id'];

            // Delete the commande
            $sql_delete_commande = "DELETE FROM commandes WHERE id = ?";
            $stmt_delete_commande = $con->prepare($sql_delete_commande);
            $stmt_delete_commande->bind_param("i", $commande_id);

            if (!$stmt_delete_commande->execute()) {
                throw new Exception($stmt_delete_commande->error);
            }

            // Delete the client
            $sql_delete_client = "DELETE FROM clients WHERE id = ?";
            $stmt_delete_client = $con->prepare($sql_delete_client);
            $stmt_delete_client->bind_param("i", $client_id);

            if (!$stmt_delete_client->execute()) {
                throw new Exception($stmt_delete_client->error);
            }

            // Commit the transaction
            $con->commit();

            echo "Order and associated client deleted successfully.";
        } else {
            throw new Exception("Invalid action.");
        }

        require('../fonctions.php');
        redirection('../dist/dashboard.php');
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $con->rollback();

        echo "Error: " . $e->getMessage();
    }

    // Close statements
    $stmt_update_status->close();
    if (isset($stmt_fetch_commande)) {
        $stmt_fetch_commande->close();
    }
    if (isset($stmt_update_stock)) {
        $stmt_update_stock->close();
    }
    if (isset($stmt_fetch_client_id)) {
        $stmt_fetch_client_id->close();
    }
    if (isset($stmt_delete_commande)) {
        $stmt_delete_commande->close();
    }
    if (isset($stmt_delete_client)) {
        $stmt_delete_client->close();
    }
} else {
    echo "Invalid request.";
}

// Close connection
$con->close();
