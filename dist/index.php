<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/images/logo1.png" type="">
  <title>ShoPage - Home</title>
  <link rel="stylesheet" href="/src/output.css">
</head>

<body>
  <nav class="border-b border-gray-200 p-6">
    <div class="container mx-auto flex items-center justify-between">

      <!-- Logo -->
      <a href="index.php" class="flex items-center text-gray-800 text-2xl font-bold">
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

  <!-- HERO SECTION -->
  <section class="lg:pt-24 bg-white" style="padding-top: 10rem;">
    <div class="px-12 mx-auto max-w-7xl">
      <div class="w-full mx-auto text-left md:w-11/12 xl:w-9/12 md:text-center">
        <h1 class="mb-8 text-5xl font-bold leading-none tracking-normal text-gray-900 md:text-6xl md:tracking-tight">
          <span>Create </span> <span class="block w-full py-2 text-transparent bg-clip-text leading-12 bg-gradient-to-r from-gray-400 to-green-500 lg:inline">Stunning </span> <span>Landing Pages Effortlessly</span>
        </h1>
        <p class="px-0 mb-8 text-lg text-gray-600 md:text-xl lg:px-24">
          Unlock your online business potential with ShoPage's user-friendly tools. Design and customize beautiful landing pages with ease, and watch your conversions soar. Start your journey today.
        </p>
        <div class="mb-4 space-x-0 md:space-x-2 md:mb-8">
          <a href="/authentification/login.php" class="inline-flex items-center justify-center w-full px-6 py-3 mb-2 text-lg text-white bg-black rounded-lg sm:w-auto sm:mb-0 hover:bg-green-500 transition duration-300 ease-in-out">
            Get Started
            <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </a>
          <a href="about.php" class="inline-flex items-center justify-center w-full px-6 py-3 mb-2 text-lg bg-gray-100 rounded-lg sm:w-auto sm:mb-0">
            Learn More
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
          </a>
        </div>
      </div>
      <img src="/images/screenshot.png">
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-48 bg-gray-50 sm:py-16 lg:py-24">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="max-w-2xl mx-auto text-center">
        <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">How do we create success</h2>
        <p class="max-w-lg mx-auto mt-4 text-base leading-relaxed text-gray-600">With these 3 simple steps, you can have your own unique landig page for your ecommerce project</p>
      </div>

      <ul class="max-w-md mx-auto mt-16 space-y-12">
        <li class="relative flex items-start">
          <div class="-ml-0.5 absolute mt-0.5 top-14 left-8 w-px border-l-4 border-dotted border-gray-300 h-full" aria-hidden="true"></div>

          <div class="relative flex items-center justify-center flex-shrink-0 w-16 h-16 bg-white rounded-full shadow">
            <svg class="w-10 h-10 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <div class="ml-6">
            <h3 class="text-lg font-semibold text-black">Create a free account</h3>
            <p class="mt-4 text-base text-gray-600">Start your journey by creating a free account on our platform. This quick and simple process grants you access to a wealth of tools and resources to help you succeed online.</p>
          </div>
        </li>

        <li class="relative flex items-start">
          <div class="-ml-0.5 absolute mt-0.5 top-14 left-8 w-px border-l-4 border-dotted border-gray-300 h-full" aria-hidden="true"></div>

          <div class="relative flex items-center justify-center flex-shrink-0 w-16 h-16 bg-white rounded-full shadow">
            <svg class="w-10 h-10 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
            </svg>
          </div>
          <div class="ml-6">
            <h3 class="text-lg font-semibold text-black">Build your website</h3>
            <p class="mt-4 text-base text-gray-600">Design your own website with our intuitive tools. Customize your site with ease, making it uniquely yours while ensuring a seamless experience for your visitors.</p>
          </div>
        </li>

        <li class="relative flex items-start">
          <div class="relative flex items-center justify-center flex-shrink-0 w-16 h-16 bg-white rounded-full shadow">
            <svg class="w-10 h-10 text-fuchsia-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <div class="ml-6">
            <h3 class="text-lg font-semibold text-black">Get the website resources</h3>
            <p class="mt-4 text-base text-gray-600">Download the resources for your customized landing page in one easy to deploy folder.</p>
          </div>
        </li>
      </ul>
    </div>
  </section>

  <!-- RECENT TEMPLATES -->
  <div class="container mx-auto mt-16 px-4 pb-16">
    <h2 class="text-3xl mb-4">Recent Templates</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      require("../connexion.php");

      // Fetch all templates from the "templates" table
      $sql = "SELECT * FROM templates LIMIT 3";
      $result = mysqli_query($con, $sql);

      // Check if there are any templates
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // Extract data from the current row
          $id = $row['id'];
          $name = $row['name'];
          $description = $row['description'];
          $image_url = $row['image'];
          $html = $row['html'];
          $css = $row['css'];
          $js = $row['js'];

          $maxLength = 140;

          // Generate HTML for each template as a card wrapped in an <a> tag
          echo '<a href="template_page.php?id=' . htmlspecialchars($id) . '" class="block">';
          echo '<div class="bg-white border border-1 border-gray-200 rounded-lg p-6 transition transform hover:scale-105" style="height: 400px;">'; // Fixed height
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
        echo "<p class='text-gray-600'>No templates available.</p>";
      }

      // Close the database connection
      mysqli_close($con);
      ?>


    </div>
    <br>
    <div class="mx-auto items-center"><a href="templates.php" class="text-center text-gray-600 m-auto underline">See More</a></div>

  </div>





  <br><br><br>

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