<?php
// Include database connection
require("../connexion.php");

// Start the session to access session variables
session_start();

// Retrieve the product ID from the URL parameter
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the product ID is provided
if (!$product_id) {
    // Redirect to the products page if no product ID is provided
    header("Location: products.php");
    exit();
}

// Retrieve the product information from the database
$stmt = $con->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Retrieve product images from the database
$images = [];
$images_query = "SELECT * FROM product_images WHERE product_id = '$product_id'";
$images_result = mysqli_query($con, $images_query);
if ($images_result) {
    while ($row = mysqli_fetch_assoc($images_result)) {
        $images[] = $row;
    }
}

// Close the database connections
$stmt->close();

// Check if the product exists
if (!$product) {
    // Redirect to the products page if the product doesn't exist
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/logo1.png" type="">
    <title>ShoPage - Landing Page</title>
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
                    <a href="/authentification/deconnexion.php" class="block text-gray-800 hover:text-gray-900 py-2">Log Out</a>
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
                        <a href="" class="ms-1 text-sm font-medium text-black md:ms-2 "><?php echo htmlspecialchars($product['name']); ?></a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-12"></div>

        <h1 class="text-5xl my-6">View Product</h1>

        <!-- Form to display and modify product data -->
        <form action="../PHP/update_product.php" method="POST" enctype="multipart/form-data" id="product-form" class="bg-white rounded-lg p-6">

            <!-- Hidden input for product ID -->
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">

            <!-- Product Name -->
            <div class="mb-8">
                <label for="name" class="block text-gray-700 font-semibold">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" class="w-full p-2 border rounded-lg focus:outline-none focus:border-blue-500" disabled>
                <button type="button" class="block mt-2 bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300" onclick="enableInput('name')">Modify</button>
            </div>

            <div class="mb-8 grid grid-cols-2 gap-4">
                <div class="relative">
                    <label for="image_desc" class="block text-gray-700 font-semibold">Image Descriptive:</label>
                    <img name="image_desc" src="<?php echo htmlspecialchars($product['image_desc']); ?>" class="mx-auto rounded-lg" style="width: 445px;">
                </div>
            </div>

            <!-- Product Description -->
            <div class="mb-8">
                <label for="description" class="block text-gray-700 font-semibold">Description:</label>
                <textarea id="description" name="description" class="w-full p-2 border rounded-lg focus:outline-none focus:border-blue-500" disabled><?php echo htmlspecialchars($product['description']); ?></textarea>
                <button type="button" class="block mt-2 bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300" onclick="enableInput('description')">Modify</button>
            </div>

            <!-- Product Price -->
            <div class="mb-8">
                <label for="price" class="block text-gray-700 font-semibold">Price:</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" class="w-full p-2 border rounded-lg focus:outline-none focus:border-blue-500" disabled>
                <button type="button" class="block mt-2 bg-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-300" onclick="enableInput('price')">Modify</button>
            </div>

            <!-- Product Images -->
            <div class="mb-8">
                <label class="block text-gray-700 font-semibold">Images:</label>
                <br>
                <div class="grid grid-cols-2 gap-4">
                    <?php foreach ($images as $image) : ?>
                        <div class="relative">
                            <img src="<?php echo htmlspecialchars($image['image_url']); ?>" class="mx-auto rounded-lg" style="width: 445px;">

                            <input type="hidden" name="image_id" value="<?php echo htmlspecialchars($image['id']); ?>">
                            <a href="../PHP/delete_product_image.php?id=<?php echo htmlspecialchars($image['id']); ?>" class="bg-black hover:bg-green-500 transition duration-300 text-white py-3 px-5 rounded-lg">X</a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br><br><br>

                <!-- Product Images -->
                <div class="mb-4">
                    <label for="images[]" class="block text-gray-700 font-semibold">Images du produit</label>
                    <input type="file" id="images" name="images[]" multiple class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-black text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-500 transition duration-300">Save Modifications</button>
                </div>
            </div>

        </form>

    </div>

    <!-- JavaScript to enable input fields -->
    <script>
        function enableInput(inputId) {
            document.getElementById(inputId).removeAttribute('disabled');
        }
    </script>

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