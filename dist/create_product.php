<?php
session_start(); // Start the session
require("../connexion.php"); //This file deals with all the connexion stuff


// Check if the user is logged in
if (!isset($_SESSION['cle'])) {
    require("../fonctions.php");
    redirection("../authentification/login.php");
    exit();
}

// Retrieve the logged-in user's ID from the session
$user_id = $_SESSION['cle'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo1.png" type="">
    <title>ShoPage - Create a Product</title>
    <link rel="stylesheet" href="/src/output.css">
</head>

<body class="bg-gray-100">

    <!-- NAV BAR -->
    <nav class="border-b border-gray-200 p-6">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo -->
            <a href="index.php" class="flex items-center text-gray-800 text-xl font-bold">
                <img src="/images/logo.png" class="w-28" alt="ShoPage">
            </a>

            <!-- Menu Button for Mobile -->
            <button id="menuButton" class="lg:hidden text-gray-800 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Navigation Links -->
            <div id="navLinks" class="hidden lg:flex flex-col lg:flex-row lg:space-x-4">
                <a href="index.php" class="block text-gray-800 hover:text-gray-900 py-2">Home</a>
                <a href="about.php" class="block text-gray-800 hover:text-gray-900 py-2">About</a>
                <a href="templates.php" class="block text-gray-800 hover:text-gray-900 py-2">Templates</a>
                <?php if (isset($_SESSION['login'])) : ?>
                    <!-- If the user is logged in, display the Log Out link -->
                    <a href="landingPages.php" class="block text-gray-800 hover:text-gray-900 py-2">My Landing Pages</a>
                    <a href="/authentification/deconnexion.php" class="block text-gray-800 hover:text-gray-900 py-2">| Log Out</a>
                <?php else : ?>
                    <!-- If the user is not logged in, display the Log In link -->
                    <a href="/authentification/register.php" class="block bg-black px-4 text-white rounded-lg hover:bg-green-500 transition duration-300 ease-in-out py-2">Join Us</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- JavaScript to toggle navigation links -->
        <script>
            const menuButton = document.getElementById('menuButton');
            const navLinks = document.getElementById('navLinks');

            menuButton.addEventListener('click', () => {
                navLinks.classList.toggle('hidden');
            });
        </script>
    </nav>

    <div class="container mx-auto py-20 px-6">

        <!-- BREADCRUMBS -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="index.php" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition duration-300 ease-in-out ">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="landingPages.php" class="ms-1 text-sm font-medium text-gray-500 hover:text-black transition duration-300 ease-in-out md:ms-2 ">My Landing Pages</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="" class="ms-1 text-sm font-medium text-black md:ms-2 ">Create Product</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-12"></div>

        <div class="container mx-auto py-10">
            <h1 class="text-3xl font-bold text-center mb-8">Create a product</h1>

            <!-- Product creation form -->
            <form action="../PHP/product-add.php" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg p-6">

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Product Name</label>
                    <input type="text" id="name" name="name" required class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold">Product Description</label>
                    <textarea id="description" name="description" required class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <!-- Product info Images -->
                <div class="mb-4">
                    <label for="images_desc" class="block text-gray-700 font-semibold">Descrtiptive Images</label>
                    <input type="file" id="images_desc" name="images_desc" class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold">Price</label>
                    <input type="number" step="0.01" id="price" name="price" required class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Product Quantity -->
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 font-semibold">Quantity</label>
                    <input type="number" id="quantity" name="quantity" required class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Product Category -->
                <div class="mb-4">
                    <label for="categorie" class="block text-gray-700 font-semibold">Categorie</label>
                    <select id="categorie" name="categorie" required class="w-full mt-2 p-2 bg-white border rounded-lg focus:outline-none focus:border-blue-500">

                        <!-- Add options dynamically from the categories table -->
                        <?php
                        // Include database connection
                        require("../connexion.php");

                        // Retrieve categories from the database
                        $query = "SELECT id, name FROM categories";
                        $result = $con->query($query);

                        // Check if categories exist
                        if ($result->num_rows > 0) {
                            // Output options for each category
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled selected>No categories available</option>";
                        }

                        // Close the database connection
                        $con->close();
                        ?>
                    </select>
                </div>

                <!-- Product Images -->
                <div class="mb-4">
                    <label for="images" class="block text-gray-700 font-semibold">Product Images</label>
                    <input type="file" id="images" name="images[]" required multiple class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-black text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-500 transition duration-300">Create Product</button>
                </div>
            </form>
        </div>

        <div class="mt-4"></div>
    </div>

    <!--  Footer  -->
    <footer class="border-t text-black py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Left side of the footer -->
                <div class="mb-4 md:mb-0">
                    <p class="text-sm">&copy; 2024 ShoPage. All rights reserved.</p>
                </div>

                <!-- Right side of the footer (links) -->
                <div class="flex space-x-4">
                    <a href="about.php" class="hover:text-gray-600">About</a>
                    <a href="contact.php" class="hover:text-gray-600">Contact</a>
                    <p class="text-gray-600">Privacy</p>
                    <p class="text-gray-600">Terms</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>