import './bootstrap';
import Alpine from 'alpinejs';

// Configuration globale Alpine
window.Alpine = Alpine;
Alpine.start();

// Fonction de changement d'onglet rendue globale pour être accessible depuis les attributs onclick
window.switchTab = function(tabName) {
    // Cacher tous les contenus d'onglets
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Désactiver tous les onglets
    document.querySelectorAll('[id^="tab-"]').forEach(tab => {
        tab.classList.remove('border-purple', 'text-purple');
        tab.classList.add('border-transparent', 'text-gray-dark');
    });

    // Activer l'onglet sélectionné
    const selectedTab = document.getElementById('tab-' + tabName);
    if (selectedTab) {
        selectedTab.classList.add('border-purple', 'text-purple');
        selectedTab.classList.remove('border-transparent', 'text-gray-dark');
    }

    // Afficher le contenu correspondant
    const selectedContent = document.getElementById('content-' + tabName);
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
    }
};

// Fonction pour gérer le menu mobile
function initMobileMenu() {
    // Sélection des éléments du menu mobile
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileOverlay = document.getElementById('mobile-overlay');
    const mobileContent = document.getElementById('mobile-content');
    const mobileLinks = document.querySelectorAll('.mobile-link');
    
    // Si les éléments n'existent pas, on sort de la fonction
    if (!menuToggle || !mobileMenu) return;
    
    // Fonction pour ouvrir le menu
    function openMenu() {
      mobileMenu.classList.remove('hidden');
      // Petit délai pour permettre la transition
      setTimeout(() => {
        mobileContent.classList.remove('translate-x-full');
      }, 10);
      document.body.classList.add('overflow-hidden'); // Empêcher le défilement
    }
    
    // Fonction pour fermer le menu
    function closeMenuFunc() {
      mobileContent.classList.add('translate-x-full');
      // Attendre la fin de l'animation avant de cacher complètement
      setTimeout(() => {
        mobileMenu.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }, 300);
    }
    
    // Écouteurs d'événements
    menuToggle.addEventListener('click', openMenu);
    closeMenu.addEventListener('click', closeMenuFunc);
    mobileOverlay.addEventListener('click', closeMenuFunc);
    
    // Fermer le menu au clic sur un lien
    mobileLinks.forEach(link => {
      link.addEventListener('click', function() {
        closeMenuFunc();
      });
    });
  }

// Fonction unique d'initialisation principale
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation d'AOS pour les animations
    AOS.init({
        once: true,
        duration: 800,
        offset: 50
    });

    initMobileMenu();


    const filterButtons = document.querySelectorAll('.service-filter');
    const serviceCards = document.querySelectorAll('[data-category]');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-purple', 'text-white', 'border-purple');
                btn.classList.add('bg-white', 'text-dark', 'border-purple/20');
            });
            
            this.classList.add('bg-purple', 'text-white', 'border-purple');
            this.classList.remove('bg-white', 'text-dark', 'border-purple/20');
            
            const category = this.getAttribute('data-category');
            
            serviceCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = '';
                    card.classList.add('animate-fadeIn');
                    setTimeout(() => {
                        card.classList.remove('animate-fadeIn');
                    }, 500);
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Initialisation de Lenis pour le défilement fluide
    if (typeof Lenis !== 'undefined') {
        window.lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            smooth: true
        });

        function raf(time) {
            window.lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);
    }

    // Initialisation des fonctionnalités
    initCounters();
    initScrollHandlers();
    initBackToTopButton();
    initModalHandlers();

    // Activer l'onglet "medical" par défaut pour les services
    if (document.getElementById('tab-medical')) {
        window.switchTab('medical');
    }

    // Initialiser les carrousels et graphiques avec un délai pour assurer le chargement correct
    setTimeout(() => {
        initCarousels();
        initCharts();
    }, 500);


        // Gestion des filtres de catégories
        const filters = document.querySelectorAll('.service-filter');
        const services = document.querySelectorAll('[data-category]');

        filters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();

                // Reset all filters
                filters.forEach(f => {
                    f.classList.remove('bg-purple', 'text-white', 'border-purple');
                    f.classList.add('bg-white', 'text-dark', 'border-purple/20');
                });

                // Activate current filter
                this.classList.remove('bg-white', 'text-dark', 'border-purple/20');
                this.classList.add('bg-purple', 'text-white', 'border-purple');

                const category = this.getAttribute('href').substring(1);

                // Show/hide services
                services.forEach(service => {
                    if (category === 'all' || service.dataset.category === category) {
                        service.style.display = '';
                        // Animation
                        service.classList.add('animate-fadeIn');
                        setTimeout(() => {
                            service.classList.remove('animate-fadeIn');
                        }, 500);
                    } else {
                        service.style.display = 'none';
                    }
                });
            });
        });

        // Gestion des boutons de défilement
        const scrollLeftBtn = document.getElementById('scroll-left');
        const scrollRightBtn = document.getElementById('scroll-right');
        const filterContainer = document.querySelector('.service-filter-container');

        if (scrollLeftBtn && scrollRightBtn && filterContainer) {
            scrollLeftBtn.addEventListener('click', () => {
                filterContainer.scrollBy({ left: -200, behavior: 'smooth' });
            });

            scrollRightBtn.addEventListener('click', () => {
                filterContainer.scrollBy({ left: 200, behavior: 'smooth' });
            });
        }
});

// Compteurs animés
function initCounters() {
    // Définir l'état des compteurs
    const timerState = {
        value1: { timer: null, seconds: 0 },
        value2: { timer: null, seconds: 0 },
        value3: { timer: null, seconds: 0 }
    };

    // Fonction pour démarrer les compteurs
    function startTimer(target, id, interval) {
        const element = document.getElementById(id);
        if (!element) return;

        if (timerState[id]?.timer) {
            clearInterval(timerState[id].timer);
        }

        timerState[id].seconds = 0;
        timerState[id].timer = setInterval(() => {
            if (timerState[id].seconds < target) {
                timerState[id].seconds++;
                element.innerText = timerState[id].seconds;
            } else {
                clearInterval(timerState[id].timer);
            }
        }, interval);
    }

    // Observer les compteurs et démarrer l'animation quand ils sont visibles
    function observeCounter(selector, targets) {
        const element = document.querySelector(selector);
        if (!element) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Démarrer tous les compteurs spécifiés
                    Object.entries(targets).forEach(([id, config]) => {
                        startTimer(config.value, id, config.interval);
                    });
                } else {
                    // Réinitialiser les compteurs lorsqu'ils ne sont plus visibles
                    Object.entries(targets).forEach(([id]) => {
                        if (timerState[id]?.timer) {
                            clearInterval(timerState[id].timer);
                            const counterElement = document.getElementById(id);
                            if (counterElement) counterElement.innerText = "0";
                        }
                    });
                }
            });
        }, { threshold: 0.2 });

        observer.observe(element);
    }

    // Observer le premier compteur et activer tous les compteurs associés
    observeCounter("#value1", {
        "value1": { value: 47, interval: 50 },   // Médecins
        "value2": { value: 128, interval: 25 },  // Infirmiers
        "value3": { value: 12, interval: 80 }    // Services
    });
}

// Gestion du défilement et navigation par ancres
function initScrollHandlers() {
    // Défilement fluide pour les liens d'ancrage
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return; // Ignorer les liens avec href="#"

            e.preventDefault();
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                const offset = -100; // Ajustement de l'offset

                // Utiliser Lenis si disponible, sinon utiliser le scroll natif
                if (window.lenis) {
                    window.lenis.scrollTo(targetElement, {
                        offset: offset,
                        duration: 1.2
                    });
                } else {
                    const y = targetElement.getBoundingClientRect().top + window.pageYOffset + offset;
                    window.scrollTo({
                        top: y,
                        behavior: 'smooth'
                    });
                }

                // Mettre à jour les filtres actifs si applicables
                const filters = document.querySelectorAll('.service-filter');
                if (filters.length > 0) {
                    filters.forEach(filter => {
                        filter.classList.remove('bg-purple', 'text-white');
                        filter.classList.add('bg-gray-light', 'text-dark');
                    });

                    this.classList.remove('bg-gray-light', 'text-dark');
                    this.classList.add('bg-purple', 'text-white');
                }
            }
        });
    });

    // Mettre en évidence la section active lors du défilement
    function highlightActiveSection() {
        // Obtenez toutes les sections avec un ID
        const sections = document.querySelectorAll('section[id], div[id].tab-content div[id]');
        if (sections.length === 0) return;
    
        let currentSection = '';
        const scrollPosition = window.scrollY + 200;
    
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
    
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });
    
        if (currentSection) {
            // Sélectionnez uniquement les liens qui devraient être affectés (excluez les liens du footer)
            const navLinks = document.querySelectorAll('a[href^="#"]:not(footer a)');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === `#${currentSection}`) {
                    link.classList.remove('bg-gray-light', 'text-dark');
                    link.classList.add('bg-purple', 'text-white');
                } else {
                    link.classList.remove('bg-purple', 'text-white');
                    link.classList.add('bg-gray-light', 'text-dark');
                }
            });
        }
    }

    window.addEventListener('scroll', highlightActiveSection);
}

// Gestion du bouton retour en haut
function initBackToTopButton() {
    const backToTopButton = document.getElementById('backToTop');
    if (!backToTopButton) return;

    // Afficher/masquer le bouton en fonction du défilement
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopButton.classList.remove('hidden');
            backToTopButton.classList.add('flex', 'items-center', 'justify-center');
        } else {
            backToTopButton.classList.add('hidden');
            backToTopButton.classList.remove('flex', 'items-center', 'justify-center');
        }
    });

    // Action au clic sur le bouton
    backToTopButton.addEventListener('click', function() {
        if (window.lenis) {
            window.lenis.scrollTo(0);
        } else {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    });
}

// Gestion des modals
function initModalHandlers() {
    // Fonction pour configurer un modal
    function setupModal(modalId, openSelector, closeSelector) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        // Fermer avec la touche Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
            }
        });

        // Fermer en cliquant en dehors du contenu
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }

    // Configurer tous les modals présents
    if (document.getElementById('organigrammeModal')) {
        setupModal('organigrammeModal');
    }
}

// Initialisation des carrousels
function initCarousels() {
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper n\'est pas chargé, les carrousels ne fonctionneront pas.');
        return;
    }

    // Configuration commune pour tous les carrousels
    const commonConfig = {
        slidesPerView: 1,
        spaceBetween: 15,
        loop: true,
        speed: 800,
        observer: true,
        observeParents: true,
        preventInteractionOnTransition: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            clickable: true,
        },
        breakpoints: {
            540: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 15,
            }
        }
    };

    // Initialiser chaque type de carrousel avec sa configuration spécifique
    const initializeSwiper = (selector, extraConfig = {}) => {
        try {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                const config = { ...commonConfig, ...extraConfig };

                // Personnaliser les sélecteurs de navigation/pagination pour ce carrousel spécifique
                if (config.pagination && !config.pagination.el) {
                    const paginationEl = element.querySelector('.swiper-pagination');
                    if (paginationEl) config.pagination.el = paginationEl;
                }

                if (config.navigation) {
                    if (!config.navigation.nextEl) {
                        const nextEl = element.querySelector('.swiper-button-next');
                        if (nextEl) config.navigation.nextEl = nextEl;
                    }
                    if (!config.navigation.prevEl) {
                        const prevEl = element.querySelector('.swiper-button-prev');
                        if (prevEl) config.navigation.prevEl = prevEl;
                    }
                }

                new Swiper(element, config);
            });
        } catch (error) {
            console.error(`Erreur lors de l'initialisation du carrousel ${selector}:`, error);
        }
    };

    // Initialiser les différents carrousels
    initializeSwiper('.former-directors-carousel', {
        navigation: {
            nextEl: '.former-directors-carousel .swiper-button-next',
            prevEl: '.former-directors-carousel .swiper-button-prev',
        }
    });

    initializeSwiper('.team-carousel', {
        navigation: {
            nextEl: '.team-carousel .swiper-button-next',
            prevEl: '.team-carousel .swiper-button-prev',
        }
    });
}

// Initialisation des graphiques
function initCharts() {
    if (typeof Chart === 'undefined') {
        console.warn('Chart.js n\'est pas chargé, les graphiques ne fonctionneront pas.');
        return;
    }

    // Graphique d'évolution du personnel
    const staffChartElement = document.getElementById('staffChart');
    if (staffChartElement) {
        try {
            const ctx = staffChartElement.getContext('2d');

            // Création des dégradés
            const gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradient1.addColorStop(0, 'rgba(142, 46, 155, 0.4)');
            gradient1.addColorStop(1, 'rgba(142, 46, 155, 0.05)');

            const gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradient2.addColorStop(0, 'rgba(94, 204, 193, 0.4)');
            gradient2.addColorStop(1, 'rgba(94, 204, 193, 0.05)');

            // Configuration du graphique
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['2018', '2019', '2020', '2021', '2022', '2023'],
                    datasets: [
                        {
                            label: 'Médecins',
                            data: [32, 35, 38, 42, 45, 47],
                            borderColor: '#8E2E9B',
                            backgroundColor: gradient1,
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#8E2E9B',
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Infirmiers',
                            data: [85, 92, 98, 110, 122, 128],
                            borderColor: '#5ECCC1',
                            backgroundColor: gradient2,
                            borderWidth: 2,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#5ECCC1',
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12,
                                    family: "'Poppins', sans-serif"
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#333',
                            bodyColor: '#666',
                            titleFont: {
                                size: 14,
                                weight: 'bold',
                                family: "'Poppins', sans-serif"
                            },
                            bodyFont: {
                                size: 13,
                                family: "'Rubik', sans-serif"
                            },
                            padding: 12,
                            borderColor: '#ddd',
                            borderWidth: 1,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw + ' personnes';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)',
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 20,
                                font: {
                                    size: 11,
                                    family: "'Rubik', sans-serif"
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    family: "'Rubik', sans-serif"
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Erreur lors de l\'initialisation du graphique:', error);
        }
    }
}


const handleVideo = (checked) => {
    const iframe = document.querySelector("#video iframe");
    
    if (checked) {
      // Lorsque le modal est ouvert, définir l'URL YouTube avec autoplay=1
      iframe.src = "https://www.youtube.com/embed/0f49AuWqZiI?autoplay=1";
      // Rendre le modal cliquable en supprimant la classe pointer-events-none
      document.querySelector("#video").classList.remove("pointer-events-none");
    } else {
      // Lorsque le modal est fermé, supprimer l'URL après un délai
      setTimeout(() => {
        iframe.src = "";
        // Remettre la classe pointer-events-none pour éviter les clics pendant la transition
        document.querySelector("#video").classList.add("pointer-events-none");
      }, 1000);
    }
  };
  
  // Ajouter un écouteur d'événement pour le changement d'état de la checkbox
  document
    .getElementById("video-check")
    .addEventListener("change", (e) => handleVideo(e.target.checked));