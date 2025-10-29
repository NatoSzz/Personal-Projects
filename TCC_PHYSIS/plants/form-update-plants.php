<?php
session_start();
require '../config/authentication.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

require '../parts/header.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    ?>
    <div class="max-w-4xl mx-auto mt-8">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <h4 class="font-bold">Falha ao abrir formulário para edição</h4>
            <p>ID da planta está vazio</p>
        </div>
    </div>
    <?php
    exit;
}

require '../config/connection.php';

$sql = "SELECT nome, urlfoto, descricao, altura, uso, solo, locali, plantio, rega, adubacao, poda, dificuldade, id_especie FROM plantas WHERE id = ?";

$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);

$rowPlanta = $stmt->fetch();

$sqlEsp = "SELECT id, nome FROM especies ORDER BY 2";
$stmtEsp = $conn->query($sqlEsp);
?>

<div class="min-h-screen bg-green-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-green-700 mb-8 text-center">Editar Planta</h1>

            <form action="update-plants.php" method="POST">
                <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Coluna 1 - Formulário -->
                    <div class="space-y-6">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome da Planta *</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                   id="nome" name="nome" required value="<?= $rowPlanta['nome']; ?>">
                        </div>

                        <div>
                            <label for="especie" class="block text-sm font-medium text-gray-700 mb-2">Espécie *</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                    name="especie" id="especie" required>
                                <option value="">Selecione a espécie da planta</option>
                                <?php
                                while ($rowEsp = $stmtEsp->fetch()) {
                                    $selected = $rowEsp["id"] == $rowPlanta['id_especie'] ? "selected" : "";
                                    ?>
                                    <option <?= $selected; ?> value="<?= $rowEsp["id"]; ?>"><?= $rowEsp["nome"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="altura" class="block text-sm font-medium text-gray-700 mb-2">Altura</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                   id="altura" name="altura" value="<?= $rowPlanta['altura']; ?>" 
                                   placeholder="Ex: 0.5m a 1.2m">
                        </div>

                        <div>
                            <label for="uso" class="block text-sm font-medium text-gray-700 mb-2">Uso</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="uso" name="uso" rows="3" 
                                      placeholder="Descreva os usos da planta..."><?= $rowPlanta['uso']; ?></textarea>
                        </div>

                        <div>
                            <label for="solo" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Solo</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="solo" name="solo" rows="3" 
                                      placeholder="Descreva o tipo de solo ideal..."><?= $rowPlanta['solo']; ?></textarea>
                        </div>

                        <div>
                            <label for="locali" class="block text-sm font-medium text-gray-700 mb-2">Localização Ideal</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="locali" name="locali" rows="3" 
                                      placeholder="Descreva a localização ideal..."><?= $rowPlanta['locali']; ?></textarea>
                        </div>

                        <div>
                            <label for="dificuldade" class="block text-sm font-medium text-gray-700 mb-2">Dificuldade de Cultivo</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                    name="dificuldade" id="dificuldade">
                                <option value="">Selecione a dificuldade</option>
                                <option value="Fácil" <?= $rowPlanta['dificuldade'] == 'Fácil' ? 'selected' : '' ?>>Fácil</option>
                                <option value="Médio" <?= $rowPlanta['dificuldade'] == 'Médio' ? 'selected' : '' ?>>Médio</option>
                                <option value="Difícil" <?= $rowPlanta['dificuldade'] == 'Difícil' ? 'selected' : '' ?>>Difícil</option>
                            </select>
                        </div>
                    </div>

                    <!-- Coluna 2 - Imagem e informações adicionais -->
                    <div class="space-y-6">
                        <div>
                            <label for="urlfoto" class="block text-sm font-medium text-gray-700 mb-2">URL da Foto *</label>
                            <input type="url" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                   id="urlfoto" name="urlfoto" value="<?= $rowPlanta['urlfoto']; ?>" required>
                            <p class="text-sm text-gray-500 mt-1">Endereço http de uma imagem da internet</p>
                        </div>

                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">Descrição Detalhada</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="descricao" name="descricao" rows="4" 
                                      placeholder="Descreva as características da planta..."><?= $rowPlanta['descricao']; ?></textarea>
                        </div>

                        <div>
                            <label for="plantio" class="block text-sm font-medium text-gray-700 mb-2">Forma de Plantio</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="plantio" name="plantio" rows="3" 
                                      placeholder="Descreva como realizar o plantio..."><?= $rowPlanta['plantio']; ?></textarea>
                        </div>

                        <div>
                            <label for="rega" class="block text-sm font-medium text-gray-700 mb-2">Rega</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="rega" name="rega" rows="3" 
                                      placeholder="Descreva a frequência e forma de rega..."><?= $rowPlanta['rega']; ?></textarea>
                        </div>

                        <div>
                            <label for="adubacao" class="block text-sm font-medium text-gray-700 mb-2">Adubação</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="adubacao" name="adubacao" rows="3" 
                                      placeholder="Descreva a adubação recomendada..."><?= $rowPlanta['adubacao']; ?></textarea>
                        </div>

                        <div>
                            <label for="poda" class="block text-sm font-medium text-gray-700 mb-2">Poda</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="poda" name="poda" rows="3" 
                                      placeholder="Descreva como e quando podar..."><?= $rowPlanta['poda']; ?></textarea>
                        </div>

                        <!--<div>
                            <label for="cuidados" class="block text-sm font-medium text-gray-700 mb-2">Cuidados *</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition" 
                                      id="cuidados" name="cuidados" required rows="4" 
                                      placeholder="Descreva os cuidados necessários para a planta..."><?= $rowPlanta['cuidados']; ?></textarea>
                        </div>-->

                        <!-- Preview da Imagem -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Preview da Imagem</h3>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                <img class="max-w-full max-h-48 mx-auto rounded-lg" 
                                     src="<?= $rowPlanta['urlfoto']; ?>" 
                                     alt="<?= $rowPlanta['nome']; ?>" 
                                     id="img-preview">
                                <p id="preview-text" class="text-gray-500 text-sm mt-2">A imagem aparecerá aqui</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Salvar Alterações
                    </button>
                    <button type="reset" 
                            class="px-8 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Limpar
                    </button>
                    <a href="minhas-plantas.php" 
                       class="px-8 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Preview da imagem
document.getElementById('urlfoto').addEventListener('input', function() {
    const imgPreview = document.getElementById('img-preview');
    const previewText = document.getElementById('preview-text');
    
    if (this.value) {
        imgPreview.src = this.value;
        imgPreview.style.display = 'block';
        previewText.style.display = 'none';
    } else {
        imgPreview.style.display = 'none';
        previewText.style.display = 'block';
    }
});
</script>

<?php
require '../parts/footer.php';
?>