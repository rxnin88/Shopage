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
    <title>ShoPage - Create Landing Page</title>
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
                        <a href="" class="ms-1 text-sm font-medium text-black md:ms-2 ">Create Landing Page</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-12"></div>

        <div class="container mx-auto py-10">
            <h1 class="text-3xl font-bold text-center mb-8">Create a landing page</h1>

            <!-- Page creation form -->
            <form action="../PHP/page-add.php" method="POST" class="bg-white rounded-lg p-6">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Landing Page Name</label>
                    <input type="text" id="name" name="name" required class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- BusinessName -->
                <div class="mb-4">
                    <label for="b_name" class="block text-gray-700 font-semibold">Business Name</label>
                    <input type="text" id="b_name" name="b_name" required class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Shop Desc -->
                <div class="mb-4">
                    <label for="shop_desc" class="block text-gray-700 font-semibold">Shop Description</label>
                    <input type="text" id="shop_desc" name="shop_desc" required class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Template -->
                <div class="mb-4">
                    <label for="template" class="block text-gray-700 font-semibold">Template</label>
                    <select id="template" name="template" class="bg-white w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500" readonly>
                        <?php

                        // Fetch templates from the database and populate the select options
                        $template_query = "SELECT id, name FROM templates LIMIT 1";
                        $template_result = mysqli_query($con, $template_query);
                        if ($template_result && mysqli_num_rows($template_result) > 0) {
                            while ($template_row = mysqli_fetch_assoc($template_result)) {
                                echo '<option value="' . htmlspecialchars($template_row['id']) . '">' . htmlspecialchars($template_row['name']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Product -->
                <div class="mb-4">
                    <label for="product" class="block text-gray-700 font-semibold">Product</label>
                    <select id="product" name="product" class="bg-white w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                        <!-- Populate with options from the database -->
                        <?php
                        // Fetch products from the database and populate the select options
                        $product_query = "SELECT id, name FROM products WHERE user_id = " . $user_id;
                        $product_result = mysqli_query($con, $product_query);
                        if ($product_result && mysqli_num_rows($product_result) > 0) {
                            while ($product_row = mysqli_fetch_assoc($product_result)) {
                                echo '<option value="' . htmlspecialchars($product_row['id']) . '">' . htmlspecialchars($product_row['name']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-black text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-500 transition duration-300">Create page</button>
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