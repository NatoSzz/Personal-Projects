<?php
session_start();
require '../config/authentication.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona("../user/form-login.php");
    die();
}

// Verificar se está visualizando perfil de outro usuário
$visualizacao_publica = false;
$usuario_visualizado = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $visualizacao_publica = true;
    $id_visualizado = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    if ($id_visualizado && $id_visualizado != id_usuario()) {
        require '../config/connection.php';
        
        try {
            $sql = "SELECT 
            u.id,
            u.nome,
            u.urlperfil,
            ue.profissao,
            ue.bio
            FROM usuarios u
            INNER JOIN usuario_esp ue ON u.id = ue.id_usuario
            WHERE id = :id";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id_visualizado, PDO::PARAM_INT);
            $stmt->execute();
            $usuario_visualizado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$usuario_visualizado) {
                $_SESSION["erro"] = "Usuário não encontrado.";
                redireciona("list-esp.php");
                die();
            }
        } catch (PDOException $e) {
            $_SESSION["erro"] = "Erro ao buscar usuário: " . $e->getMessage();
            redireciona("list-esp.php");
            die();
        }
    } else {
        $visualizacao_publica = false;
    }
}

require '../parts/header.php';
?>

<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        <?php if ($visualizacao_publica && $usuario_visualizado): ?>
            <!-- MODO VISUALIZAÇÃO PÚBLICA -->
            <div class="mb-6">
                <a href="list-esp.php" class="inline-flex items-center text-green-700 hover:text-green-800 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Voltar para Especialistas
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
                <!-- Header do Perfil -->
                <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-8">
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                        <div class="relative">
                            <img src="<?= htmlspecialchars($usuario_visualizado['urlperfil'], ENT_QUOTES) ?>" 
                                 alt="Foto de perfil" 
                                 class="w-24 h-24 bg-white rounded-full object-cover border-4 border-white shadow-lg">
                            <?php if ($usuario_visualizado['esp'] == 1): ?>
                                <div class="absolute -bottom-2 -right-2 bg-yellow-400 rounded-full p-1 shadow-lg">
                                    <svg class="w-5 h-5 text-yellow-900" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="text-center md:text-left">
                            <h1 class="text-2xl md:text-3xl font-bold text-white">
                                <?= htmlspecialchars($usuario_visualizado['nome'], ENT_QUOTES) ?>
                            </h1>
                            <p class="text-green-100 mt-1"><?= htmlspecialchars($usuario_visualizado['email'], ENT_QUOTES) ?></p>
                            
                            <?php if ($usuario_visualizado['esp'] == 1): ?>
                                <span class="inline-block mt-2 px-3 py-1 bg-yellow-400 text-yellow-900 text-sm font-semibold rounded-full shadow-sm">
                                    ⭐ Especialista
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Informações do Perfil -->
                <div class="px-6 py-8">
                    <?php if (!empty($usuario_visualizado['profissao'])): ?>
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Profissão</h3>
                            <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                                <p class="text-lg text-gray-900 font-medium"><?= htmlspecialchars($usuario_visualizado['profissao'], ENT_QUOTES) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($usuario_visualizado['bio'])): ?>
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 uppercase tracking-wide">Biografia</h3>
                            <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                                <p class="text-gray-600 leading-relaxed"><?= nl2br(htmlspecialchars($usuario_visualizado['bio'], ENT_QUOTES)) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Ações -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="chat.php?especialista_id=<?= $usuario_visualizado['id'] ?>" 
                           class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium inline-flex items-center justify-center shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Iniciar Conversa
                        </a>
                        <a href="list-esp.php" 
                           class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium text-center shadow-sm hover:shadow">
                            Voltar para Especialistas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Informação sobre visualização -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-800">
                            <strong>Modo Visualização:</strong> Você está visualizando o perfil de outro usuário. 
                            Para editar seu próprio perfil, acesse "Minha Conta" no menu.
                        </p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- MODO EDIÇÃO (SEU PRÓPRIO PERFIL) -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
                <!-- Header do Perfil -->
                <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-8">
                    <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                        <div class="relative">
                            <img src="<?= foto_usuario(); ?>" alt="Foto de perfil" class="w-24 h-24 bg-white rounded-full object-cover border-4 border-white shadow-lg">
                            <div class="absolute -bottom-2 -right-2 bg-green-500 rounded-full p-1 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-center md:text-left">
                            <h1 class="text-2xl md:text-3xl font-bold text-white"><?= nome_usuario(); ?></h1>
                            <p class="text-green-100 mt-1"><?= email_usuario(); ?></p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                <a href="change-pass.php" class="inline-flex items-center px-3 py-1 bg-white bg-opacity-20 text-white text-sm rounded-full hover:bg-opacity-30 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                    </svg>
                                    Alterar Senha
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Edição -->
                <div class="px-6 py-8">
                    <form action="update-user.php" method="POST" id="profileForm">
                        <input type="hidden" name="id" value="<?= id_usuario(); ?>">
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome completo *</label>
                                <input type="text" id="nome" name="nome" required 
                                       minlength="3" maxlength="100"
                                       value="<?= htmlspecialchars(nome_usuario(), ENT_QUOTES) ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 shadow-sm">
                                <p class="text-xs text-gray-500 mt-1">Mínimo 3, máximo 100 caracteres</p>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" disabled
                                       value="<?= htmlspecialchars(email_usuario(), ENT_QUOTES) ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed shadow-sm">
                                <p class="text-xs text-gray-500 mt-1">O email não pode ser alterado</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 mt-8">
                            <button type="submit" 
                                    class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Salvar Alterações
                            </button>
                            <button type="reset" 
                                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium shadow-sm hover:shadow">
                                Cancelar
                            </button>
                            <button type="button" 
                                    onclick="abrirModalExcluir()"
                                    class="px-6 py-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all duration-200 font-medium shadow-sm hover:shadow flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Excluir Conta
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Estatísticas do Usuário -->
            <div class="grid md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center border border-green-100 hover:shadow-xl transition-all duration-300">
                    <div class="text-3xl font-bold text-green-600">12</div>
                    <div class="text-gray-600 mt-2">Plantas no Jardim</div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center border border-green-100 hover:shadow-xl transition-all duration-300">
                    <div class="text-3xl font-bold text-green-600">5</div>
                    <div class="text-gray-600 mt-2">Espécies Diferentes</div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center border border-green-100 hover:shadow-xl transition-all duration-300">
                    <div class="text-3xl font-bold text-green-600">30</div>
                    <div class="text-gray-600 mt-2">Dias de Cuidados</div>
                </div>
            </div>

            <!-- Modal de Exclusão de Conta -->
            <div id="modalExcluir" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl transform transition-all duration-300 scale-95">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h2 class="text-2xl font-bold text-red-600">Excluir Conta</h2>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">
                        Esta ação não pode ser desfeita. Todos os seus dados serão permanentemente excluídos.
                    </p>
                    
                    <form action="delete-user.php" method="POST" id="deleteForm">
                        <input type="hidden" name="id" value="<?= id_usuario(); ?>">
                        
                        <div class="mb-4">
                            <label for="senha_confirmacao" class="block text-sm font-medium text-gray-700 mb-2">
                                Digite sua senha para confirmar *
                            </label>
                            <input type="password" 
                                   id="senha_confirmacao" 
                                   name="senha_confirmacao" 
                                   required
                                   minlength="8"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200"
                                   placeholder="Sua senha atual">
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" 
                                    class="flex-1 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg flex items-center justify-center">
                                Confirmar Exclusão
                            </button>
                            <button type="button" 
                                    onclick="fecharModalExcluir()"
                                    class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-200 font-medium shadow-sm hover:shadow">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
            function abrirModalExcluir() {
                const modal = document.getElementById('modalExcluir');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.querySelector('.transform').classList.remove('scale-95');
                    modal.querySelector('.transform').classList.add('scale-100');
                }, 10);
            }

            function fecharModalExcluir() {
                const modal = document.getElementById('modalExcluir');
                modal.querySelector('.transform').classList.remove('scale-100');
                modal.querySelector('.transform').classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.getElementById('senha_confirmacao').value = '';
                }, 200);
            }

            // Fechar modal ao clicar fora
            document.getElementById('modalExcluir').addEventListener('click', function(e) {
                if (e.target === this) {
                    fecharModalExcluir();
                }
            });

            // Validação do formulário
            document.getElementById('profileForm').addEventListener('submit', function(e) {
                const nome = document.getElementById('nome').value.trim();
                if (nome.length < 3 || nome.length > 100) {
                    e.preventDefault();
                    alert('O nome deve ter entre 3 e 100 caracteres.');
                    document.getElementById('nome').focus();
                }
            });
            </script>
        <?php endif; ?>
    </div>
</div>

<?php
if (isset($_SESSION["result"])) {
    if ($_SESSION["result"] == true) {
        ?>
        <div class="max-w-4xl mx-auto mt-6">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <h4 class="font-bold"><?= $_SESSION["msg_sucesso"] ?? 'Sucesso!' ?></h4>
                </div>
            </div>
        </div>
        <?php
        unset($_SESSION["msg_sucesso"]);
    } else {
        ?>
        <div class="max-w-4xl mx-auto mt-6">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <h4 class="font-bold"><?= $_SESSION["msg_erro"] ?? 'Erro!' ?></h4>
                </div>
                <p class="mt-1"><?= $_SESSION["erro"] ?? '' ?></p>
            </div>
        </div>
        <?php
        unset($_SESSION["msg_erro"]);
        unset($_SESSION["erro"]);
    }
    unset($_SESSION["result"]);
}

require '../parts/footer.php';
?>