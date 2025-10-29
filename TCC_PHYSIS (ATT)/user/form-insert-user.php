<?php
session_start();
require '../config/authentication.php';
require '../parts/header.php';
?>

<script>
    function verifica_senhas() {
        var senha = document.getElementById("senha");
        var confsenha = document.getElementById("confsenha");

        if (senha.value && confsenha.value) {
            if (senha.value != confsenha.value) {
                senha.classList.add("border-red-500");
                confsenha.classList.add("border-red-500");
                document.getElementById("senha-error").classList.remove("hidden");
                confsenha.value = "";
            } else {
                senha.classList.remove("border-red-500");
                confsenha.classList.remove("border-red-500");
                document.getElementById("senha-error").classList.add("hidden");
            }
        }
    }
    
    // Validação de força da senha em tempo real
    function validar_forca_senha() {
        var senha = document.getElementById("senha").value;
        var feedback = document.getElementById("senha-feedback");
        var requisitos = {
            maiuscula: /[A-Z]/.test(senha),
            minuscula: /[a-z]/.test(senha),
            numero: /[0-9]/.test(senha),
            tamanho: senha.length >= 8
        };
        
        var html = '<ul class="text-xs space-y-1 mt-2">';
        html += '<li class="' + (requisitos.tamanho ? 'text-green-600' : 'text-red-600') + '">✓ Mínimo 8 caracteres</li>';
        html += '<li class="' + (requisitos.maiuscula ? 'text-green-600' : 'text-red-600') + '">✓ Uma letra maiúscula</li>';
        html += '<li class="' + (requisitos.minuscula ? 'text-green-600' : 'text-red-600') + '">✓ Uma letra minúscula</li>';
        html += '<li class="' + (requisitos.numero ? 'text-green-600' : 'text-red-600') + '">✓ Um número</li>';
        html += '</ul>';
        
        feedback.innerHTML = html;
    }
</script>

<div class="min-h-screen flex items-center justify-center bg-green-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <img src="../img/logo.png" alt="Logo" class="w-16 h-16">
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Crie sua conta
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="insert-user.php" method="POST">
            <div class="space-y-4">
                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome completo *</label>
                    <input id="nome" name="nome" type="text" required 
                           minlength="3" maxlength="100"
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                           placeholder="Seu nome completo"
                           value="<?= htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES) ?>">
                    <p class="text-xs text-gray-500 mt-1">Mínimo 3, máximo 100 caracteres</p>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                    <input id="email" name="email" type="email" required 
                           maxlength="255"
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                           placeholder="seu@email.com"
                           value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES) ?>">
                </div>
                
                <div>
                    <label for="urlperfil" class="block text-sm font-medium text-gray-700">Foto de Perfil (URL) *</label>
                    <input id="urlperfil" name="urlperfil" type="url" required 
                           maxlength="500"
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                           placeholder="https://exemplo.com/foto.jpg"
                           value="<?= htmlspecialchars($_POST['urlperfil'] ?? '', ENT_QUOTES) ?>">
                    <p class="text-xs text-gray-500 mt-1">URL completa da imagem (ex: https://...)</p>
                </div>
                
                <div>
                    <label for="senha" class="block text-sm font-medium text-gray-700">Senha *</label>
                    <input id="senha" name="senha" type="password" required 
                           minlength="8" maxlength="72"
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"  
                           placeholder="Sua senha"
                           oninput="validar_forca_senha()">
                    <div id="senha-feedback"></div>
                </div>
                
                <div>
                    <label for="confsenha" class="block text-sm font-medium text-gray-700">Confirmar senha *</label>
                    <input id="confsenha" name="confsenha" type="password" required 
                           minlength="8" maxlength="72"
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" 
                           placeholder="Confirme sua senha" 
                           onblur="verifica_senhas();">
                    <div id="senha-error" class="hidden text-red-600 text-sm mt-1">
                        As senhas não coincidem.
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    Cadastrar
                </button>
            </div>

            <div class="text-center">
                <a href="form-login.php" class="font-medium text-green-600 hover:text-green-500 transition">
                    Já tem uma conta? Faça login
                </a>
            </div>
        </form>

        <?php
        if (isset($_SESSION["result"])) {
            if ($_SESSION["result"] == false) {
        ?>
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <h4 class="font-bold"><?= $_SESSION["msg_erro"] ?? 'Erro no cadastro' ?></h4>
                    <p><?= $_SESSION["erro"] ?? '' ?></p>
                </div>
        <?php
                unset($_SESSION["msg_erro"]);
                unset($_SESSION["erro"]);
            }
            unset($_SESSION["result"]);
        }
        ?>
    </div>
</div>

<?php require '../parts/footer.php'; ?>