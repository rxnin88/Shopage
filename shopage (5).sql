-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 09:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopage`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Health & Beauty'),
(2, 'Sports & Outdoors'),
(3, 'Toys & Games'),
(4, 'Home & Garden'),
(5, 'Food & Grocery'),
(6, 'Automotive'),
(7, 'Pet Supplies'),
(8, 'Jewelry'),
(9, 'Office Supplies');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `fullname`, `email`, `address`, `created_at`, `updated_at`, `user_id`) VALUES
(10, 'Kamal Azzouzi', 'kamal@gmail.com', 'AVE des FAR, Rue 06', '2024-05-17 20:11:23', '2024-05-17 20:11:23', 9),
(20, 'Dorothy W. Austin', 'DorothyAustin@teleworm.us', '1883 Peaceful Lane\r\nCleveland, OH 44103', '2024-05-20 19:23:09', '2024-05-20 19:23:09', 9),
(21, 'John Doe', 'JohnDoe@gmail.com', '1883 Peaceful Lane\r\nCleveland, OH 44103', '2024-05-20 21:00:10', '2024-05-20 21:00:10', 9),
(24, 'Yasser Benabbou', 'yasser22@gmail.com', 'Placeholder address', '2024-05-21 15:34:13', '2024-05-21 15:34:13', 10),
(30, 'Mohammded Abaich', 'moha@gmail.com', 'Mohammded Abaich', '2024-05-21 20:54:29', '2024-05-21 20:54:29', 9),
(32, 'Mohammed Amin', 'amin@gmail.com', 'Amin Street, APT n09', '2024-05-21 21:28:28', '2024-05-21 21:28:28', 9),
(40, 'Kamal Azzouzi', 'kamal@gmail.com', 'Example Street', '2024-06-25 18:48:19', '2024-06-25 18:48:19', 19),
(41, 'Kamal Azzouzi', 'kamal@gmail.com', 'Kamal', '2024-06-26 08:52:24', '2024-06-26 08:52:24', 20),
(42, 'Yasser Ben Abbou', 'yasser@gmail.com', 'Yasser', '2024-06-26 08:52:37', '2024-06-26 08:52:37', 20),
(43, 'Yasser Ben Abbou', 'yasser@gmail.com', 'Exemple d\'adresse', '2024-06-26 10:33:01', '2024-06-26 10:33:01', 21),
(44, 'Kamal Azzouzi', 'kamal@gmail.com', 'Exemple', '2024-06-26 10:34:13', '2024-06-26 10:34:13', 21);

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unconfirmed',
  `total_price` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `client_id`, `product_id`, `quantity`, `order_date`, `delivery_date`, `status`, `total_price`, `user_id`) VALUES
(8, 10, 35, 2, '2024-05-17 20:11:23', '2024-05-24 18:46:29', 'Confirmed', 14939.98, 9),
(17, 20, 35, 8, '2024-05-20 19:23:09', '2024-05-27 20:23:09', 'Confirmed', 59759.93, 9),
(18, 21, 35, 1, '2024-05-20 21:00:10', '2024-05-27 22:00:10', 'Confirmed', 8299.99, 9),
(20, 24, 36, 1, '2024-05-21 15:34:13', '2024-05-31 16:34:13', 'Confirmed', 540.00, 10),
(31, 40, 38, 1, '2024-06-25 18:48:19', '2024-07-09 19:48:19', 'Confirmed', 84.00, 19),
(32, 41, 39, 1, '2024-06-26 08:52:24', '2024-07-10 09:52:24', 'Confirmed', 7000.00, 20),
(33, 42, 39, 1, '2024-06-26 08:52:37', '2024-07-10 09:52:37', 'Confirmed', 7000.00, 20),
(34, 43, 40, 1, '2024-06-26 10:33:01', '2024-07-10 11:33:01', 'Confirmed', 12000.00, 21),
(35, 44, 40, 2, '2024-06-26 10:34:13', '2024-07-10 11:34:13', 'Confirmed', 19200.00, 21);

-- --------------------------------------------------------

--
-- Table structure for table `landing_pages`
--

CREATE TABLE `landing_pages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `shop_desc` varchar(255) NOT NULL,
  `html_content` text DEFAULT NULL,
  `css_content` text DEFAULT NULL,
  `js_content` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landing_pages`
--

INSERT INTO `landing_pages` (`id`, `user_id`, `template_id`, `product_id`, `name`, `business_name`, `shop_desc`, `html_content`, `css_content`, `js_content`, `images`, `created_at`, `updated_at`) VALUES
(17, 9, 1, 35, 'Macbook Shop', 'Macs4Sale', 'We sell the best second hand Macbooks in Morocco, we hold ourselves to the highest standards in terms of quality and trust!', '\r\n<?php\r\n\r\nsession_start(); // Start the session\r\nrequire(\"../connexion.php\");\r\n\r\n// Check if the user is logged in\r\nif (!isset($_SESSION[\'cle\'])) {\r\n    require(\"../fonctions.php\");\r\n    redirection(\"../authentification/login.php\");\r\n    exit();\r\n}\r\n\r\n// Include your database connection file (adjust the path as needed)\r\nrequire_once \'../connexion.php\';\r\n\r\n// Retrieve the logged-in user\'s ID from the session\r\n$user_id = $_SESSION[\'cle\'];\r\n\r\n$sql2 = \"SELECT business_name FROM landing_pages WHERE user_id = \" . $user_id;\r\n$result2 = $con->query($sql2);\r\n\r\nif ($result2->num_rows > 0) {\r\n    // Output data of each row\r\n    while ($row = $result2->fetch_assoc()) {\r\n        $b_name = $row[\'business_name\'];\r\n    }\r\n}\r\n\r\n?>\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>E-Commerce Landing Page</title>\r\n    <link href=\"https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css\" rel=\"stylesheet\">\r\n</head>\r\n\r\n<body class=\"bg-gray-100 font-sans\">\r\n\r\n    <!-- Navigation -->\r\n    <nav class=\"bg-white shadow-lg\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"flex justify-between items-center py-4\">\r\n                <a href=\"#\" class=\"text-2xl font-bold text-gray-800\">E-Commerce</a>\r\n                <ul class=\"flex space-x-4\">\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Home</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Products</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">About</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Contact</a></li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </nav>\r\n\r\n    <!-- Hero Section -->\r\n    <section class=\"bg-gray-800 text-white py-20\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"text-center\">\r\n                <h1 class=\"text-4xl font-bold mb-4\">Welcome to Our E-Commerce Store</h1>\r\n                <p class=\"text-lg\">Shop the latest trends in fashion, electronics, and more.</p>\r\n                <a href=\"#\" class=\"mt-6 inline-block bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300\">Shop Now</a>\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Featured Products Section -->\r\n    <section class=\"py-16\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <h2 class=\"text-3xl font-semibold mb-8 text-center\">Featured Products</h2>\r\n            <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8\">\r\n                <!-- Replace with actual product cards -->\r\n                <?php\r\n                // Include the database connection\r\n                require(\"../connexion.php\");\r\n\r\n                // Get the landing page ID from the URL query parameter\r\n                $landing_page_id = $_GET[\'id\'] ?? null;\r\n\r\n                // Fetch featured products from the database based on landing page ID\r\n                $sql = \"SELECT p.* FROM products p\r\n                JOIN landing_pages lp ON p.id = lp.product_id\r\n                WHERE lp.id = ?\";\r\n\r\n                $stmt = $con->prepare($sql);\r\n                $stmt->bind_param(\"i\", $landing_page_id);\r\n                $stmt->execute();\r\n                $result = $stmt->get_result();\r\n\r\n                if ($result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while ($row = $result->fetch_assoc()) {\r\n                        // Display product information\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available for this landing page.\";\r\n                }\r\n\r\n                // Check if there are any results\r\n                if ($result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while ($row = $result->fetch_assoc()) {\r\n                        $product_id = $row[\'id\'];\r\n                        $product_name = $row[\'name\'];\r\n                        $product_description = $row[\'description\'];\r\n                        $product_price = $row[\'price\'];\r\n                        $product_image = \'\'; // Set default image path\r\n                        // Fetch product image\r\n                        $sql_image = \"SELECT image_url FROM product_images WHERE product_id = $product_id LIMIT 1\";\r\n                        $result_image = $con->query($sql_image);\r\n                        if ($result_image->num_rows > 0) {\r\n                            $row_image = $result_image->fetch_assoc();\r\n                            $product_image = $row_image[\'image_url\'];\r\n                        }\r\n                ?>\r\n                        <div class=\"bg-white rounded-lg shadow-lg overflow-hidden\">\r\n                            <img src=\"<?php echo $product_image; ?>\" alt=\"Product\" class=\"w-full h-48 object-cover\">\r\n                            <div class=\"p-4\">\r\n                                <h3 class=\"text-lg font-semibold mb-2\"><?php echo $product_name; ?></h3>\r\n                                <p class=\"text-gray-700\"><?php echo $product_description; ?></p>\r\n                                <div class=\"mt-4\">\r\n                                    <span class=\"text-gray-700 font-semibold\">$<?php echo $product_price; ?></span>\r\n                                    <button class=\"bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg ml-4 hover:bg-gray-700 transition duration-300\">Add to Cart</button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                <?php\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available.\";\r\n                }\r\n                ?>\r\n                <!-- End of product cards -->\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Footer -->\r\n    <footer class=\"bg-gray-900 text-white py-8\">\r\n        <div class=\"container mx-auto px-4 text-center\">\r\n            <p>&copy; <?php echo date(\"Y\"); ?> E-Commerce. All rights reserved.</p>\r\n        </div>\r\n    </footer>\r\n\r\n</body>\r\n\r\n</html>', NULL, NULL, NULL, '2024-05-17 16:58:03', '2024-05-17 16:58:03'),
(19, 10, 1, 36, 'Apple watch shop', 'AW Store', 'We sell the best second hand Apple watches in Morocco, we hold ourselves to the highest standards in terms of quality and trust!', '\r\n<?php\r\n\r\nsession_start(); // Start the session\r\nrequire(\"../connexion.php\");\r\n\r\n// Check if the user is logged in\r\nif (!isset($_SESSION[\'cle\'])) {\r\n    require(\"../fonctions.php\");\r\n    redirection(\"../authentification/login.php\");\r\n    exit();\r\n}\r\n\r\n// Include your database connection file (adjust the path as needed)\r\nrequire_once \'../connexion.php\';\r\n\r\n// Retrieve the logged-in user\'s ID from the session\r\n$user_id = $_SESSION[\'cle\'];\r\n\r\n$sql2 = \"SELECT business_name FROM landing_pages WHERE user_id = \" . $user_id;\r\n$result2 = $con->query($sql2);\r\n\r\nif ($result2->num_rows > 0) {\r\n    // Output data of each row\r\n    while ($row = $result2->fetch_assoc()) {\r\n        $b_name = $row[\'business_name\'];\r\n    }\r\n}\r\n\r\n?>\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>E-Commerce Landing Page</title>\r\n    <link href=\"https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css\" rel=\"stylesheet\">\r\n</head>\r\n\r\n<body class=\"bg-gray-100 font-sans\">\r\n\r\n    <!-- Navigation -->\r\n    <nav class=\"bg-white shadow-lg\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"flex justify-between items-center py-4\">\r\n                <a href=\"#\" class=\"text-2xl font-bold text-gray-800\">E-Commerce</a>\r\n                <ul class=\"flex space-x-4\">\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Home</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Products</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">About</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Contact</a></li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </nav>\r\n\r\n    <!-- Hero Section -->\r\n    <section class=\"bg-gray-800 text-white py-20\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"text-center\">\r\n                <h1 class=\"text-4xl font-bold mb-4\">Welcome to Our E-Commerce Store</h1>\r\n                <p class=\"text-lg\">Shop the latest trends in fashion, electronics, and more.</p>\r\n                <a href=\"#\" class=\"mt-6 inline-block bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300\">Shop Now</a>\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Featured Products Section -->\r\n    <section class=\"py-16\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <h2 class=\"text-3xl font-semibold mb-8 text-center\">Featured Products</h2>\r\n            <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8\">\r\n                <!-- Replace with actual product cards -->\r\n                <?php\r\n                // Include the database connection\r\n                require(\"../connexion.php\");\r\n\r\n                // Get the landing page ID from the URL query parameter\r\n                $landing_page_id = $_GET[\'id\'] ?? null;\r\n\r\n                // Fetch featured products from the database based on landing page ID\r\n                $sql = \"SELECT p.* FROM products p\r\n                JOIN landing_pages lp ON p.id = lp.product_id\r\n                WHERE lp.id = ?\";\r\n\r\n                $stmt = $con->prepare($sql);\r\n                $stmt->bind_param(\"i\", $landing_page_id);\r\n                $stmt->execute();\r\n                $result = $stmt->get_result();\r\n\r\n                if ($result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while ($row = $result->fetch_assoc()) {\r\n                        // Display product information\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available for this landing page.\";\r\n                }\r\n\r\n                // Check if there are any results\r\n                if ($result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while ($row = $result->fetch_assoc()) {\r\n                        $product_id = $row[\'id\'];\r\n                        $product_name = $row[\'name\'];\r\n                        $product_description = $row[\'description\'];\r\n                        $product_price = $row[\'price\'];\r\n                        $product_image = \'\'; // Set default image path\r\n                        // Fetch product image\r\n                        $sql_image = \"SELECT image_url FROM product_images WHERE product_id = $product_id LIMIT 1\";\r\n                        $result_image = $con->query($sql_image);\r\n                        if ($result_image->num_rows > 0) {\r\n                            $row_image = $result_image->fetch_assoc();\r\n                            $product_image = $row_image[\'image_url\'];\r\n                        }\r\n                ?>\r\n                        <div class=\"bg-white rounded-lg shadow-lg overflow-hidden\">\r\n                            <img src=\"<?php echo $product_image; ?>\" alt=\"Product\" class=\"w-full h-48 object-cover\">\r\n                            <div class=\"p-4\">\r\n                                <h3 class=\"text-lg font-semibold mb-2\"><?php echo $product_name; ?></h3>\r\n                                <p class=\"text-gray-700\"><?php echo $product_description; ?></p>\r\n                                <div class=\"mt-4\">\r\n                                    <span class=\"text-gray-700 font-semibold\">$<?php echo $product_price; ?></span>\r\n                                    <button class=\"bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg ml-4 hover:bg-gray-700 transition duration-300\">Add to Cart</button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                <?php\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available.\";\r\n                }\r\n                ?>\r\n                <!-- End of product cards -->\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Footer -->\r\n    <footer class=\"bg-gray-900 text-white py-8\">\r\n        <div class=\"container mx-auto px-4 text-center\">\r\n            <p>&copy; <?php echo date(\"Y\"); ?> E-Commerce. All rights reserved.</p>\r\n        </div>\r\n    </footer>\r\n\r\n</body>\r\n\r\n</html>', NULL, NULL, NULL, '2024-05-17 18:34:01', '2024-05-17 18:34:01'),
(23, 19, 1, 38, 'N-Hype', 'N-hype', 'At N-Hype, with over 6 years of experience in the market, we pride ourselves on our ability to offer only original and authentic products. Our founder and expert, Nicolas, personally oversees the verification process of each product, ensuring their unques', '\r\n<?php\r\n\r\nsession_start(); // Start the session\r\nrequire(\"../connexion.php\");\r\n\r\n// Check if the user is logged in\r\nif (!isset($_SESSION[\'cle\'])) {\r\n    require(\"../fonctions.php\");\r\n    redirection(\"../authentification/login.php\");\r\n    exit();\r\n}\r\n\r\n// Include your database connection file (adjust the path as needed)\r\nrequire_once \'../connexion.php\';\r\n\r\n// Retrieve the logged-in user\'s ID from the session\r\n$user_id = $_SESSION[\'cle\'];\r\n\r\n$sql2 = \"SELECT business_name FROM landing_pages WHERE user_id = \" . $user_id;\r\n$result2 = $con->query($sql2);\r\n\r\nif ($result2->num_rows > 0) {\r\n    // Output data of each row\r\n    while ($row = $result2->fetch_assoc()) {\r\n        $b_name = $row[\'business_name\'];\r\n    }\r\n}\r\n\r\n?>\r\n\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>E-Commerce Landing Page</title>\r\n    <link href=\"https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css\" rel=\"stylesheet\">\r\n</head>\r\n\r\n<body class=\"bg-gray-100 font-sans\">\r\n\r\n    <!-- Navigation -->\r\n    <nav class=\"bg-white shadow-lg\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"flex justify-between items-center py-4\">\r\n                <a href=\"#\" class=\"text-2xl font-bold text-gray-800\">E-Commerce</a>\r\n                <ul class=\"flex space-x-4\">\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Home</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Products</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">About</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Contact</a></li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </nav>\r\n\r\n    <!-- Hero Section -->\r\n    <section class=\"bg-gray-800 text-white py-20\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"text-center\">\r\n                <h1 class=\"text-4xl font-bold mb-4\">Welcome to Our E-Commerce Store</h1>\r\n                <p class=\"text-lg\">Shop the latest trends in fashion, electronics, and more.</p>\r\n                <a href=\"#\" class=\"mt-6 inline-block bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300\">Shop Now</a>\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Featured Products Section -->\r\n    <section class=\"py-16\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <h2 class=\"text-3xl font-semibold mb-8 text-center\">Featured Products</h2>\r\n            <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8\">\r\n                <!-- Replace with actual product cards -->\r\n                <?php\r\n                // Include the database connection\r\n                require(\"../connexion.php\");\r\n\r\n                // Get the landing page ID from the URL query parameter\r\n                \\$landing_page_id = \\$_GET[\'id\'] ?? null;\r\n\r\n                // Fetch featured products from the database based on landing page ID\r\n                \\$sql = \"SELECT p.* FROM products p\r\n                JOIN landing_pages lp ON p.id = lp.product_id\r\n                WHERE lp.id = ?\";\r\n\r\n                \\$stmt = \\$con->prepare(\\$sql);\r\n                \\$stmt->bind_param(\"i\", \\$landing_page_id);\r\n                \\$stmt->execute();\r\n                \\$result = \\$stmt->get_result();\r\n\r\n                if (\\$result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while (\\$row = \\$result->fetch_assoc()) {\r\n                        // Display product information\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available for this landing page.\";\r\n                }\r\n\r\n                // Check if there are any results\r\n                if (\\$result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while (\\$row = \\$result->fetch_assoc()) {\r\n                        \\$product_id = \\$row[\'id\'];\r\n                        \\$product_name = \\$row[\'name\'];\r\n                        \\$product_description = \\$row[\'description\'];\r\n                        \\$product_price = \\$row[\'price\'];\r\n                        \\$product_image = \'\'; // Set default image path\r\n                        // Fetch product image\r\n                        \\$sql_image = \"SELECT image_url FROM product_images WHERE product_id = \\$product_id LIMIT 1\";\r\n                        \\$result_image = \\$con->query(\\$sql_image);\r\n                        if (\\$result_image->num_rows > 0) {\r\n                            \\$row_image = \\$result_image->fetch_assoc();\r\n                            \\$product_image = \\$row_image[\'image_url\'];\r\n                        }\r\n                ?>\r\n                        <div class=\"bg-white rounded-lg shadow-lg overflow-hidden\">\r\n                            <img src=\"<?php echo \\$product_image; ?>\" alt=\"Product\" class=\"w-full h-48 object-cover\">\r\n                            <div class=\"p-4\">\r\n                                <h3 class=\"text-lg font-semibold mb-2\"><?php echo \\$product_name; ?></h3>\r\n                                <p class=\"text-gray-700\"><?php echo \\$product_description; ?></p>\r\n                                <div class=\"mt-4\">\r\n                                    <span class=\"text-gray-700 font-semibold\">$<?php echo \\$product_price; ?></span>\r\n                                    <button class=\"bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg ml-4 hover:bg-gray-700 transition duration-300\">Add to Cart</button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                <?php\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available.\";\r\n                }\r\n                ?>\r\n                <!-- End of product cards -->\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Footer -->\r\n    <footer class=\"bg-gray-900 text-white py-8\">\r\n        <div class=\"container mx-auto px-4 text-center\">\r\n            <p>&copy; <?php echo date(\"Y\"); ?> E-Commerce. All rights reserved.</p>\r\n        </div>\r\n    </footer>\r\n\r\n</body>\r\n\r\n</html>\r\n', NULL, NULL, NULL, '2024-06-25 15:42:53', '2024-06-25 15:42:53'),
(25, 21, 1, 40, 'Macbook Shop', 'Macs4Sale', 'We sell the best second hand Macbooks in Morocco, we hold ourselves to the highest standards in terms of quality and trust!', '\r\n<?php\r\n\r\nsession_start(); // Start the session\r\nrequire(\"../connexion.php\");\r\n\r\n// Check if the user is logged in\r\nif (!isset($_SESSION[\'cle\'])) {\r\n    require(\"../fonctions.php\");\r\n    redirection(\"../authentification/login.php\");\r\n    exit();\r\n}\r\n\r\n// Include your database connection file (adjust the path as needed)\r\nrequire_once \'../connexion.php\';\r\n\r\n// Retrieve the logged-in user\'s ID from the session\r\n$user_id = $_SESSION[\'cle\'];\r\n\r\n$sql2 = \"SELECT business_name FROM landing_pages WHERE user_id = \" . $user_id;\r\n$result2 = $con->query($sql2);\r\n\r\nif ($result2->num_rows > 0) {\r\n    // Output data of each row\r\n    while ($row = $result2->fetch_assoc()) {\r\n        $b_name = $row[\'business_name\'];\r\n    }\r\n}\r\n\r\n?>\r\n\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>E-Commerce Landing Page</title>\r\n    <link href=\"https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css\" rel=\"stylesheet\">\r\n</head>\r\n\r\n<body class=\"bg-gray-100 font-sans\">\r\n\r\n    <!-- Navigation -->\r\n    <nav class=\"bg-white shadow-lg\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"flex justify-between items-center py-4\">\r\n                <a href=\"#\" class=\"text-2xl font-bold text-gray-800\">E-Commerce</a>\r\n                <ul class=\"flex space-x-4\">\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Home</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Products</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">About</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Contact</a></li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </nav>\r\n\r\n    <!-- Hero Section -->\r\n    <section class=\"bg-gray-800 text-white py-20\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"text-center\">\r\n                <h1 class=\"text-4xl font-bold mb-4\">Welcome to Our E-Commerce Store</h1>\r\n                <p class=\"text-lg\">Shop the latest trends in fashion, electronics, and more.</p>\r\n                <a href=\"#\" class=\"mt-6 inline-block bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300\">Shop Now</a>\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Featured Products Section -->\r\n    <section class=\"py-16\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <h2 class=\"text-3xl font-semibold mb-8 text-center\">Featured Products</h2>\r\n            <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8\">\r\n                <!-- Replace with actual product cards -->\r\n                <?php\r\n                // Include the database connection\r\n                require(\"../connexion.php\");\r\n\r\n                // Get the landing page ID from the URL query parameter\r\n                \\$landing_page_id = \\$_GET[\'id\'] ?? null;\r\n\r\n                // Fetch featured products from the database based on landing page ID\r\n                \\$sql = \"SELECT p.* FROM products p\r\n                JOIN landing_pages lp ON p.id = lp.product_id\r\n                WHERE lp.id = ?\";\r\n\r\n                \\$stmt = \\$con->prepare(\\$sql);\r\n                \\$stmt->bind_param(\"i\", \\$landing_page_id);\r\n                \\$stmt->execute();\r\n                \\$result = \\$stmt->get_result();\r\n\r\n                if (\\$result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while (\\$row = \\$result->fetch_assoc()) {\r\n                        // Display product information\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available for this landing page.\";\r\n                }\r\n\r\n                // Check if there are any results\r\n                if (\\$result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while (\\$row = \\$result->fetch_assoc()) {\r\n                        \\$product_id = \\$row[\'id\'];\r\n                        \\$product_name = \\$row[\'name\'];\r\n                        \\$product_description = \\$row[\'description\'];\r\n                        \\$product_price = \\$row[\'price\'];\r\n                        \\$product_image = \'\'; // Set default image path\r\n                        // Fetch product image\r\n                        \\$sql_image = \"SELECT image_url FROM product_images WHERE product_id = \\$product_id LIMIT 1\";\r\n                        \\$result_image = \\$con->query(\\$sql_image);\r\n                        if (\\$result_image->num_rows > 0) {\r\n                            \\$row_image = \\$result_image->fetch_assoc();\r\n                            \\$product_image = \\$row_image[\'image_url\'];\r\n                        }\r\n                ?>\r\n                        <div class=\"bg-white rounded-lg shadow-lg overflow-hidden\">\r\n                            <img src=\"<?php echo \\$product_image; ?>\" alt=\"Product\" class=\"w-full h-48 object-cover\">\r\n                            <div class=\"p-4\">\r\n                                <h3 class=\"text-lg font-semibold mb-2\"><?php echo \\$product_name; ?></h3>\r\n                                <p class=\"text-gray-700\"><?php echo \\$product_description; ?></p>\r\n                                <div class=\"mt-4\">\r\n                                    <span class=\"text-gray-700 font-semibold\">$<?php echo \\$product_price; ?></span>\r\n                                    <button class=\"bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg ml-4 hover:bg-gray-700 transition duration-300\">Add to Cart</button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                <?php\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available.\";\r\n                }\r\n                ?>\r\n                <!-- End of product cards -->\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Footer -->\r\n    <footer class=\"bg-gray-900 text-white py-8\">\r\n        <div class=\"container mx-auto px-4 text-center\">\r\n            <p>&copy; <?php echo date(\"Y\"); ?> E-Commerce. All rights reserved.</p>\r\n        </div>\r\n    </footer>\r\n\r\n</body>\r\n\r\n</html>\r\n', NULL, NULL, NULL, '2024-06-26 10:32:17', '2024-06-26 10:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_desc` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `categorie_id`, `name`, `image_desc`, `description`, `price`, `quantity`, `delivery_time`, `created_at`, `updated_at`) VALUES
(35, 9, 9, 'Macbook M3 Pro', '../products/images/Macbook-Pro-M3.webp', 'The M3 MacBook Air is a spec-bump, and a mild refresh for Apple\'s hardware, with a few core chips and specifications changed. It\'s an upgrade that happens to practically all of Apple\'s main device lineups at some stage, and it has now arrived on the 13-inch and 15-inch MacBook Air. ', 8299.99, 35, 7, '2024-05-17 16:50:20', '2024-06-25 13:48:09'),
(36, 10, 3, 'Apple Watch Serie 9', '../products/images/809407.jpg', 'Our most powerful chip in Apple Watch ever. A magical way to use your Apple Watch without touching the screen. A display that’s twice as bright. And now you can choose a watch case and band combination that’s carbon neutral.', 600.00, 49, 10, '2024-05-17 18:32:25', '2024-05-21 15:34:24'),
(38, 19, 2, 'Nike SB Dunk Low Los Angeles Dodgers', '../products/images/dunk-versus-sb-dunk-article-12.jpg.webp', 'The Nike SB Dunk Low Los Angeles Dodgers features a white leather upper with blue overlays and red Swoosh logos. The \"Nike\" brand name is prevanlent on the heel tab in red.\r\n\r\nThe Nike SB Dunk Low Los Angeles Dodgers is a low-top sneaker with lace-up closure style. The shoe features a blue and white color scheme that has shades similar to the traditional blue and white worn by the MLB\'s LA Dodgers. It has a light-brown sole with a pink graphic on the ankle’s right side. ', 120.00, 196, 14, '2024-06-25 15:41:23', '2024-06-25 18:48:31'),
(39, 20, 9, 'Macbook Shop', '../products/images/Macbook-Pro-M3.webp', 'Macbook', 7000.00, 198, 14, '2024-06-26 08:51:00', '2024-06-26 08:53:15'),
(40, 21, 9, 'Macbook M3 Pro', '../products/images/Macbook-Pro-M3.webp', 'Macbook M3 Pro est un laptop avances pour tous vous demandes', 12000.00, 97, 14, '2024-06-26 10:31:09', '2024-06-26 10:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`, `image_url`) VALUES
(60, 35, 'apple-macbook-pro-16-m3-max-5111.webp', '../products/images/apple-macbook-pro-16-m3-max-5111.webp'),
(61, 35, '67pd7ezkLNCFhYfo552GQS.jpg', '../products/images/67pd7ezkLNCFhYfo552GQS.jpg'),
(62, 35, 'CMC_7492.webp', '../products/images/CMC_7492.webp'),
(63, 35, 'edit-img-8629.jpg', '../products/images/edit-img-8629.jpg'),
(64, 36, '5ba48b81905c4d2faa01419bdd799463-apple-watch-series-4-review-920b.jpg', '../products/images/5ba48b81905c4d2faa01419bdd799463-apple-watch-series-4-review-920b.jpg'),
(65, 36, 'download.jfif', '../products/images/download.jfif'),
(66, 36, '410944_11475_XL.jpg', '../products/images/410944_11475_XL.jpg'),
(67, 36, 'dsc02688-enhanced-nr.webp', '../products/images/dsc02688-enhanced-nr.webp'),
(68, 36, 'Apple-Watch-S9-hero-230912.jpg.og.jpg', '../products/images/Apple-Watch-S9-hero-230912.jpg.og.jpg'),
(74, 38, 'NikeSBDunkLowLosAngelesDodgers-DO9395-400-N-hype-6.webp', '../products/images/NikeSBDunkLowLosAngelesDodgers-DO9395-400-N-hype-6.webp'),
(75, 38, 'Nike-SB-Dunk-Low-LA-Dodgers-10.webp', '../products/images/Nike-SB-Dunk-Low-LA-Dodgers-10.webp'),
(76, 38, '3-73.webp', '../products/images/3-73.webp'),
(81, 39, 'macbook-pro-m3-max-2023-open.webp', '../products/images/macbook-pro-m3-max-2023-open.webp'),
(82, 39, '67pd7ezkLNCFhYfo552GQS.jpg', '../products/images/67pd7ezkLNCFhYfo552GQS.jpg'),
(83, 40, 'macbook-pro-m3-max-2023-open.webp', '../products/images/macbook-pro-m3-max-2023-open.webp'),
(84, 40, 'apple-macbook-pro-16-m3-max-5111.webp', '../products/images/apple-macbook-pro-16-m3-max-5111.webp'),
(85, 40, '67pd7ezkLNCFhYfo552GQS.jpg', '../products/images/67pd7ezkLNCFhYfo552GQS.jpg'),
(86, 35, 'macbook-pro-m3-max-2023-open.webp', '../products/images/macbook-pro-m3-max-2023-open.webp');

-- --------------------------------------------------------

--
-- Table structure for table `product_in_promotion`
--

CREATE TABLE `product_in_promotion` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `promotion_id` int(11) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_in_promotion`
--

INSERT INTO `product_in_promotion` (`id`, `user_id`, `product_id`, `promotion_id`, `discount_percentage`) VALUES
(21, 20, 39, 10, 15.00),
(22, 21, 40, 11, 20.00),
(23, 9, 35, 7, 15.00);

--
-- Triggers `product_in_promotion`
--
DELIMITER $$
CREATE TRIGGER `set_discount_percentage` BEFORE INSERT ON `product_in_promotion` FOR EACH ROW BEGIN
    DECLARE discount DECIMAL(5, 2);

    -- Fetch the discount percentage from promotions table
    SELECT discount_percentage INTO discount
    FROM promotions
    WHERE id = NEW.promotion_id;

    -- Set the discount_percentage in the new row
    SET NEW.discount_percentage = discount;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `user_id`, `name`, `discount_percentage`, `start_date`, `end_date`) VALUES
(5, 9, 'Easter', 35.00, '2024-05-21', '2024-05-31'),
(7, 9, 'New Year', 15.00, '2024-05-23', '2024-05-31'),
(10, 20, 'Eid Al Adha', 15.00, '2024-06-26', '2024-06-29'),
(11, 21, 'Eid Al Adha', 20.00, '2024-06-26', '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `html` text DEFAULT NULL,
  `css` text DEFAULT NULL,
  `js` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `description`, `html`, `css`, `js`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Demo Template', 'This is the default template for the free version.', '\r\n<!DOCTYPE html>\r\n<html lang=\"en\">\r\n\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>E-Commerce Landing Page</title>\r\n    <link href=\"https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css\" rel=\"stylesheet\">\r\n</head>\r\n\r\n<body class=\"bg-gray-100 font-sans\">\r\n\r\n    <!-- Navigation -->\r\n    <nav class=\"bg-white shadow-lg\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"flex justify-between items-center py-4\">\r\n                <a href=\"#\" class=\"text-2xl font-bold text-gray-800\">E-Commerce</a>\r\n                <ul class=\"flex space-x-4\">\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Home</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Products</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">About</a></li>\r\n                    <li><a href=\"#\" class=\"text-gray-700 hover:text-gray-900\">Contact</a></li>\r\n                </ul>\r\n            </div>\r\n        </div>\r\n    </nav>\r\n\r\n    <!-- Hero Section -->\r\n    <section class=\"bg-gray-800 text-white py-20\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <div class=\"text-center\">\r\n                <h1 class=\"text-4xl font-bold mb-4\">Welcome to Our E-Commerce Store</h1>\r\n                <p class=\"text-lg\">Shop the latest trends in fashion, electronics, and more.</p>\r\n                <a href=\"#\" class=\"mt-6 inline-block bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300\">Shop Now</a>\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Featured Products Section -->\r\n    <section class=\"py-16\">\r\n        <div class=\"container mx-auto px-4\">\r\n            <h2 class=\"text-3xl font-semibold mb-8 text-center\">Featured Products</h2>\r\n            <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8\">\r\n                <!-- Replace with actual product cards -->\r\n                <?php\r\n                // Include the database connection\r\n                require(\"../connexion.php\");\r\n\r\n                // Get the landing page ID from the URL query parameter\r\n                \\$landing_page_id = \\$_GET[\'id\'] ?? null;\r\n\r\n                // Fetch featured products from the database based on landing page ID\r\n                \\$sql = \"SELECT p.* FROM products p\r\n                JOIN landing_pages lp ON p.id = lp.product_id\r\n                WHERE lp.id = ?\";\r\n\r\n                \\$stmt = \\$con->prepare(\\$sql);\r\n                \\$stmt->bind_param(\"i\", \\$landing_page_id);\r\n                \\$stmt->execute();\r\n                \\$result = \\$stmt->get_result();\r\n\r\n                if (\\$result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while (\\$row = \\$result->fetch_assoc()) {\r\n                        // Display product information\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available for this landing page.\";\r\n                }\r\n\r\n                // Check if there are any results\r\n                if (\\$result->num_rows > 0) {\r\n                    // Output data of each row\r\n                    while (\\$row = \\$result->fetch_assoc()) {\r\n                        \\$product_id = \\$row[\'id\'];\r\n                        \\$product_name = \\$row[\'name\'];\r\n                        \\$product_description = \\$row[\'description\'];\r\n                        \\$product_price = \\$row[\'price\'];\r\n                        \\$product_image = \'\'; // Set default image path\r\n                        // Fetch product image\r\n                        \\$sql_image = \"SELECT image_url FROM product_images WHERE product_id = \\$product_id LIMIT 1\";\r\n                        \\$result_image = \\$con->query(\\$sql_image);\r\n                        if (\\$result_image->num_rows > 0) {\r\n                            \\$row_image = \\$result_image->fetch_assoc();\r\n                            \\$product_image = \\$row_image[\'image_url\'];\r\n                        }\r\n                ?>\r\n                        <div class=\"bg-white rounded-lg shadow-lg overflow-hidden\">\r\n                            <img src=\"<?php echo \\$product_image; ?>\" alt=\"Product\" class=\"w-full h-48 object-cover\">\r\n                            <div class=\"p-4\">\r\n                                <h3 class=\"text-lg font-semibold mb-2\"><?php echo \\$product_name; ?></h3>\r\n                                <p class=\"text-gray-700\"><?php echo \\$product_description; ?></p>\r\n                                <div class=\"mt-4\">\r\n                                    <span class=\"text-gray-700 font-semibold\">$<?php echo \\$product_price; ?></span>\r\n                                    <button class=\"bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg ml-4 hover:bg-gray-700 transition duration-300\">Add to Cart</button>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                <?php\r\n                    }\r\n                } else {\r\n                    echo \"No featured products available.\";\r\n                }\r\n                ?>\r\n                <!-- End of product cards -->\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n    <!-- Footer -->\r\n    <footer class=\"bg-gray-900 text-white py-8\">\r\n        <div class=\"container mx-auto px-4 text-center\">\r\n            <p>&copy; <?php echo date(\"Y\"); ?> E-Commerce. All rights reserved.</p>\r\n        </div>\r\n    </footer>\r\n\r\n</body>\r\n\r\n</html>\r\n', 'div { color: red; }', 'console.log(\"Template A JS\");', '2024-05-03 17:32:47', '2024-05-22 21:47:38', '../PHP/Templates/Images/image2.jpg'),
(2, 'Ashley - Creative Portfolio Template', 'Ashley HTML Template – a cutting-edge and modern portfolio template designed specifically for creative agencies, design studios, and other creative individuals. With its sleek design and captivating animations, Ashley is the perfect choice to showcase your talent and make a bold statement in the digital realm.', '<div>Template B HTML</div>', 'div { color: blue; }', 'console.log(\"Template B JS\");', '2024-05-03 17:32:47', '2024-05-22 21:49:03', '../PHP/Templates/Images/image3.png'),
(3, 'Corporate MultiPurpose HTML Template for Business', 'Clean Creative HTML Template for Portfolio and Creative Agency.\r\nRoxine is a high performance, robust and scalable template based on latest Bootstrap 4 framework focused on transforming your online presence into dynamic frontend digital solution that you can use for any project type.', 'Template C HTML', 'div { color: green; }', 'console.log(\"Template C JS\");', '2024-05-03 17:35:04', '2024-05-22 21:50:00', '../PHP/Templates/Images/image4.jpg'),
(4, 'Charles- Business-Consulting HTML Template', 'Charles- Business-Consulting template is designed especially for the agency, multipurpose and business and those who offer business-related services.', 'html', 'css', 'js', '2024-05-03 21:49:26', '2024-05-22 21:50:28', '../PHP/Templates/Images/image5.jpg'),
(5, 'eCommerce HTML Template', 'Odor – Vape Store eCommerce html template Odor is a powerful Vape Store WooCommerce HTML Template. It uses the latest version of Bootstrap, HTML5, CSS3, JavaScript, jQuery. Odor puts a lot of emphasis on aligning products based on their categories. Yet it also highlights how certain web components. A Design that integrates components to highlight special products. It is super for Vape shop, digital shop, electronic shop, games shop, food shop, devices shop, household appliances shop or any other categories.', 'html', 'css', 'js', '2024-05-03 21:49:26', '2024-05-22 21:50:56', '../PHP/Templates/Images/image6.jpg'),
(6, 'Haswell - Multipurpose One & Multi Page Template', 'Haswell is a cross-browser compatible, retina-ready, responsive HTML5 /CSS3 template with touch support that features a clean and unique design that is truly multipurpose template which is suitable for a wide variety of websites. Tons of Customizations are possible with this template that’ll help you redefine your website’s brand value.', 'html', 'css', 'js', '2024-05-04 18:02:44', '2024-05-22 21:51:23', '../PHP/Templates/Images/image1.jpg'),
(7, 'Swan Lake - Marketing Landing Page', 'Swan Lake is a Modern and Creative premium Onepage Lead Generation Marketing Landing Page HTML5 Template. Swan Lake is made in a beautiful style. Anyone can use it for Agency, business, business services, and etc.Theme has a universal design, it thought every detail and animation effect. Its just as easy to customize to fit your needs, replace images and texts. Swan Lake based on bootstrap 1170px grid system, HTML5 and CSS3, and it’s very easy to customize each and every block of HTML and CSS file is properly commented which will help you to customize this template as per your requirements.', 'TEMPLATE 100', 'TEMPLATE 100', 'TEMPLATE 100', '2024-05-04 20:57:27', '2024-05-22 21:52:00', '../PHP/Templates/Images/image7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(9, 'Kamal Azzouzi', 'kamal@gmail.com', '5cc5d8d4c7115f1c96c2983ec0d0f8a0f9dab596', '2024-05-05 17:06:58'),
(10, 'User2', 'user2@gmail.com', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', '2024-05-05 19:27:34'),
(13, 'john_doe', 'john.doe@example.com', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', '2024-05-22 16:15:46'),
(16, 'jane_smith', 'jane.smith@gmail.com', '9119d6a820c5bd916857b03a71318176ad57bfb7', '2024-05-22 16:18:57'),
(18, 'mike_jackson', 'mike_jackson@gmail.com', '9f24eb5fea9dd0e4c4d431de86d07be869613d22', '2024-05-22 16:19:53'),
(19, 'Kamal2003', 'kamal2003@gmail.com', '5cc5d8d4c7115f1c96c2983ec0d0f8a0f9dab596', '2024-06-25 15:34:28'),
(20, 'Mosab', 'mosab@gmail.com', 'ff715585a9b97d14c929d218e3c7fb85dcd06219', '2024-06-26 08:49:59'),
(21, 'Kamal_Azzouzi', 'kamal1234@gmail.com', '5cc5d8d4c7115f1c96c2983ec0d0f8a0f9dab596', '2024-06-26 10:29:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `template_id` (`template_id`),
  ADD KEY `product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idcateg` (`categorie_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_in_promotion`
--
ALTER TABLE `product_in_promotion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `promotion_id` (`promotion_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `landing_pages`
--
ALTER TABLE `landing_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `product_in_promotion`
--
ALTER TABLE `product_in_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sous_categories`
--
ALTER TABLE `sous_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `commandes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD CONSTRAINT `landing_pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `landing_pages_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`),
  ADD CONSTRAINT `landing_pages_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_in_promotion`
--
ALTER TABLE `product_in_promotion`
  ADD CONSTRAINT `product_in_promotion_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_in_promotion_ibfk_2` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`id`),
  ADD CONSTRAINT `product_in_promotion_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `sous_categories_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
