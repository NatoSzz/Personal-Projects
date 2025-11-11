<?php
session_start();
require '../config/authentication.php';

require '../parts/header.php';
?>

<div class="min-h-screen flex items-center justify-center bg-green-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <img src="../img/logo.png" alt="Logo" class="w-16 h-16">
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Entre na sua conta
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="login.php" method="POST">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                           placeholder="Email">
                </div>
                <div>
                    <label for="senha" class="sr-only">Senha</label>
                    <input id="senha" name="senha" type="password" autocomplete="current-password" required 
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                           placeholder="Senha">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    Entrar
                </button>
            </div>

            <div class="text-center">
                <a href="form-insert-user.php" class="font-medium text-green-600 hover:text-green-500 transition">
                    Não tem uma conta? Cadastre-se
                </a>
            </div>
        </form>

        <?php
        if (isset($_SESSION["result"])) {
            if ($_SESSION["result"] == false) {
                ?>
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <h4 class="font-bold"><?= $_SESSION["msg_erro"] ?? 'Erro no login' ?></h4>
                    <p><?= $_SESSION["erro"] ?? '' ?></p>
                </div>
                <?php
                unset($_SESSION["msg_erro"]);
                unset($_SESSION["erro"]);
                unset($_SESSION["result"]);
            }
        }
        ?>
    </div>
</div>

<?php require '../parts/footer.php'; ?>