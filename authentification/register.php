<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/images/logo1.png" type="">
  <title>ShoPage - Register</title>
  <link rel="stylesheet" href="/src/output.css">
</head>

<body>
  <!-- NAV BAR -->
  <nav class="border-b border-gray-200 p-6">
    <div class="container mx-auto flex items-center justify-between">
      <!-- Logo -->
      <a href="../dist/index.php" class="flex items-center text-gray-800 text-xl font-bold">
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
        <a href="../dist/index.php" class="block text-gray-800 hover:text-gray-900 py-2">Home</a>
        <a href="../dist/about.php" class="block text-gray-800 hover:text-gray-900 py-2">About</a>
        <a href="../dist/templates.php" class="block text-gray-800 hover:text-gray-900 py-2">Templates</a>
        <?php if (isset($_SESSION['login'])) : ?>
          <!-- If the user is logged in, display the Log Out link -->
          <a href="../dist/landingPages.php" class="block text-gray-800 hover:text-gray-900 py-2">My Landing Pages</a>

          <a href="/authentification/deconnexion.php" class="block text-gray-800 hover:text-gray-900 py-2">| Log Out</a>
        <?php else : ?>
          <!-- If the user is not logged in, display the Log In link -->
          <a href="/authentification/login.php" class="block bg-black px-4 text-white rounded-lg hover:bg-green-500 transition duration-300 ease-in-out py-2">Join Us</a>
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
  <!--
    Heads up! 👋

    Plugins:
      - @tailwindcss/forms
  -->

  <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg text-center">
      <h1 class="text-2xl font-bold sm:text-3xl">Get started today!</h1>

      <p class="mt-4 text-gray-500">
        Unlock your online business potential with ShoPage's user-friendly tools. Design and customize beautiful landing pages with ease,
        and watch your conversions soar.
        Start your journey today.
      </p>
    </div>

    <form action="../PHP/user-add.php" method="POST" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
      <div>
        <label for="username" class="">username</label>

        <div class="relative">
          <input type="text" name="username" class="w-full rounded-lg p-4 pe-12 text-sm border border-1 border-gray-300" placeholder="Enter username" />

          <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
          </span>
        </div>
      </div>

      <div>
        <label for="email" class="">Email</label>

        <div class="relative">
          <input type="email" name="email" class="w-full rounded-lg p-4 pe-12 text-sm border border-1 border-gray-300" placeholder="Enter email" />

          <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
          </span>
        </div>
      </div>

      <div>
        <label for="password" class="">Password</label>

        <div class="relative">
          <input type="password" name="password" class="w-full rounded-lg p-4 pe-12 text-sm border border-1 border-gray-300" placeholder="Enter password" />

          <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </span>
        </div>
      </div>

      <button type="submit" class="w-full px-5 py-2 mb-2 text-lg text-white bg-black rounded-lg lg:w-auto sm:mb-0 hover:bg-green-500 transition duration-300 ease-in-out">
        Sign Up
      </button>
      <hr>
      <p class="text-sm text-gray-500">
        Already have an account?
        <a class="underline" href="/authentification/login.php">Log in</a>
      </p>
    </form>
  </div>

</body>

</html>