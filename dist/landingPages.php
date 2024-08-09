<?php
session_start(); // Start the session
require("../connexion.php");


// Check if the user is logged in
if (!isset($_SESSION['cle'])) {
    require("../fonctions.php");
    redirection("../authentification/login.php");
    exit();
}

// Include your database connection file (adjust the path as needed)
require_once '../connexion.php';

// Retrieve the logged-in user's ID from the session
$user_id = $_SESSION['cle'];

// Query the database for the landing pages created by the logged-in user
$sql = "SELECT * FROM landing_pages WHERE user_id = '$user_id'";
$result = mysqli_query($con, $sql);

// Query the database for the products created by the logged-in user
$sql2 = "SELECT * FROM products WHERE user_id = '$user_id'";
$result2 = mysqli_query($con, $sql2);

// Query the database for the category ID and name
$sql3 = "SELECT * FROM categories";
$result3 = mysqli_query($con, $sql3);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo1.png" type="">
    <title>ShoPage - Explore all the Templates</title>
    <link rel="stylesheet" href="/src/output.css">
</head>

<body>
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

    <!-- RECENT TEMPLATES -->
    <div class="container mx-auto px-8 py-20 bg-white">
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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="landingPages.php" class="ms-1 text-sm font-medium text-black md:ms-2 ">My Landing Pages</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class=" mt-12">
        </div>

        <?php

        require_once("../fonctions.php");
        // Query the database for the landing pages created by the logged-in user
        $sql = "SELECT username FROM users WHERE id = '$user_id'";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];

            echo '<h1 class="text-5xl font-semibold mb-4">Hello, ' . $username . ' 👋</h1>';
        }
        ?>
        <br><br>
        <h1 class="text-3xl font-thin mb-4">Your Landing Pages :</h1>
        <br>

        <?php
        // Include your database connection file (adjust the path as needed)
        require_once '../connexion.php';

        // Retrieve the search query from the form submission (if any)
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

        // Sanitize the search query to prevent SQL injection
        $searchQuery = mysqli_real_escape_string($con, $searchQuery);

        // Determine whether to query all templates or filter based on the search query
        if ($searchQuery) {
            // Query the database for templates matching the search query
            $sql = "SELECT * FROM landing_pages WHERE user_id = '$user_id' AND name LIKE '%$searchQuery%'";
        } else {
            // Query all templates if no search query is provided
            $sql = "SELECT * FROM landing_pages WHERE user_id = '$user_id'";
        }

        // Execute the query
        $result = mysqli_query($con, $sql);

        ?>

        <!-- Search form -->
        <form action="landingPages.php" method="GET" class="mx-auto">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-black focus:border-black" placeholder="Search for Landing Pages..." value="<?php echo htmlspecialchars($searchQuery); ?>" required />

                <!-- Flexbox container for the buttons -->
                <div class="absolute end-2.5 bottom-2.5 flex space-x-4">
                    <!-- Search button -->
                    <button type="submit" class="bg-black hover:bg-gray-700 transition duration-300 ease-in-out focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-white">
                        Search
                    </button>

                    <!-- Reset button -->
                    <button type="button" onclick="window.location.href='landingPages.php';" class="bg-gray-500 hover:bg-gray-600 transition duration-300 ease-in-out focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-white">
                        Reset ⟳
                    </button>
                </div>
            </div>
        </form>

        <br>
        <!-- Displaying landing pages -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
            <?php
            // Check if there are any results from the query
            if (mysqli_num_rows($result) > 0) {

                // Loop through the results and display each landing page
                while ($row = mysqli_fetch_assoc($result)) {
                    $landing_page_id = $row['id'];
                    $name = $row['name'];
                    $date_created = $row['created_at'];

                    // Format the dates
                    $formatted_date_created = date("F j, Y, g:i A", strtotime($date_created));

                    // Display the landing page as a card
                    echo '<div class="bg-white border border-1 border-gray-400 rounded-lg p-6" style="height: 200px;">';
                    echo '<h2 class="text-lg text-black font-semibold mb-2">' . htmlspecialchars($name) . '</h2>';
                    echo '<p class="text-gray-500 mb-2">Created at : ' . htmlspecialchars($formatted_date_created) . '</p>';

                    // Optionally, add links to edit, delete, or view the landing page
                    echo '<div class="flex space-x-4 mt-8">'; // Create a flex container with space between each link
                    echo '<a href="../landingpages/user_index.php?id=' . htmlspecialchars($landing_page_id) . '" class=" bg-black hover:bg-green-500 transition duration-300 ease-in-out text-white rounded-lg px-4 py-2">View</a>';
                    echo '<a href="view_landing_page.php?id=' . htmlspecialchars($landing_page_id) . '" class=" bg-black hover:bg-green-500 transition duration-300 ease-in-out text-white rounded-lg px-4 py-2">Edit</a>';
                    echo '<a href="delete_landing_page.php?id=' . htmlspecialchars($landing_page_id) . '" class=" bg-black hover:bg-green-500 transition duration-300 ease-in-out text-white rounded-lg px-4 py-2">Delete</a>';
                    echo '<a href="../PHP/download.php?id=' . htmlspecialchars($landing_page_id) . '&user_id=' . htmlspecialchars($user_id) . '" class="bg-black hover:bg-green-500 transition duration-300 ease-in-out text-white rounded-lg px-4 py-2">Download</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Display a message if the user has not created any landing pages
                echo '<p>You have not created any landing pages yet.</p>';
            }
            ?>
        </div>
        <br>
        <a href="create_landing_page.php" class="underline hover:text-black duration-300 ease-in-out text-gray-600">Create more..</a>

        <br>
        <br><br>
        <hr>
        <br>
        <br>
        <h1 class="text-3xl font-thin mb-4">Your Products :</h1>
        <!-- Displaying products -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <?php
            // Check if there are any results from the query
            if (mysqli_num_rows($result2) > 0) {
                // Loop through the results and display each landing page
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $product_id = $row2['id'];
                    $name = $row2['name'];
                    $desc = $row2['description'];
                    $categ = $row2['categorie_id'];
                    $date_created = $row2['created_at'];

                    // Fetch the first image URL for the product
                    $image_query = "SELECT image_url FROM product_images WHERE product_id = ? LIMIT 1";
                    $stmt = $con->prepare($image_query);
                    $stmt->bind_param('i', $product_id);
                    $stmt->execute();
                    $stmt->bind_result($image_url);
                    $stmt->fetch();
                    $stmt->close();

                    // Display the product as a card
                    echo '<div class="bg-white border border-1 border-gray-200 rounded-lg p-4">';
                    // Display the product image if available
                    if (!empty($image_url)) {
                        echo '<img src="' . htmlspecialchars($image_url) . '" alt="Product Image" class="mb-2 w-full rounded-lg object-cover" style="max-height: 180px;">';
                    } else {
                        echo '<p>No image available</p>';
                    }

                    // Format the dates
                    $formatted_date_created = date("F j, Y, g:i A", strtotime($date_created));


                    $maxlength = 100;
                    $truncatedDescription = mb_strimwidth($desc, 0, $maxlength, '...');
                    echo '<h1 class="text-xl font-semibold mb-2">' . htmlspecialchars($name) . '</h1>';
                    echo '<p class="text-gray-600 mb-2">' . htmlspecialchars($truncatedDescription) . '</p>';
                    // Fetch the category name
                    $categ_query = "SELECT name FROM categories WHERE id = " . $categ;
                    $stmt = $con->prepare($categ_query);
                    $stmt->execute();
                    $stmt->bind_result($categ_name);
                    $stmt->fetch();
                    $stmt->close();

                    echo '<p class="text-gray-600 mt-6 mb-2 border border-gray-600 rounded-full" style="display: inline-block; padding: 0.4rem 1rem;">' . htmlspecialchars($categ_name) . '</p>';
                    echo '<p class="text-gray-600 mb-2">Created at : ' . htmlspecialchars($formatted_date_created) . '</p>';





                    // Optionally, add links to edit, delete, or view the landing page
                    echo '<div class="flex space-x-4 mt-4">'; // Create a flex container with space between each link
                    echo '<a href="view_product_page.php?id=' . htmlspecialchars($product_id) . '" class=" bg-black hover:bg-green-500 transition duration-300 ease-in-out text-white rounded-lg px-6 py-2">View</a>';
                    echo '<a href="../PHP/delete_product.php?id=' . htmlspecialchars($product_id) . '" class=" bg-black hover:bg-green-500 transition duration-300 ease-in-out text-white rounded-lg px-6 py-2">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Display a message if the user has not created any landing pages
                echo '<p>You have not created any products yet.</p>';
            }
            ?>

        </div>
        <br>
        <a href="create_product.php" class="underline hover:text-black duration-300 ease-in-out text-gray-600">Create more..</a>
        <br>
        <br><br>
        <hr>
        <br>
        <br>
        <h1 class="text-3xl font-thin mb-4">Your Promotions :</h1>
        <!-- Displaying promotions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <?php
            // Query to get promotions
            $promotion_query = "SELECT * FROM promotions where user_id = " . $user_id;
            $result = $con->query($promotion_query);

            // Check if there are any results from the query
            if (mysqli_num_rows($result) > 0) {
                // Loop through the results and display each promotion
                while ($row = mysqli_fetch_assoc($result)) {
                    $promotion_id = $row['id'];
                    $name = $row['name'];
                    $discount = $row['discount_percentage'];
                    $start_date = $row['start_date'];
                    $end_date = $row['end_date'];

                    // Format the dates
                    $formatted_start_date = date("F j, Y", strtotime($start_date));
                    $formatted_end_date = date("F j, Y", strtotime($end_date));

                    // Display the promotion as a card
                    echo '<div class="bg-white border border-1 border-gray-200 rounded-lg p-4">';

                    $maxlength = 100;
                    $truncatedDescription = mb_strimwidth($desc, 0, $maxlength, '...');
                    echo '<h1 class="text-xl font-semibold mb-2">' . htmlspecialchars($name) . '</h1>';
                    echo '<p class="text-gray-600 mb-2">Discount: ' . htmlspecialchars($discount) . '%</p>';
                    echo '<p class="text-gray-600 mb-2">Start Date: ' . htmlspecialchars($formatted_start_date) . '</p>';
                    echo '<p class="text-gray-600 mb-2">End Date: ' . htmlspecialchars($formatted_end_date) . '</p>';

                    // Optionally, add links to edit, delete, or view the promotion
                    echo '<div class="flex space-x-4 mt-4">'; // Create a flex container with space between each link
                    echo '<a href="../PHP/delete_promotion.php?id=' . htmlspecialchars($promotion_id) . '&action=delete" class=" bg-black hover:bg-green-500 transition duration-300 ease-in-out text-white rounded-lg px-6 py-2">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Display a message if there are no promotions
                echo '<p>No promotions available.</p>';
            }
            ?>
        </div>
        <br>
        <a href="create_promotion.php" class="underline hover:text-black duration-300 ease-in-out text-gray-600">Create more..</a>


        <?php
        // Close the database connection
        mysqli_close($con);
        ?>

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
                    <a href="dashboard.php" class="hover:text-gray-600">My Dashboard</a>
                    <p class="text-gray-600">Terms</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>