<?php
session_start();
require '../config/authentication.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

require '../config/connection.php';

// Buscar espécies do banco de dados
$sqlCat = "SELECT id, nome FROM especies ORDER BY 2";
$stmtCat = $conn->query($sqlCat);

require '../parts/header.php';
?>

  <!-- Formulário de Plantas -->
  <section class="py-12 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-6">
      
      <!-- Cabeçalho -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Cadastrar Planta</h1>
        <p class="text-gray-600 dark:text-gray-400">Adicione novas plantas ao seu jardim virtual</p>
      </div>

      <!-- Mensagens de Feedback -->
      <?php if (isset($_SESSION["result"])): ?>
        <?php if ($_SESSION["result"] == true): ?>
          <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 dark:bg-green-800 dark:border-green-600 dark:text-green-100 rounded-lg">
            <h4 class="font-semibold"><?= $_SESSION["msg_sucesso"]; ?></h4>
          </div>
          <?php unset($_SESSION["msg_sucesso"]); ?>
        <?php else: ?>
          <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 dark:bg-red-800 dark:border-red-600 dark:text-red-100 rounded-lg">
            <h4 class="font-semibold"><?= $_SESSION["msg_erro"]; ?></h4>
            <p class="mt-1 text-sm"><?= $_SESSION["erro"]; ?></p>
          </div>
          <?php 
          unset($_SESSION["msg_erro"]);
          unset($_SESSION["erro"]);
          ?>
        <?php endif; ?>
        <?php unset($_SESSION["result"]); ?>
      <?php endif; ?>

      <!-- Formulário -->
      <form action="add-plant.php" method="POST" class="bg-green-50 dark:bg-gray-800 rounded-2xl p-8">
        <div class="grid md:grid-cols-1 gap-6">
          
          <!-- Nome da Planta -->
          <div>
            <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome da Planta *</label>
            <input type="text" id="nome" name="nome" required
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                   placeholder="Ex: Rosa Vermelha, Suculenta Echeveria"
                   value="<?= isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '' ?>">
          </div>

          <!-- Espécie -->
          <div>
            <label for="especie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Espécie *</label>
            <select id="especie" name="especie" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
              <option value="">[Escolha qual a espécie da planta]</option>
              <?php while ($rowCat = $stmtCat->fetch()): ?>
                <option value="<?= $rowCat['id']; ?>" 
                        <?= (isset($_POST['especie']) && $_POST['especie'] == $rowCat['id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($rowCat['nome']); ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <!-- URL da Foto -->
          <div>
            <label for="urlfoto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL da Foto *</label>
            <input type="url" id="urlfoto" name="urlfoto" required
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                   placeholder="https://exemplo.com/foto-da-planta.jpg"
                   value="<?= isset($_POST['urlfoto']) ? htmlspecialchars($_POST['urlfoto']) : '' ?>"
                   onchange="updatePreview()">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Endereço http de uma imagem da internet</p>
          </div>

          <!-- Altura -->
          <div>
            <label for="altura" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Altura</label>
            <input type="text" id="altura" name="altura"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                   placeholder="Ex: 0.5m a 1.2m"
                   value="<?= isset($_POST['altura']) ? htmlspecialchars($_POST['altura']) : '' ?>">
          </div>

          <!-- Uso -->
          <div>
            <label for="uso" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Uso</label>
            <textarea id="uso" name="uso" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva os usos da planta (ornamental, medicinal, culinário, etc)..."><?= isset($_POST['uso']) ? htmlspecialchars($_POST['uso']) : '' ?></textarea>
          </div>

          <!-- Solo -->
          <div>
            <label for="solo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Solo</label>
            <textarea id="solo" name="solo" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva o tipo de solo ideal..."><?= isset($_POST['solo']) ? htmlspecialchars($_POST['solo']) : '' ?></textarea>
          </div>

          <!-- Localização -->
          <div>
            <label for="locali" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Localização Ideal</label>
            <textarea id="locali" name="locali" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva a localização ideal (sol pleno, meia-sombra, sombra, etc)..."><?= isset($_POST['locali']) ? htmlspecialchars($_POST['locali']) : '' ?></textarea>
          </div>

          <!-- Plantio -->
          <div>
            <label for="plantio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Forma de Plantio</label>
            <textarea id="plantio" name="plantio" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva como realizar o plantio..."><?= isset($_POST['plantio']) ? htmlspecialchars($_POST['plantio']) : '' ?></textarea>
          </div>

          <!-- Rega -->
          <div>
            <label for="rega" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rega</label>
            <textarea id="rega" name="rega" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva a frequência e forma de rega..."><?= isset($_POST['rega']) ? htmlspecialchars($_POST['rega']) : '' ?></textarea>
          </div>

          <!-- Adubação -->
          <div>
            <label for="adubacao" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adubação</label>
            <textarea id="adubacao" name="adubacao" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva a adubação recomendada..."><?= isset($_POST['adubacao']) ? htmlspecialchars($_POST['adubacao']) : '' ?></textarea>
          </div>

          <!-- Poda -->
          <div>
            <label for="poda" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Poda</label>
            <textarea id="poda" name="poda" rows="3"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva como e quando podar..."><?= isset($_POST['poda']) ? htmlspecialchars($_POST['poda']) : '' ?></textarea>
          </div>

          <!-- Dificuldade -->
          <div>
            <label for="dificuldade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dificuldade de Cultivo</label>
            <select id="dificuldade" name="dificuldade"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
              <option value="">Selecione a dificuldade</option>
              <option value="Fácil" <?= (isset($_POST['dificuldade']) && $_POST['dificuldade'] == 'Fácil') ? 'selected' : '' ?>>Fácil</option>
              <option value="Médio" <?= (isset($_POST['dificuldade']) && $_POST['dificuldade'] == 'Médio') ? 'selected' : '' ?>>Médio</option>
              <option value="Difícil" <?= (isset($_POST['dificuldade']) && $_POST['dificuldade'] == 'Difícil') ? 'selected' : '' ?>>Difícil</option>
            </select>
          </div>

          <!-- Forma de Cultivar/Cuidados -->
          <!--<div>
            <label for="cuidados" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Forma de Cultivar e Cuidados *</label>
            <textarea id="cuidados" name="cuidados" rows="4" required
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Descreva como cultivar e cuidar desta planta..."
                      oninput="updatePreview()"><?= isset($_POST['cuidados']) ? htmlspecialchars($_POST['cuidados']) : '' ?></textarea>
          </div>-->

          <!-- Descrição Detalhada -->
          <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descrição Detalhada</label>
            <textarea id="descricao" name="descricao" rows="4"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Forneça uma descrição detalhada sobre a planta..."
                      oninput="updatePreview()"><?= isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : '' ?></textarea>
          </div>

        </div>

        <!-- Botões -->
        <div class="flex flex-col sm:flex-row gap-4 mt-8">
          <button type="submit" 
                  class="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-medium">
            Cadastrar Planta
          </button>
          <button type="reset" 
                  class="flex-1 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 py-3 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition font-medium"
                  onclick="clearPreview()">
            Limpar
          </button>
        </div>
      </form>

      <!-- Preview da Planta -->
      <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Preview da Planta</h2>
        
        <div class="bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <img id="previewImage" src="" alt="Preview da planta" 
                   class="w-full h-64 object-cover rounded-lg border-2 border-gray-300 dark:border-gray-600 hidden">
              <div id="noPreview" class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                <span class="text-gray-500 dark:text-gray-400">Nenhuma imagem selecionada</span>
              </div>
            </div>
            <div>
              <h3 id="previewNome" class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                <?= isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : 'Nome da Planta' ?>
              </h3>
              <p id="previewDescricao" class="text-gray-600 dark:text-gray-300 mb-4">
                <?= isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : 'Descrição aparecerá aqui...' ?>
              </p>
              <div class="bg-white dark:bg-gray-700 rounded-lg p-4">
                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Cuidados:</h4>
                <p id="previewCuidados" class="text-gray-600 dark:text-gray-300 text-sm">
                  <?= isset($_POST['cuidados']) ? htmlspecialchars($_POST['cuidados']) : 'Instruções de cultivo aparecerão aqui...' ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
require '../parts/footer.php';
?>
