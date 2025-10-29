<?php
session_start();
require '../config/authentication.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona("../user/form-login.php");
    die();
}

require '../parts/header.php';
?>

<div class="min-h-screen bg-green-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header do Perfil -->
            <div class="bg-green-600 px-6 py-8">
                <div class="flex items-center space-x-6">
                    <!--<div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                    </div>-->
                    <img src="<?= foto_usuario(); ?>" alt="" class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                    <div>
                        <h1 class="text-2xl font-bold text-white"><?= nome_usuario(); ?></h1>
                        <p class="text-green-100"><?= email_usuario(); ?></p>
                    </div>
                </div>
            </div>

            <!-- Formulário de Edição -->
            <div class="px-6 py-8">
                <form action="update-user.php" method="POST">
                    <input type="hidden" name="id" value="<?= id_usuario(); ?>">
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome completo</label>
                            <input type="text" id="nome" name="nome" required 
                                   value="<?= nome_usuario(); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" disabled
                                   value="<?= email_usuario(); ?>"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                        </div>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <button type="submit" 
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                            Salvar Alterações
                        </button>
                        <button type="reset" 
                                class="px-6 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition font-medium">
                            Cancelar
                        </button>
                        <a href="delete-user.php?id=<?= id_usuario(); ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')"
                           class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                            Excluir Conta
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Estatísticas do Usuário -->
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-600">12</div>
                <div class="text-gray-600">Plantas no Jardim</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-600">5</div>
                <div class="text-gray-600">Espécies Diferentes</div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-600">30</div>
                <div class="text-gray-600">Dias de Cuidados</div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_SESSION["result"])) {
    if ($_SESSION["result"] == true) {
        ?>
        <div class="max-w-3xl mx-auto mt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <h4 class="font-bold"><?= $_SESSION["msg_sucesso"] ?? 'Sucesso!' ?></h4>
            </div>
        </div>
        <?php
        unset($_SESSION["msg_sucesso"]);
    } else {
        ?>
        <div class="max-w-3xl mx-auto mt-6">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <h4 class="font-bold"><?= $_SESSION["msg_erro"] ?? 'Erro!' ?></h4>
                <p><?= $_SESSION["erro"] ?? '' ?></p>
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