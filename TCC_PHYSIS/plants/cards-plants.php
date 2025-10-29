<?php
session_start();
require '../config/authentication.php';
require '../config/connection.php';

// Lógica de ordenação
if (isset($_GET["ordem"]) && !empty($_GET["ordem"])) {
    $ordem = filter_input(INPUT_GET, "ordem", FILTER_SANITIZE_SPECIAL_CHARS);
} else {
    $ordem = "nome";
}

// Lógica de busca
$buscaOriginal = "";
if (isset($_POST["busca"]) && !empty($_POST["busca"])) {
    $busca = filter_input(INPUT_POST, "busca", FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo_busca = filter_input(INPUT_POST, "tipo_busca", FILTER_SANITIZE_SPECIAL_CHARS);
    $buscaOriginal = $busca;

    if ($tipo_busca == "nome") {
        $busca = "%" . $busca . "%";
        $sql = "SELECT id, nome, urlfoto, descricao FROM plantas WHERE nome like ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$busca]);
    } elseif ($tipo_busca == "id") {
        $sql = "SELECT id, nome, urlfoto, descricao FROM plantas WHERE id = ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$busca]);
    } elseif ($tipo_busca == "descricao") {
        $busca = "%" . $busca . "%";
        $sql = "SELECT id, nome, urlfoto, descricao FROM plantas WHERE descricao like ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$busca]);
    } else {
        $buscaInt = intval($busca);
        $busca = "%" . $busca . "%";
        $sql = "SELECT id, nome, urlfoto, descricao FROM plantas WHERE nome like ? OR descricao like ? OR id = ? ORDER BY $ordem";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$busca, $busca, $buscaInt]);
    }
} else {
    $sql = "SELECT id, nome, urlfoto, descricao FROM plantas ORDER BY $ordem";
    $stmt = $conn->query($sql);
}

require '../parts/header.php';
?>

<!-- Seção Plantas -->
<section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6">
      
      <!-- Cabeçalho -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
            <?php 
            if (isset($_POST["busca"]) && !empty($_POST["busca"])) {
                echo 'Resultados da busca para "' . htmlspecialchars($buscaOriginal) . '"';
            } else {
                echo 'Procurar todas as plantas';
            }
            ?>
          </h2>
          <?php if (isset($_POST["busca"]) && !empty($_POST["busca"])): ?>
            <a href="cards-plants.php" class="text-green-600 dark:text-green-400 hover:underline text-sm">
              LIMPAR BUSCA
            </a>
          <?php else: ?>
            <button class="text-green-600 dark:text-green-400 hover:underline text-sm" onclick="clearFilters()">
              DESMARCAR TODOS OS FILTROS
            </button>
          <?php endif; ?>
        </div>
        <div class="mt-4 md:mt-0">
          <select id="ordenacao" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 text-gray-900 dark:text-white" onchange="changeOrder(this.value)">
            <option value="nome" <?= $ordem == 'nome' ? 'selected' : '' ?>>Nome A-Z</option>
            <option value="nome DESC" <?= $ordem == 'nome DESC' ? 'selected' : '' ?>>Nome Z-A</option>
            <option value="id" <?= $ordem == 'id' ? 'selected' : '' ?>>Mais Recentes</option>
            <option value="id DESC" <?= $ordem == 'id DESC' ? 'selected' : '' ?>>Mais Antigos</option>
          </select>
        </div>
      </div>

      <!-- Sistema de Busca -->
      <div class="mb-8 bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
        <form action="" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
          <div class="flex-1">
            <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Buscar plantas</label>
            <div class="flex flex-col md:flex-row gap-2">
              <select name="tipo_busca" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-gray-900 dark:text-white md:w-48">
                <option value="">Todos os campos</option>
                <option value="id">ID</option>
                <option value="nome">Nome</option>
                <option value="descricao">Descrição</option>
              </select>
              <input type="text" name="busca" value="<?= htmlspecialchars($buscaOriginal) ?>" 
                     class="flex-1 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-gray-900 dark:text-white" 
                     placeholder="Digite sua busca...">
            </div>
          </div>
          <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
            Pesquisar
          </button>
        </form>
      </div>

      <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Sidebar de Filtros -->
        <div class="lg:w-1/4 bg-green-50 dark:bg-gray-800 rounded-2xl p-6 h-fit">
          <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">Filtros</h3>
          
          <div class="space-y-4">
            <!-- Filtro: Nome -->
            <div>
              <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Nome da planta</label>
              <input type="text" class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-gray-900 dark:text-white" placeholder="Buscar...">
            </div>

            <!-- Filtro: Categoria -->
            <div>
              <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Categoria</label>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input type="checkbox" class="rounded text-green-600">
                  <span class="ml-2 text-gray-700 dark:text-gray-300">Plantas Ornamentais</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded text-green-600">
                  <span class="ml-2 text-gray-700 dark:text-gray-300">Plantas Medicinais</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded text-green-600">
                  <span class="ml-2 text-gray-700 dark:text-gray-300">Suculentas</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded text-green-600">
                  <span class="ml-2 text-gray-700 dark:text-gray-300">Árvores</span>
                </label>
              </div>
            </div>

            <!-- Filtro: Dificuldade de Cultivo -->
            <div>
              <label class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">Dificuldade</label>
              <div class="space-y-2">
                <label class="flex items-center">
                  <input type="checkbox" class="rounded text-green-600">
                  <span class="ml-2 text-gray-700 dark:text-gray-300">Fácil</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded text-green-600">
                  <span class="ml-2 text-gray-700 dark:text-gray-300">Moderado</span>
                </label>
                <label class="flex items-center">
                  <input type="checkbox" class="rounded text-green-600">
                  <span class="ml-2 text-gray-700 dark:text-gray-300">Difícil</span>
                </label>
              </div>
            </div>

            <!-- Botão Aplicar Filtros -->
            <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
              Aplicar Filtros
            </button>
          </div>
        </div>

        <!-- Grid de Plantas -->
        <div class="lg:w-3/4">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <?php
            $plantCount = 0;
            while ($row = $stmt->fetch()) {
                $plantCount++;
                // Simulação de dificuldade baseada no ID (para exemplo)
                $dificuldades = ['Fácil', 'Moderado', 'Difícil'];
                $dificuldade = $dificuldades[$row['id'] % 3];
                $dificuldadeClass = $dificuldade == 'Fácil' ? 'text-green-600 dark:text-green-400' : 
                                   ($dificuldade == 'Moderado' ? 'text-yellow-600 dark:text-yellow-400' : 
                                   'text-red-600 dark:text-red-400');
            ?>
                <!-- Card de Planta Dinâmico -->
                <div class="bg-green-50 dark:bg-gray-800 rounded-2xl overflow-hidden hover:scale-105 transition cursor-pointer">
                  <img src="<?= htmlspecialchars($row['urlfoto']) ?>" alt="<?= htmlspecialchars($row['nome']) ?>" class="w-full h-48 object-cover">
                  <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2"><?= htmlspecialchars($row['nome']) ?></h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-3"><?= htmlspecialchars($row['descricao']) ?></p>
                    <div class="flex justify-between items-center">
                    <span class="text-green-600 dark:text-green-400 font-semibold"><?=$dificuldade;?></span>
                      <a href="plants-profile.php?id=<?= $row['id'] ?>" class="bg-green-600 text-white px-4 py-1 rounded-full text-sm hover:bg-green-700 transition">
                        Ver detalhes
                      </a>
                    </div>
                  </div>
                </div>
            <?php
            }
            
            if ($plantCount === 0) {
                echo '<div class="col-span-3 text-center py-8 text-gray-500 dark:text-gray-400">Nenhuma planta encontrada.</div>';
            }
            ?>

          </div>

          <!-- Load More -->
          <?php if ($plantCount > 0): ?>
          <div class="text-center mt-8">
            <button class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition">
              Carregar mais plantas
            </button>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>


<?php
require '../parts/footer.php';
?>