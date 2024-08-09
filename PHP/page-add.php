<?php

$php_content = <<<PHP

<?php

session_start(); // Start the session
require("../connexion.php");

// Check if the user is logged in
if (!isset(\$_SESSION['cle'])) {
    require("../fonctions.php");
    redirection("../authentification/login.php");
    exit();
}

// Include your database connection file (adjust the path as needed)
require_once '../connexion.php';

// Retrieve the logged-in user's ID from the session
\$user_id = \$_SESSION['cle'];

\$sql2 = "SELECT business_name FROM landing_pages WHERE user_id = " . \$user_id;
\$result2 = \$con->query(\$sql2);

if (\$result2->num_rows > 0) {
    // Output data of each row
    while (\$row = \$result2->fetch_assoc()) {
        \$b_name = \$row['business_name'];
    }
}

?>

PHP;

$page_content = '';

?>



<!-- THIS PART IS THE PHP I WANT TO EXECUTE-->


<?php
// Include the database connection
require("../connexion.php");

// Start the session to access session variables
session_start();

// Check if form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the session variable 'cle' (user_id)
    $user_id = $_SESSION['cle'];

    // Get form data
    $name = $_POST['name'];
    $shop_desc = $_POST['shop_desc'];
    $template_id = $_POST['template']; // Assuming this comes from the template select
    $product_id = $_POST['product']; // Assuming this comes from the product select
    $b_name = $_POST['b_name'];

    // Optionally, you can retrieve and process HTML, CSS, JS, and image data here

    // Fetch the HTML content of the selected template
    $stmt = $con->prepare("SELECT html FROM templates WHERE id = ?");
    $stmt->bind_param("i", $template_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $page_content = $row['html'];
    } else {
        echo "Template not found.";
        exit();
    }

    // Start a transaction
    $con->begin_transaction();

    $html_content = $php_content . $page_content;

    try {
        // Insert landing page details into the landing_pages table
        $stmt = $con->prepare("INSERT INTO landing_pages (user_id, template_id, product_id, name, business_name, shop_desc, html_content) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiissss", $user_id, $template_id, $product_id, $name, $b_name, $shop_desc, $html_content);
        $stmt->execute();

        // Commit the transaction if all operations succeeded
        $con->commit();

        require("../fonctions.php");
        redirection("../dist/landingPages.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurred
        $con->rollback();
        echo "An error occurred: " . $e->getMessage();
    }
}

// Close the database connection
$con->close();
?>