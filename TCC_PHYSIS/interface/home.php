<?php
session_start();
require '../config/authentication.php';

require '../parts/header.php';
?>

  <!-- Hero -->
  <section id="home"
    class="relative h-[500px] flex items-center justify-center text-center text-white bg-cover bg-center mt-16"
    style="background-image: url('../img/hero-background.jpg')">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Projeto Physis</h1>
      <p class="text-lg md:text-xl mb-6">Lado a lado com a natureza</p>
      <a href="#sobre" class="px-6 py-3 bg-green-600 rounded-full hover:bg-green-700 transition">Veja mais</a>
    </div>
  </section>
  <!-- End Hero -->


  <!-- Service Cards -->

  <!-- Div Title-->
  <section class="py-16 bg-green-50">
    <h2 class="text-3xl font-bold text-center mb-10">Nossos Serviços</h2>
    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6">

      <!-- Card 1 -->
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition">
        <img src="../img/plantas.jpg" alt="Plantas" class="w-full h-48 object-cover">
        <div class="p-6 text-center">
          <h3 class="text-xl font-semibold mb-2">Plantas</h3>
          <p class="text-gray-600 mb-4">Veja todas as plantas que temos em nossos dados.</p>
          <a href="../plants/cards-plants.php" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700">Ir</a>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition">
        <img src="../img/jardim.jpg" alt="Jardim" class="w-full h-48 object-cover">
        <div class="p-6 text-center">
          <h3 class="text-xl font-semibold mb-2">Jardim</h3>
          <p class="text-gray-600 mb-4">Veja as plantas que você possui e como cuidar delas.</p>
          <a href="../garden/my-garden.php" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700">Ir</a>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition">
        <img src="../img/perfil.jpg" alt="Perfil" class="w-full h-48 object-cover">
        <div class="p-6 text-center">
          <h3 class="text-xl font-semibold mb-2">Perfil</h3>
          <p class="text-gray-600 mb-4">Veja seu perfil e personalize da maneira que desejar.</p>
          <a href="../user/account.php" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700">Ir</a>
        </div>
      </div>

    </div>
  </section>
  <!-- End Service Cards -->

  <?php
if (isset($_SESSION["restrito"]) && $_SESSION["restrito"]) {
    ?>
    <div class="alert alert-danger" role="alert">
        <h4>Esta é uma página PROTEGIDA!</h4>
        <p>Você está tentando acessar um conteúdo restrito</p>
    </div>
    <?php
    unset($_SESSION["restrito"]);
}

require '../parts/footer.php';
?>