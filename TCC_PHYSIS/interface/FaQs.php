<?php
session_start();
require '../config/authentication.php';

require '../parts/header.php';
?>

  <!-- Hero Section FAQs -->
  <section class="py-16 bg-green-50 dark:bg-gray-800 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">Perguntas Frequentes</h1>
      <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">Encontre respostas para as dúvidas mais comuns sobre o Projeto Physis</p>
      
      <!-- Barra de Pesquisa -->
      <div class="max-w-2xl mx-auto">
        <div class="relative">
          <input type="text" id="searchFAQs" placeholder="Buscar nas perguntas..."
                 class="w-full px-6 py-4 rounded-2xl border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-lg">
          <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- Seção de FAQs -->
  <section class="py-16 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-4xl mx-auto px-6">
      
      <!-- Categorias -->
      <div class="flex flex-wrap gap-4 mb-12 justify-center">
        <button class="category-btn px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition font-medium" data-category="all">
          Todas as Perguntas
        </button>
        <button class="category-btn px-6 py-3 bg-green-100 dark:bg-gray-700 text-green-800 dark:text-green-300 rounded-full hover:bg-green-200 dark:hover:bg-gray-600 transition font-medium" data-category="conta">
          Conta e Cadastro
        </button>
        <button class="category-btn px-6 py-3 bg-green-100 dark:bg-gray-700 text-green-800 dark:text-green-300 rounded-full hover:bg-green-200 dark:hover:bg-gray-600 transition font-medium" data-category="plantas">
          Plantas e Cultivo
        </button>
        <button class="category-btn px-6 py-3 bg-green-100 dark:bg-gray-700 text-green-800 dark:text-green-300 rounded-full hover:bg-green-200 dark:hover:bg-gray-600 transition font-medium" data-category="jardim">
          Meu Jardim
        </button>
      </div>

      <!-- Lista de FAQs -->
      <div class="space-y-4">
        
        <!-- Categoria: Conta e Cadastro -->
        <div class="faq-category" data-category="conta">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">📋 Conta e Cadastro</h2>
          
          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Como criar uma conta no Projeto Physis?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Para criar uma conta, clique no botão "Cadastro" no canto superior direito do site. 
                Preencha o formulário com seu nome completo, email e senha. Após o cadastro, você 
                receberá um email de confirmação. Basta clicar no link do email para ativar sua conta.
              </p>
            </div>
          </div>

          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Esqueci minha senha, o que fazer?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Na página de login, clique em "Esqueci minha senha". Digite o email cadastrado e 
                enviaremos um link para redefinir sua senha. O link é válido por 24 horas.
              </p>
            </div>
          </div>

          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Posso alterar meu email cadastrado?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Por questões de segurança, o email principal não pode ser alterado. Se precisar 
                atualizar seu email, entre em contato com nosso suporte através do email 
                <strong>suporte@physis.com</strong>.
              </p>
            </div>
          </div>
        </div>

        <!-- Categoria: Plantas e Cultivo -->
        <div class="faq-category" data-category="plantas">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 mt-12">🌱 Plantas e Cultivo</h2>
          
          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Como adicionar plantas ao meu jardim?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Após fazer login, vá até a página "Plantas" e clique no botão "Adicionar ao meu jardim" 
                na planta desejada. Você também pode cadastrar plantas personalizadas através do 
                formulário "Cadastrar Plantas".
              </p>
            </div>
          </div>

          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Onde encontro informações sobre cuidados com as plantas?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Cada planta em nosso catálogo possui uma página detalhada com informações completas 
                sobre cultivo, rega, adubação, poda e cuidados específicos. Basta clicar em "Ver detalhes" 
                na planta desejada.
              </p>
            </div>
          </div>

          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Posso sugerir novas plantas para o catálogo?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Sim! Adoramos sugestões da comunidade. Envie suas sugestões para 
                <strong>sugestoes@physis.com</strong> com o nome da planta e informações básicas. 
                Nossa equipe analisará e poderá incluí-la no catálogo.
              </p>
            </div>
          </div>
        </div>

        <!-- Categoria: Meu Jardim -->
        <div class="faq-category" data-category="jardim">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 mt-12">🏡 Meu Jardim</h2>
          
          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Quantos jardins posso criar?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Você pode criar até 5 jardins diferentes. Isso permite organizar suas plantas por 
                ambientes (sala, quarto, varanda) ou por tipos (suculentas, ervas, flores).
              </p>
            </div>
          </div>

          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Como recebo lembretes de cuidados?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Configure os lembretes nas configurações de cada planta no seu jardim. Você pode 
                receber notificações por email ou no aplicativo sobre rega, adubação e outros 
                cuidados necessários.
              </p>
            </div>
          </div>

          <div class="faq-item bg-green-50 dark:bg-gray-800 rounded-2xl p-6">
            <button class="faq-question w-full flex justify-between items-center text-left">
              <span class="text-lg font-semibold text-gray-900 dark:text-white">Posso compartilhar meu jardim com amigos?</span>
              <svg class="faq-icon w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="faq-answer mt-4">
              <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Sim! Na página do seu jardim, clique em "Compartilhar" e escolha entre gerar um 
                link público ou convidar amigos específicos por email. Eles poderão ver suas 
                plantas mas não editar informações.
              </p>
            </div>
          </div>
        </div>

      </div>

      <!-- Ainda com dúvidas? -->
      <div class="mt-16 bg-green-600 rounded-2xl p-8 text-center text-white">
        <h2 class="text-2xl font-bold mb-4">Ainda com dúvidas?</h2>
        <p class="text-green-100 mb-6">Nossa equipe de suporte está pronta para ajudar você!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="mailto:suporte@physis.com" class="px-6 py-3 bg-white text-green-600 rounded-full hover:bg-green-50 transition font-medium">
            📧 Enviar Email
          </a>
          <?php if (autenticado()): ?>
            <a href="../user/list-esp.php" class="px-6 py-3 bg-green-700 text-white rounded-full hover:bg-green-800 transition font-medium">
              💬 Chat com Especialista
            </a>
          <?php else: ?>
            <a href="../user/form-login.php" class="px-6 py-3 bg-green-700 text-white rounded-full hover:bg-green-800 transition font-medium">
              💬 Fazer Login para Chat
            </a>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </section>

  <script>
  // Sistema de busca nas FAQs
  document.getElementById('searchFAQs').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const faqItems = document.querySelectorAll('.faq-item');
      
      faqItems.forEach(item => {
          const question = item.querySelector('.faq-question span').textContent.toLowerCase();
          const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
          
          if (question.includes(searchTerm) || answer.includes(searchTerm)) {
              item.style.display = '';
          } else {
              item.style.display = 'none';
          }
      });
  });

  // Sistema de filtro por categoria
  document.querySelectorAll('.category-btn').forEach(btn => {
      btn.addEventListener('click', function() {
          const category = this.dataset.category;
          
          // Atualizar botões ativos
          document.querySelectorAll('.category-btn').forEach(b => {
              b.classList.remove('bg-green-600', 'text-white');
              b.classList.add('bg-green-100', 'dark:bg-gray-700', 'text-green-800', 'dark:text-green-300');
          });
          this.classList.remove('bg-green-100', 'dark:bg-gray-700', 'text-green-800', 'dark:text-green-300');
          this.classList.add('bg-green-600', 'text-white');
          
          // Filtrar categorias
          const categories = document.querySelectorAll('.faq-category');
          categories.forEach(cat => {
              if (category === 'all' || cat.dataset.category === category) {
                  cat.style.display = '';
              } else {
                  cat.style.display = 'none';
              }
          });
      });
  });

  // Sistema de accordion
  document.querySelectorAll('.faq-question').forEach(question => {
      question.addEventListener('click', function() {
          const answer = this.nextElementSibling;
          const icon = this.querySelector('.faq-icon');
          const isOpen = answer.style.display === 'block';
          
          // Fechar todas as outras respostas
          document.querySelectorAll('.faq-answer').forEach(a => {
              a.style.display = 'none';
          });
          document.querySelectorAll('.faq-icon').forEach(i => {
              i.style.transform = 'rotate(0deg)';
          });
          
          // Abrir/fechar a resposta clicada
          if (!isOpen) {
              answer.style.display = 'block';
              icon.style.transform = 'rotate(180deg)';
          }
      });
  });

  // Inicializar com todas as respostas fechadas
  document.querySelectorAll('.faq-answer').forEach(answer => {
      answer.style.display = 'none';
  });
  </script>

<?php
require '../parts/footer.php';
?>