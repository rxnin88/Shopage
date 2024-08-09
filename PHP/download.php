<?php
// Database connection
require_once '../connexion.php';
session_start();

// Retrieve the template ID from the URL parameter
$page_id = isset($_GET['id']) ? $_GET['id'] : null;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// Fetch landing page details
$sql2 = "SELECT * FROM landing_pages WHERE id = ?";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("i", $page_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
$page = $result2->fetch_assoc();

// Replace placeholders in the template with actual data
$template = file_get_contents('../templates/user_index_template.php');
$template = str_replace('{{B_NAME}}', $page['business_name'], $template);
$template = str_replace('{{DESC}}', $page['shop_desc'], $template);
$template = str_replace('{{USER_ID}}', $user_id, $template);
$template = str_replace('{{PAGE_ID}}', $page_id, $template);


// Create temporary directory if not exists
$temp_dir = '../temp/';
if (!file_exists($temp_dir)) {
    mkdir($temp_dir);
}

// Write the template content to a temporary HTML file
$temp_file = $temp_dir . 'user_index_temp.html';
file_put_contents($temp_file, $template);

$buyer_add_file = '../landingpages/buyer-add.php';
$connexion_file = '../landingpages/connexion.php';
$fonctions_file = '../landingpages/fonctions.php';



// ZIP the temporary HTML file and the product images
$zip_file = '../temp/user_index.zip';
$zip = new ZipArchive;
if ($zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    // Add the base directory
    $baseDir = 'landing_page_files/dist';
    $zip->addEmptyDir($baseDir);

    // Add the temporary HTML file
    $zip->addFile($temp_file, $baseDir . '/user_index.php');

    // Add product images
    $product_images_dir = '../products/images';
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($product_images_dir), RecursiveIteratorIterator::LEAVES_ONLY);
    foreach ($files as $name => $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            // Get just the filename without the directory path
            $relativePath = basename($filePath);
            // Add the file to the ZIP archive inside the landing_page_files folder
            $zip->addFile($filePath, 'landing_page_files/products/images/' . $relativePath);
        }
    }

    // Add other required files
    $zip->addFile($buyer_add_file, $baseDir . '/buyer-add.php');
    $zip->addFile($connexion_file, $baseDir . '/connexion.php');
    $zip->addFile($fonctions_file, $baseDir . '/fonctions.php');

    // Close the ZIP archive
    $zip->close();

    // Send the ZIP file to the browser for download
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . basename($zip_file));
    header('Content-Length: ' . filesize($zip_file));
    readfile($zip_file);

    // Delete the ZIP file after downloading
    unlink($zip_file);
} else {
    echo 'Failed to create ZIP file';
}
