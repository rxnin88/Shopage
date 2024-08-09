<?php
session_start();
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

<body class="">
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
    <div class="container mx-auto px-8 py-20 ">
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
                        <a href="templates.php" class="ms-1 text-sm font-medium text-black md:ms-2 ">Templates</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-12"></div>

        <h1 class="text-5xl mb-4">Templates :</h1>
        <br><br>

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
            $sql = "SELECT * FROM templates WHERE name LIKE '%$searchQuery%'";
        } else {
            // Query all templates if no search query is provided
            $sql = "SELECT * FROM templates";
        }

        // Execute the query
        $result = mysqli_query($con, $sql);

        ?>

        <!-- Search form -->
        <form action="templates.php" method="GET" class="mx-auto">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-black focus:border-black" placeholder="Search for Templates..." value="<?php echo htmlspecialchars($searchQuery); ?>" required />

                <!-- Flexbox container for the buttons -->
                <div class="absolute end-2.5 bottom-2.5 flex space-x-4">
                    <!-- Search button -->
                    <button type="submit" class="bg-black hover:bg-gray-700 transition duration-300 ease-in-out focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-white">
                        Search
                    </button>

                    <!-- Reset button -->
                    <button type="button" onclick="window.location.href='templates.php';" class="bg-gray-500 hover:bg-gray-600 transition duration-300 ease-in-out focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-white">
                        Reset ⟳
                    </button>
                </div>
            </div>
        </form>

        <!-- Displaying templates -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <?php
            // Check if there are any results from the query
            if (mysqli_num_rows($result) > 0) {
                // Loop through the results and display each template
                while ($row = mysqli_fetch_assoc($result)) {
                    // Retrieve data from the current row
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $image_url = $row['image'];
                    // You can also retrieve and display other data such as HTML, CSS, JS as needed

                    $maxLength = 80;

                    // Generate HTML for each template as a card wrapped in an <a> tag
                    echo '<a href="template_page.php?id=' . htmlspecialchars($id) . '" class="block">';
                    echo '<div class="bg-white border border-1 border-gray-200 rounded-lg p-6 transition transform hover:scale-105" style="height: 440px;">'; // Fixed height
                    echo '<img src="' . $image_url . '" class="w-full h-48 object-cover rounded-t-lg mb-4">';
                    echo '<h3 class="text-xl font-semibold mb-2">' . htmlspecialchars($name) . '</h3>';
                    echo '<p class="mb-2 underline">Description:</p>';

                    // Use mb_strimwidth() to truncate the description
                    $truncatedDescription = mb_strimwidth($description, 0, $maxLength, '...');
                    echo '<p class="text-gray-600 mb-2">' .  htmlspecialchars($truncatedDescription) . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                // Display a message if no templates are found
                echo '<p>No templates found matching the search "' . htmlspecialchars($searchQuery) . '".</p>';
            }
            ?>
        </div>

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
                    <p class="text-gray-600">Privacy</p>
                    <p class="text-gray-600">Terms</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>