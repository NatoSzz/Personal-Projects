<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Physis</title>

  <!-- Google Fonts Link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Meow+Script&display=swap" rel="stylesheet">

  <!-- CDN Tailwind CSS Link-->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom CSS Link-->
  <link rel="stylesheet" href="../style/css/style.css">

</head>

<body class="pt-4">


  <!-- NavBar -->
  <nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md px-6 py-4 shadow-md">
    <div class="flex items-center justify-between max-w-7xl mx-auto">

      <!-- Logo -->
      <div class="flex items-center gap-2">
        <img src="../img/logo.png" alt="Logo" class="w-10 h-10">
        <span class="text-2xl font-bold text-green-700">Physis</span>
      </div>

      <!-- Links Desktop -->
      <ul class="hidden md:flex gap-6 text-gray-700 font-medium">
        <li>
          <a href="../interface/home.php" class="relative pb-1 hover:text-green-700 transition 
                  after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-green-600 after:transition-all after:duration-300 hover:after:w-full">
            Home
          </a>
        </li>
        </li>
        <li>
          <a href="../plants/cards-plants.php" class="relative pb-1 hover:text-green-700 transition 
                  after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-green-600 after:transition-all after:duration-300 hover:after:w-full">
            Plantas
          </a>
        </li>
        <?php
        if (autenticado() || admin()) {
        ?>
          <li>
            <a href="../garden/my-garden.php" class="relative pb-1 hover:text-green-700 transition 
                  after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-green-600 after:transition-all after:duration-300 hover:after:w-full">
              Seu Jardim
            </a>
          </li>
        <?php
        }
        ?>
        <li>
          <a href="../interface/FaQs.php" class="relative pb-1 hover:text-green-700 transition 
                  after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-0 after:h-[2px] after:bg-green-600 after:transition-all after:duration-300 hover:after:w-full">
            FAQs
          </a>
        </li>
      </ul>

      <?php
      if (!autenticado()) {
      ?>
        <!-- Botões Desktop -->
        <div class="hidden md:flex gap-3">
          <a href="../user/form-insert-user.php" class="px-4 py-2 rounded-full bg-green-600 text-white hover:bg-green-700 transition">Cadastro</a>
          <a href="../user/form-login.php" class="px-4 py-2 rounded-full bg-green-600 text-white hover:bg-green-700 transition">Login</a>
        </div>
      <?php
      } else if (autenticado() && !admin()) {
      ?>
        <!-- Perfil do Usuário (Após Login) -->
        <div class="flex gap-3">
          <div class="relative">
            <button id="userMenuButton" class="flex items-center gap-3 px-3 py-2 rounded-full hover:bg-green-50 dark:hover:bg-gray-700 transition">
              <img src="<?= foto_usuario(); ?>" alt="Usuário" class="w-8 h-8 rounded-full object-cover border-2 border-green-500">
              <span class="font-medium text-gray-700 dark:text-gray-200"><?= nome_usuario(); ?></span>
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="userDropdown" class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50">
              <a href="../user/account.php" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Minha Conta
              </a>

              <a href="../garden/my-garden.php" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                </svg>

                Meu Jardim
              </a>

              <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>

              <a href="../config/exit.php" class="flex items-center gap-3 px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Sair
              </a>
            <?php
          } else if (admin()) {
            ?>

              <!-- Perfil do Usuário (Após Login) -->
              <div class="flex gap-3">
                <div class="relative">
                  <button id="userMenuButton" class="flex items-center gap-3 px-3 py-2 rounded-full hover:bg-green-50 dark:hover:bg-gray-700 transition">
                    <img src="<?= foto_usuario(); ?>" alt="Usuário" class="w-8 h-8 rounded-full object-cover border-2 border-green-500">
                    <span class="font-medium text-gray-700 dark:text-gray-200"><?= nome_usuario(); ?></span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                  </button>

                  <!-- Dropdown Menu -->
                  <div id="userDropdown" class="dropdown-menu absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50">
                    <a href="../user/account.php" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 transition">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                      Minha Conta
                    </a>

                    <a href="../plants/form-register-plants.php" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 transition">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                      </svg>
                      Inserir Plantas
                    </a>

                    <a href="../species/form-register-species.php" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-gray-700 transition">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                      </svg>
                      Inserir Espécies
                    </a>

                    <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>

                    <a href="../config/exit.php" class="flex items-center gap-3 px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                      </svg>
                      Sair
                    </a>

                  </div>
                </div>
              </div>

            <?php
          }
            ?>

            <!-- Menu Mobile -->
            <div class="flex items-center gap-3 md:hidden">
              <!-- Botão Menu Mobile -->
              <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                <svg id="menu-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="menu-close" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            </div>

            <!-- Menu Mobile Dropdown -->
            <div id="mobile-menu" class="md:hidden mt-4 bg-white rounded-lg shadow-lg py-2 hidden">
              <a href="../interface/home.php" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition border-b">Home</a>
              <a href="../plants/cards-plants.php" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition border-b">Plantas</a>
              <a href="../interface/FaQs.php" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition border-b">FAQs</a>
              <div class="px-4 py-3 flex flex-col gap-2">
                <a href="../user/form-insert-user.php" class="px-4 py-2 rounded-full bg-green-600 text-white hover:bg-green-700 transition text-center">Cadastro</a>
                <a href="../user/form-login.php" class="px-4 py-2 rounded-full bg-green-600 text-white hover:bg-green-700 transition text-center">Login</a>
              </div>
            </div>
  </nav>
  <!-- End NavBar -->