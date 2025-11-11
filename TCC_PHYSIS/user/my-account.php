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

<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Cabeçalho da Página -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Minha Conta</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Gerencie suas informações pessoais, preferências e visualize suas estatísticas</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Coluna Lateral - Navegação e Informações Rápidas -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Card de Navegação -->
                <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Navegação
                    </h3>
                    <nav class="space-y-2">
                        <a href="account.php" class="flex items-center px-3 py-2 text-green-700 bg-green-50 rounded-lg font-medium">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Perfil Público
                        </a>
                        <a href="change-password.php" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            Alterar Senha
                        </a>
                        <a href="../garden/" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>
                            </svg>
                            Meu Jardim
                        </a>
                        <a href="../chat/" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Mensagens
                        </a>
                    </nav>
                </div>

                <!-- Card de Status da Conta -->
                <div class="bg-white rounded-2xl shadow-lg border border-green-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Status da Conta
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Membro desde</span>
                            <span class="text-sm font-medium text-gray-900"><?= date('d/m/Y', strtotime('-3 months')) ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Tipo de conta</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Usuário Premium
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Verificação</span>
                            <span class="inline-flex items-center text-green-600 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Verificado
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card de Ajuda Rápida -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-3">Precisa de ajuda?</h3>
                    <p class="text-green-100 text-sm mb-4">Estamos aqui para ajudar você com sua conta e plantas.</p>
                    <div class="space-y-2">
                        <a href="#" class="flex items-center text-green-50 hover:text-white text-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Central de Ajuda
                        </a>
                        <a href="#" class="flex items-center text-green-50 hover:text-white text-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Suporte Técnico
                        </a>
                    </div>
                </div>
            </div>

            <!-- Coluna Principal - Conteúdo -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Card de Perfil -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
                    <!-- Header do Perfil -->
                    <div class="relative bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-8">
                        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                            <div class="relative">
                                <img src="<?= foto_usuario(); ?>" alt="Foto de perfil" class="w-24 h-24 bg-white rounded-full object-cover border-4 border-white shadow-lg">
                                <button onclick="abrirModalFoto()" class="absolute -bottom-2 -right-2 bg-green-500 hover:bg-green-600 rounded-full p-2 shadow-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="text-center md:text-left">
                                <h1 class="text-2xl md:text-3xl font-bold text-white"><?= nome_usuario(); ?></h1>
                                <p class="text-green-100 mt-1"><?= email_usuario(); ?></p>
                                <div class="mt-3 flex flex-wrap gap-2 justify-center md:justify-start">
                                    <a href="change-password.php" class="inline-flex items-center px-3 py-1 bg-white bg-opacity-20 text-white text-sm rounded-full hover:bg-opacity-30 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                        Alterar Senha
                                    </a>
                                    <span class="inline-flex items-center px-3 py-1 bg-yellow-400 bg-opacity-20 text-yellow-300 text-sm rounded-full">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Conta Premium
                                    </span>
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
                                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Nome completo *
                                    </label>
                                    <input type="text" id="nome" name="nome" required 
                                           minlength="3" maxlength="100"
                                           value="<?= htmlspecialchars(nome_usuario(), ENT_QUOTES) ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">Mínimo 3, máximo 100 caracteres</p>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        Email
                                    </label>
                                    <input type="email" id="email" disabled
                                           value="<?= htmlspecialchars(email_usuario(), ENT_QUOTES) ?>"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">O email não pode ser alterado</p>
                                </div>
                            </div>

                            <!-- Campos Adicionais -->
                            <div class="mt-6 grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                                    <input type="tel" id="telefone" name="telefone"
                                           placeholder="(11) 99999-9999"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 shadow-sm">
                                </div>
                                
                                <div>
                                    <label for="localizacao" class="block text-sm font-medium text-gray-700 mb-2">Localização</label>
                                    <input type="text" id="localizacao" name="localizacao"
                                           placeholder="Cidade, Estado"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 shadow-sm">
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Biografia</label>
                                <textarea id="bio" name="bio" rows="4"
                                          placeholder="Conte um pouco sobre você e seu interesse por plantas..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 shadow-sm resize-none"></textarea>
                                <p class="text-xs text-gray-500 mt-1">Máximo 500 caracteres</p>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200">
                                <button type="submit" 
                                        class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg flex items-center justify-center flex-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Salvar Alterações
                                </button>
                                <button type="reset" 
                                        class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium shadow-sm hover:shadow flex-1">
                                    Descartar Alterações
                                </button>
                                <button type="button" 
                                        onclick="abrirModalExcluir()"
                                        class="px-6 py-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all duration-200 font-medium shadow-sm hover:shadow flex items-center justify-center flex-1">
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
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-green-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Minhas Estatísticas
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-green-50 rounded-xl border border-green-100 hover:shadow-md transition-all duration-300">
                            <div class="text-2xl font-bold text-green-600">12</div>
                            <div class="text-sm text-gray-600 mt-1">Plantas</div>
                        </div>
                        <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-100 hover:shadow-md transition-all duration-300">
                            <div class="text-2xl font-bold text-blue-600">5</div>
                            <div class="text-sm text-gray-600 mt-1">Espécies</div>
                        </div>
                        <div class="text-center p-4 bg-yellow-50 rounded-xl border border-yellow-100 hover:shadow-md transition-all duration-300">
                            <div class="text-2xl font-bold text-yellow-600">30</div>
                            <div class="text-sm text-gray-600 mt-1">Dias Ativos</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-xl border border-purple-100 hover:shadow-md transition-all duration-300">
                            <div class="text-2xl font-bold text-purple-600">8</div>
                            <div class="text-sm text-gray-600 mt-1">Cuidados</div>
                        </div>
                    </div>
                </div>

                <!-- Atividade Recente -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-green-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Atividade Recente
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg">
                            <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-700">Você regou a <strong>Samambaia</strong></p>
                                <p class="text-xs text-gray-500 mt-1">Há 2 horas</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-700">Nova planta adicionada: <strong>Costela-de-Adão</strong></p>
                                <p class="text-xs text-gray-500 mt-1">Ontem às 14:30</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg">
                            <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-700">Recebeu dica sobre <strong>luminosidade</strong></p>
                                <p class="text-xs text-gray-500 mt-1">2 dias atrás</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            Esta ação não pode ser desfeita. Todos os seus dados, plantas e histórico serão permanentemente excluídos.
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

<!-- Modal de Alteração de Foto -->
<div id="modalFoto" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl transform transition-all duration-300 scale-95">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Alterar Foto de Perfil</h2>
        <form action="update-photo.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= id_usuario(); ?>">
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Escolha uma nova foto</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="foto_perfil" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none">
                                <span>Enviar arquivo</span>
                                <input id="foto_perfil" name="foto_perfil" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">ou arraste e solte</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF até 10MB</p>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 font-medium">
                    Atualizar Foto
                </button>
                <button type="button" 
                        onclick="fecharModalFoto()"
                        class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-200 font-medium">
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

function abrirModalFoto() {
    const modal = document.getElementById('modalFoto');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
    }, 10);
}

function fecharModalFoto() {
    const modal = document.getElementById('modalFoto');
    modal.querySelector('.transform').classList.remove('scale-100');
    modal.querySelector('.transform').classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 200);
}

// Fechar modais ao clicar fora
document.getElementById('modalExcluir').addEventListener('click', function(e) {
    if (e.target === this) {
        fecharModalExcluir();
    }
});

document.getElementById('modalFoto').addEventListener('click', function(e) {
    if (e.target === this) {
        fecharModalFoto();
    }
});

// Validação do formulário
document.getElementById('profileForm').addEventListener('submit', function(e) {
    const nome = document.getElementById('nome').value.trim();
    const bio = document.getElementById('bio').value.trim();
    
    if (nome.length < 3 || nome.length > 100) {
        e.preventDefault();
        alert('O nome deve ter entre 3 e 100 caracteres.');
        document.getElementById('nome').focus();
        return;
    }
    
    if (bio.length > 500) {
        e.preventDefault();
        alert('A biografia deve ter no máximo 500 caracteres.');
        document.getElementById('bio').focus();
        return;
    }
});

// Preview de imagem ao selecionar arquivo
document.getElementById('foto_perfil').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Aqui você pode adicionar um preview da imagem se desejar
            console.log('Imagem selecionada:', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php
if (isset($_SESSION["result"])) {
    if ($_SESSION["result"] == true) {
        ?>
        <div class="fixed top-4 right-4 z-50 max-w-sm w-full">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg">
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
        <div class="fixed top-4 right-4 z-50 max-w-sm w-full">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <h4 class="font-bold"><?= $_SESSION["msg_erro"] ?? 'Erro!' ?></h4>
                </div>
                <p class="mt-1 text-sm"><?= $_SESSION["erro"] ?? '' ?></p>
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