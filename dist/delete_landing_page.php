<?php
session_start(); // Start the session
require("../connexion.php");

// Check if the user is logged in
if (!isset($_SESSION['cle'])) {
    require("../fonctions.php");
    redirection("../authentification/login.php");
    exit();
}

// Get the landing page ID from the URL parameter
$landing_page_id = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the landing page ID is provided
if (!$landing_page_id) {
    // Redirect to My Landing Pages page if no landing page ID is provided
    header("Location: landingPages.php");
    exit();
}

// Retrieve the name of the landing page
$sql = "SELECT name FROM landing_pages WHERE id = '$landing_page_id' AND user_id = '{$_SESSION['cle']}'";
$result = mysqli_query($con, $sql);
$landing_page = mysqli_fetch_assoc($result);

// Check if the landing page exists
if (!$landing_page) {
    // Redirect to My Landing Pages page if the landing page doesn't exist
    header("Location: landingPages.php");
    exit();
}

// Retrieve the name of the landing page
$landing_page_name = $landing_page['name'];

// Check if the form has been submitted to confirm the deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'delete') {
    // Execute the deletion query
    $sql = "DELETE FROM landing_pages WHERE id = '$landing_page_id' AND user_id = '{$_SESSION['cle']}'";
    mysqli_query($con, $sql);

    // Redirect back to the My Landing Pages page after deletion
    header("Location: landingPages.php");
    exit();
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo1.png" type="">
    <title>ShoPage - Confirm Landing Page Deletion</title>
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
                <li inline-flex items-center>
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
                        <a href="" class="ms-1 text-sm font-medium text-black md:ms-2 ">Delete Landing Page</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-12"></div>

        <div class="container mx-auto p-6">
            <h1 class="text-4xl font-semibold mb-4">Delete Landing Page</h1>
            <p class="text-xl mb-4">Are you sure you want to delete <span class="underline font-semibold"><?php echo htmlspecialchars($landing_page_name); ?></span>?</p>

            <!-- Confirmation form -->
            <form method="POST">
                <div class="flex space-x-4 mt-4">
                    <!-- Confirm deletion button -->
                    <button type="submit" name="confirm" value="delete" class="bg-black hover:bg-gray-700 transition duration-300 ease-in-out text-white rounded-lg px-4 py-2">Delete</button>

                    <!-- Cancel button -->
                    <a href="landingPages.php" class="bg-black hover:bg-gray-700 transition duration-300 ease-in-out text-white rounded-lg px-4 py-2">Return</a>
                </div>
            </form>
        </div>
    </div>

    <div class=" mt-12">
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
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