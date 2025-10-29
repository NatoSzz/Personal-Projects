<?php
session_start();
require '../config/authentication.php';

/** Tratamento de permissões */
if (!autenticado() || !admin()) {
    $_SESSION["restrito"] = true;
    redireciona("../index.php");
    die();
}
/** Tratamento de permissões */

require '../config/connection.php';

if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, "id");

    $sql = "select id, nome, descricao FROM especies where ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    $rowEspecie = $stmt->fetch();

    $nome = $rowEspecie["nome"];
    $descricao = $rowEspecie["descricao"];
    $action = "update-species.php";
} else {
    $id = null;
    $nome = null;
    $descricao = null;
    $action = "register-species.php";
}

require '../parts/header.php';

if (isset($_SESSION["result"])) {
    if ($_SESSION["result"]) {
?>
        <div class="max-w-4xl mx-auto mt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <h4 class="font-bold"><?= $_SESSION["msg_sucesso"] ?></h4>
            </div>
        </div>
    <?php
        unset($_SESSION["msg_sucesso"]);
    } else {
    ?>
        <div class="max-w-4xl mx-auto mt-6">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <h4 class="font-bold"><?= $_SESSION["msg_erro"] ?></h4>
                <p><?= $_SESSION["erro"] ?></p>
            </div>
        </div>
<?php
        unset($_SESSION["erro"]);
        unset($_SESSION["msg_erro"]);
    }
    unset($_SESSION["result"]);
}
?>

  <!-- Formulário de Espécies -->
  <section class="py-12 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-6">
      
      <!-- Cabeçalho -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
            <?= isset($id) ? "Editar Espécie" : "Cadastrar Espécie" ?>
        </h1>
        <p class="text-gray-600 dark:text-gray-400">
            <?= isset($id) ? "Edite os dados da espécie" : "Adicione novas espécies de plantas ao sistema" ?>
        </p>
      </div>

      <!-- Formulário -->
      <form action="<?= $action ?>" method="POST" class="bg-green-50 dark:bg-gray-800 rounded-2xl p-8">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="grid md:grid-cols-1 gap-6">
          
          <!-- Nome da Espécie -->
          <div>
            <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome da Espécie *</label>
            <input type="text" id="nome" name="nome" required
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                   placeholder="Ex: Rosa, Suculenta, Lavanda"
                   value="<?= $nome ?>">
          </div>

          <!-- Descrição -->
          <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descrição</label>
            <textarea id="descricao" name="descricao" rows="4"
                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                      placeholder="Informe uma breve descrição para esta espécie. Exemplo: 'Plantas ornamentais conhecidas por suas flores coloridas e aroma marcante.'"><?= $descricao ?></textarea>
          </div>

        </div>

        <!-- Botões -->
        <div class="flex gap-4 mt-8">
          <button type="submit" 
                  class="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-medium">
            <?= isset($id) ? "Atualizar Espécie" : "Cadastrar Espécie" ?>
          </button>
          <button type="reset" 
                  class="flex-1 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 py-3 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition font-medium">
            Limpar
          </button>
          <a href="form-register-species.php"
             class="flex-1 bg-yellow-500 text-white py-3 rounded-lg hover:bg-yellow-600 transition font-medium text-center">
            Cancelar
          </a>
        </div>
      </form>

      <!-- Lista de Espécies Cadastradas -->
      <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Espécies Cadastradas</h2>
        
        <?php
        $sql = "SELECT id, nome, descricao FROM especies ORDER BY 2";
        $stmt = $conn->query($sql);

        function limitarDescricao($descricao, $limite = 200)
        {
            if (strlen($descricao) > $limite) {
                return substr($descricao, 0, $limite) . '[...]';
            }
            return $descricao;
        }
        ?>
        
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
          <table class="w-full">
            <thead class="bg-green-100 dark:bg-gray-700">
              <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-white">ID</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-white">Nome</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-white">Descrição</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900 dark:text-white">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
              <?php
              while ($row = $stmt->fetch()) {
              ?>
              <tr class="hover:bg-green-50 dark:hover:bg-gray-700 transition">
                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white"><?= $row['id'] ?></td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white"><?= $row['nome'] ?></td>
                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"><?= limitarDescricao($row['descricao'], 130) ?></td>
                <td class="px-6 py-4">
                  <div class="flex gap-2">
                    <a href="form-register-species.php?id=<?= $row['id']; ?>" 
                       class="px-3 py-1 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600 transition">
                      Editar
                    </a>
                    <a href="excluir-especie.php?id=<?= $row['id']; ?>" 
                       onclick="return confirm('Tem certeza que deseja excluir?')"
                       class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600 transition">
                      Excluir
                    </a>
                  </div>
                </td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

<?php
require '../parts/footer.php';
?>