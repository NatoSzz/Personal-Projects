<?php
session_start();
require '../config/authentication.php';
require '../config/connection.php';

// Verificar se o ID da planta foi passado
if (!isset($_GET['id']) || empty($_GET['id'])) {
  $_SESSION["msg_erro"] = "Planta não encontrada";
  redireciona("../admin/list-plants.php");
  die();
}

$id_planta = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_planta) {
  $_SESSION["msg_erro"] = "ID inválido";
  redireciona("../admin/list-plants.php");
  die();
}

// Buscar dados da planta - ATUALIZADO COM TODOS OS CAMPOS
$sql = "SELECT p.*, 
               e.nome as especie_nome, e.descricao as especie_descricao,
               u.nome as usuario_nome
        FROM plantas p
        JOIN especies e ON e.id = p.id_especie
        JOIN usuarios u ON u.id = p.id_usuario
        WHERE p.id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$id_planta]);
$planta = $stmt->fetch();

// Verificar se a planta existe
if (!$planta) {
  $_SESSION["msg_erro"] = "Planta não encontrada";
  redireciona("../admin/list-plants.php");
  die();
}

require '../parts/header.php';
?>

<!-- Perfil da Planta -->
<section class="py-12 bg-white dark:bg-gray-900 transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-6">

    <!-- Cabeçalho e Informações Básicas -->
    <div class="grid md:grid-cols-2 gap-8 mb-12">
      <!-- Imagem da Planta -->
      <div class="rounded-2xl overflow-hidden shadow-lg">
        <?php if (!empty($planta['urlfoto'])): ?>
          <img src="<?= htmlspecialchars($planta['urlfoto']) ?>" alt="<?= htmlspecialchars($planta['nome']) ?>"
            class="w-full h-96 object-cover">
        <?php else: ?>
          <div class="w-full h-96 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
            <span class="text-gray-400 dark:text-gray-500">Sem imagem</span>
          </div>
        <?php endif; ?>
      </div>

      <!-- Informações -->
      <div class="space-y-6">
        <div>
          <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2"><?= htmlspecialchars($planta['nome']) ?>
          </h1>
          <p class="text-lg text-gray-600 dark:text-gray-300"><?= htmlspecialchars($planta['especie_nome']) ?></p>
        </div>

        <!-- Tags -->
        <div class="flex flex-wrap gap-2">
          <span
            class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 px-3 py-1 rounded-full text-sm"><?= htmlspecialchars($planta['especie_nome']) ?></span>
          <?php if (!empty($planta['dificuldade'])): ?>
            <span class="bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full text-sm"><?= htmlspecialchars($planta['dificuldade']) ?></span>
          <?php endif; ?>
        </div>

        <!-- Descrição -->
        <div>
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Descrição</h3>
          <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
            <?= !empty($planta['descricao']) ? nl2br(htmlspecialchars($planta['descricao'])) : 'Descrição não disponível.' ?>
          </p>
        </div>

        <!-- Informações Rápidas -->
        <div class="grid grid-cols-2 gap-4 bg-green-100 dark:bg-gray-800 rounded-2xl p-6">
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white">Espécie</h4>
            <p class="text-green-600 dark:text-green-400"><?= htmlspecialchars($planta['especie_nome']) ?></p>
          </div>
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white">Uso</h4>
            <p class="text-gray-600 dark:text-gray-300"><?= !empty($planta['uso']) ? htmlspecialchars($planta['uso']) : 'Não informado' ?></p>
          </div>
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white">Altura</h4>
            <p class="text-gray-600 dark:text-gray-300"><?= !empty($planta['altura']) ? htmlspecialchars($planta['altura']) : 'Não informada' ?></p>
          </div>
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white">Dificuldade</h4>
            <p class="text-green-600 dark:text-green-400"><?= !empty($planta['dificuldade']) ? htmlspecialchars($planta['dificuldade']) : 'Não informada' ?></p>
          </div>
        </div>
      </div>
    </div>

   <!-- Tutorial de Cultivo -->
   <div class="bg-green-100 dark:bg-gray-800 rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">🌱 Como Plantar e Cuidar</h2>
        
        <div class="grid md:grid-cols-2 gap-8">
          <!-- Plantio -->
          <div class="space-y-6">
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
              <span class="text-green-600">🪴</span> Plantio
            </h3>
            
            <div class="space-y-4">
              <div class="bg-white dark:bg-gray-700 rounded-xl p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">1. Preparação do Solo</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                 <?= !empty($planta['solo']) ? htmlspecialchars($planta['solo']) : 'Informação não disponível.' ?>
                </p>
              </div>

              <div class="bg-white dark:bg-gray-700 rounded-xl p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">2. Localização</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                <?= !empty($planta['locali']) ? htmlspecialchars($planta['locali']) : 'Informação não disponível.' ?>
                </p>
              </div>

              <div class="bg-white dark:bg-gray-700 rounded-xl p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">3. Plantio</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                <?= !empty($planta['plantio']) ? htmlspecialchars($planta['plantio']) : 'Informação não disponível.' ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Cuidados -->
          <div class="space-y-6">
            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
              <span class="text-green-600">💧</span> Cuidados Diários
            </h3>
            
            <div class="space-y-4">
              <div class="bg-white dark:bg-gray-700 rounded-xl p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">1. Rega</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                  <?= !empty($planta['rega']) ? htmlspecialchars($planta['rega']) : 'Informação não disponível.' ?>
                </p>
              </div>

              <div class="bg-white dark:bg-gray-700 rounded-xl p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">2. Adubação</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                 <?= !empty($planta['adubacao']) ? htmlspecialchars($planta['adubacao']) : 'Informação não disponível.' ?>
                </p>
              </div>

              <div class="bg-white dark:bg-gray-700 rounded-xl p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">3. Poda</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                  <?= !empty($planta['poda']) ? htmlspecialchars($planta['poda']) : 'Informação não disponível.' ?>
                </p>
              </div>

              <div class="bg-white dark:bg-gray-700 rounded-xl p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">4. Cuidados Gerais</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                  <?= !empty($planta['cuidados']) ? htmlspecialchars($planta['cuidados']) : 'Informação não disponível.' ?>
                </p>
              </div>
            </div>
          </div>
        </div>

      <!-- Dicas Extras -->
      <div class="mt-8 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl p-6">
        <h4 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-3">💡 Dicas Importantes</h4>
        <ul class="text-yellow-700 dark:text-yellow-300 text-sm space-y-2">
          <li>• Observe regularmente a planta para identificar necessidades de água e nutrientes</li>
          <li>• Adapte os cuidados conforme as estações do ano</li>
          <li>• Mantenha o solo com boa drenagem para evitar encharcamento</li>
          <li>• Considere as condições específicas do seu ambiente de cultivo</li>
        </ul>
      </div>
    </div>

    <!-- Botões de Ação -->
    <div class="flex justify-between items-center mt-8">
      <a href="cards-plants.php"
        class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition">
        ← Voltar para a Lista de Plantas
      </a>

      <?php if (autenticado() || admin()){ ?>
        <div class="flex gap-3">

          <!-- Botão para adicionar ao jardim -->
          <a href="add-plant-garden.php?id=<?= $planta['id'] ?>"
            class="inline-flex items-center gap-2 px-6 py-3 bg-green-500 text-white rounded-full hover:bg-green-600 transition"
            onclick="return confirm('Adicionar <?= htmlspecialchars($planta['nome']) ?> ao seu jardim?')">
            🌿 Adicionar ao Meu Jardim
          </a>

        <?php if (admin()){ ?>
          <a href="form-update-plants.php?id=<?= $planta['id'] ?>"
            class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition">
            ✏️ Editar Planta
          </a>
          <a href="delete-plants.php?id=<?= $planta['id'] ?>"
            class="inline-flex items-center gap-2 px-6 py-3 bg-red-500 text-white rounded-full hover:bg-red-600 transition"
            onclick="return confirm('Tem certeza que deseja excluir esta planta?')">
            🗑️ Excluir Planta
          </a>
        <?php } ?>
        
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<?php
require '../parts/footer.php';
?>