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
    <title>ShoPage - Create Product</title>
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

    <div class="container mx-auto py-20 px-4">

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
                        <a href="" class="ms-1 text-sm font-medium text-black md:ms-2 ">Dashboard</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="mt-12 mb-6">
            <h1 class="text-3xl font-thin mb-4">My Orders :</h1>
        </div>

        <?php
        $sql = "SELECT 
            commandes.id as commande_id, 
            clients.fullname as client_name, 
            clients.email as client_email,
            clients.address as client_address, 
            products.name as product_name,
            products.quantity as quantity_in_stock,
            commandes.quantity, 
            commandes.order_date, 
            commandes.delivery_date, 
            commandes.total_price,
            commandes.status
        FROM commandes 
        JOIN clients ON commandes.client_id = clients.id 
        JOIN products ON commandes.product_id = products.id 
        WHERE commandes.user_id = ?
        ORDER BY commandes.order_date DESC";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are commandes
        if ($result->num_rows > 0) {
        ?>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 border border-1 border-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                CLIENT NAME
                            </th>
                            <th scope="col" class="px-6 py-3">
                                CLIENT EMAIL
                            </th>
                            <th scope="col" class="px-6 py-3">
                                CLIENT ADDRESS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                PRODUCT NAME
                            </th>
                            <th scope="col" class="px-6 py-3">
                                QUANTITY
                            </th>
                            <th scope="col" class="px-6 py-3">
                                QUANTITY IN STOCK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ORDER DATE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DELIVERY DATE (EST)
                            </th>
                            <th scope="col" class="px-6 py-3">
                                TOTAL PRICE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                STATUS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                CONFIRM
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DELETE
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $commande_id = $row['commande_id'];
                            $client_name = $row['client_name'];
                            $client_email = $row['client_email'];
                            $client_address = $row['client_address'];
                            $product_name = $row['product_name'];
                            $quantity = $row['quantity'];
                            $order_date = $row['order_date'];
                            $delivery_date = $row['delivery_date'];
                            $status = $row['status'];
                            $total_price = $row['total_price'];
                            $quantity_in_stock = $row['quantity_in_stock'];

                            // Format the dates
                            $formatted_date_ordered = date("F j, Y, g:i a", strtotime($order_date));
                            $formatted_date_delivery = date("F j, Y, g:i a", strtotime($delivery_date));
                        ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $client_name; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $client_email; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $client_address; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $product_name; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $quantity; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $quantity_in_stock; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $formatted_date_ordered; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $formatted_date_delivery; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap">$<?php echo $total_price; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo $status; ?></td>
                                <td class="px-6 py-6 whitespace-nowrap">
                                    <a href="../PHP/update_commande.php?id=<?php echo $commande_id; ?>&action=confirm" class="font-semibold text-black hover:underline">Confirm</a>
                                </td>
                                <td class="px-6 py-6 whitespace-nowrap">
                                    <a href="../PHP/update_commande.php?id=<?php echo $commande_id; ?>&action=delete" class="font-semibold text-black hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
            echo "<br><p>You don't have any orders.</p>";
        }

        ?>
        <br>

        <div class="mt-12 mb-6">
            <h1 class="text-3xl font-thin mb-4">My Products in Promotion :</h1>
        </div>

        <?php

        // Retrieve user's promotions from the database
        $sql_promotions = "SELECT id, name FROM promotions WHERE user_id = ?";
        $stmt_promotions = $con->prepare($sql_promotions);
        $stmt_promotions->bind_param("i", $_SESSION['cle']);
        $stmt_promotions->execute();
        $result_promotions = $stmt_promotions->get_result();

        // Retrieve products and their promotions from the database
        $sql = "SELECT 
            products.id as product_id, 
            products.name as product_name, 
            products.quantity as quantity_in_stock, 
            product_in_promotion.discount_percentage,
            promotions.name as promotion_name,
            promotions.id as promotion_id,
            promotions.start_date, 
            promotions.end_date
        FROM products 
        LEFT JOIN product_in_promotion ON products.id = product_in_promotion.product_id 
        LEFT JOIN promotions ON product_in_promotion.promotion_id = promotions.id
        WHERE products.user_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $_SESSION['cle']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are products
        if ($result->num_rows > 0) {
        ?>

            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 border border-1 border-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                PRODUCT NAME
                            </th>
                            <th scope="col" class="px-6 py-3">
                                QUANTITY IN STOCK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                PROMOTION NAME
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DISCOUNT PERCENTAGE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                START DATE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                END DATE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $product_id = $row['product_id'];
                            $product_name = $row['product_name'];
                            $quantity_in_stock = $row['quantity_in_stock'];
                            $promotion_name = $row['promotion_name'];
                            $promotion_id = $row['promotion_id'];
                            $discount_percentage = $row['discount_percentage'];
                            $start_date = $row['start_date'];
                            $end_date = $row['end_date'];

                            // Format the dates if the product is in promotion
                            $formatted_start_date = ($promotion_name) ? date("F j, Y, g:i a", strtotime($start_date)) : "";
                            $formatted_end_date = ($promotion_name) ? date("F j, Y, g:i a", strtotime($end_date)) : "";

                            // Check if the product has a promotion
                            $has_promotion = ($promotion_id !== null);

                        ?>
                            <tr class="border-b">
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo htmlspecialchars($product_name); ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo htmlspecialchars($quantity_in_stock); ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo htmlspecialchars($promotion_name ?: "None"); ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo htmlspecialchars($discount_percentage ?: "None"); ?> %</td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo htmlspecialchars($formatted_start_date); ?></td>
                                <td class="px-6 py-6 whitespace-nowrap"><?php echo htmlspecialchars($formatted_end_date); ?></td>
                                <td class="px-6 py-6 whitespace-nowrap">
                                    <?php if ($promotion_name) : ?>
                                        <form action="../PHP/remove_promotion.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <button type="submit" style="color: red;">Remove Promotion</button>
                                        </form>
                                    <?php else : ?>
                                        <form action="../PHP/apply_promotion.php" method="POST">
                                            <select name="promotion_id" class="px-6 py-2 rounded-full bg-white border border-1">
                                                <?php while ($promotion = $result_promotions->fetch_assoc()) : ?>
                                                    <option value="<?php echo $promotion['id']; ?>"><?php echo htmlspecialchars($promotion['name']); ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <button type="submit" style="color: black;">Apply Promotion</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
            echo "<br><p>You don't have any products.</p>";
        }

        $stmt_promotions->close();
        $stmt->close();
        $con->close();
        ?>
</body>