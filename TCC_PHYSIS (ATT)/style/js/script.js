// User Dropdown Menu
function initializeUserDropdown() {
    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdown = document.getElementById('userDropdown');
    
    console.log('Initializing user dropdown:', { userMenuButton, userDropdown });
    
    if (!userMenuButton || !userDropdown) {
        console.log('User dropdown elements not found');
        return;
    }

    userMenuButton.addEventListener('click', function(e) {
        e.stopPropagation();
        console.log('Dropdown button clicked');
        userDropdown.classList.toggle('show');
    });

    document.addEventListener('click', function() {
        console.log('Document clicked, closing dropdown');
        userDropdown.classList.remove('show');
    });

    userDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
}

// Mobile Menu Functionality
function initializeMobileMenu() {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpen = document.getElementById('menu-open');
    const menuClose = document.getElementById('menu-close');

    if (!menuToggle || !mobileMenu) return;

    menuToggle.addEventListener('click', () => {
        const isHidden = mobileMenu.classList.contains('hidden');

        if (isHidden) {
            mobileMenu.classList.remove('hidden');
            if (menuOpen) menuOpen.classList.add('hidden');
            if (menuClose) menuClose.classList.remove('hidden');
        } else {
            mobileMenu.classList.add('hidden');
            if (menuOpen) menuOpen.classList.remove('hidden');
            if (menuClose) menuClose.classList.add('hidden');
        }
    });

    // Fechar menu ao clicar em um link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            if (menuOpen) menuOpen.classList.remove('hidden');
            if (menuClose) menuClose.classList.add('hidden');
        });
    });
}

// FAQ Accordion Functionality - CORRIGIDO
function initializeFAQs() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    console.log('Found FAQ questions:', faqQuestions.length);
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const icon = this.querySelector('.faq-icon');
            
            console.log('FAQ clicked, current state:', answer.classList.contains('open'));
            
            // Fechar outras respostas
            faqQuestions.forEach(otherQuestion => {
                if (otherQuestion !== this) {
                    const otherAnswer = otherQuestion.nextElementSibling;
                    const otherIcon = otherQuestion.querySelector('.faq-icon');
                    otherAnswer.classList.remove('open');
                    if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                }
            });
            
            // Alternar resposta atual
            answer.classList.toggle('open');
            if (icon) {
                icon.style.transform = answer.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        });
    });

    // FAQ Category Filter
    const categoryButtons = document.querySelectorAll('.category-btn');
    const faqCategories = document.querySelectorAll('.faq-category');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            
            // Update active buttons
            categoryButtons.forEach(btn => {
                if (btn.getAttribute('data-category') === category) {
                    btn.classList.add('bg-green-600', 'text-white');
                    btn.classList.remove('bg-green-100', 'dark:bg-gray-700', 'text-green-800', 'dark:text-green-300');
                } else {
                    btn.classList.remove('bg-green-600', 'text-white');
                    btn.classList.add('bg-green-100', 'dark:bg-gray-700', 'text-green-800', 'dark:text-green-300');
                }
            });
            
            // Show/hide categories
            faqCategories.forEach(cat => {
                if (category === 'all' || cat.getAttribute('data-category') === category) {
                    cat.style.display = 'block';
                } else {
                    cat.style.display = 'none';
                }
            });
        });
    });

    // FAQ Search
    const searchInput = document.getElementById('searchFAQs');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    // Ensure the category is visible
                    const category = item.closest('.faq-category');
                    if (category) category.style.display = 'block';
                    
                    // Open answer if it contains the term
                    if (answer.includes(searchTerm) && !item.querySelector('.faq-answer').classList.contains('open')) {
                        item.querySelector('.faq-question').click();
                    }
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
}


function updatePreview() {
    const nome = document.getElementById('nome').value;
    const descricao = document.getElementById('descricao').value;
    const cuidados = document.getElementById('cuidados').value;
    const urlfoto = document.getElementById('urlfoto').value;
    const previewImage = document.getElementById('previewImage');
    const noPreview = document.getElementById('noPreview');
    
    document.getElementById('previewNome').textContent = nome || 'Nome da Planta';
    document.getElementById('previewDescricao').textContent = descricao || 'Descrição aparecerá aqui...';
    document.getElementById('previewCuidados').textContent = cuidados || 'Instruções de cultivo aparecerão aqui...';
    
    if (urlfoto) {
        previewImage.src = urlfoto;
        previewImage.classList.remove('hidden');
        noPreview.classList.add('hidden');
    } else {
        previewImage.classList.add('hidden');
        noPreview.classList.remove('hidden');
    }
}

function clearPreview() {
    document.getElementById('previewNome').textContent = 'Nome da Planta';
    document.getElementById('previewDescricao').textContent = 'Descrição aparecerá aqui...';
    document.getElementById('previewCuidados').textContent = 'Instruções de cultivo aparecerão aqui...';
    document.getElementById('previewImage').classList.add('hidden');
    document.getElementById('noPreview').classList.remove('hidden');
}


// Garden Filter Functionality
function initializeGardenFilters() {
    const filterButtons = document.querySelectorAll('.flex-wrap button');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-green-600', 'text-white');
                btn.classList.add('bg-green-100', 'dark:bg-gray-700', 'text-green-800', 'dark:text-green-300');
            });
            
            // Add active class to clicked button
            this.classList.remove('bg-green-100', 'dark:bg-gray-700', 'text-green-800', 'dark:text-green-300');
            this.classList.add('bg-green-600', 'text-white');
        });
    });
}

// Auto-remove messages
function initializeAutoRemoveMessages() {
    const errorMessages = document.querySelector('.bg-red-100');
    if (errorMessages) {
        setTimeout(() => {
            errorMessages.style.opacity = '0';
            errorMessages.style.transition = 'opacity 0.5s ease';
            setTimeout(() => errorMessages.remove(), 500);
        }, 5000);
    }
}

// Utility Functions
function changeOrder(ordem) {
    const url = new URL(window.location.href);
    url.searchParams.set('ordem', ordem);
    window.location.href = url.toString();
}

function clearFilters() {
    // Limpar checkboxes
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false;
    });
    
    // Limpar inputs de texto
    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.value = '';
    });
    
    window.location.href = 'cards-plants.php';
}

function confirmDelete() {
    return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');
}

// CORREÇÃO: Inicialização principal corrigida
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing scripts...');
    
    initializeUserDropdown();
    initializeMobileMenu();
    initializeFAQs();
    initializeGardenFilters();
    initializeAutoRemoveMessages();
    
    console.log('All scripts initialized');
});

// Make functions globally available
window.changeOrder = changeOrder;
window.clearFilters = clearFilters;
window.confirmDelete = confirmDelete;
