<div>
<!-- Banner avec design ameliore -->
<section class="relative h-[45vh] min-h-[400px] bg-fixed bg-center bg-cover overflow-hidden" style="background-image: url('{{ asset('assets/services-banner.jpg') }}')">
    <!-- Overlay avec gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/90 via-slate-900/70 to-primary/40"></div>
    
    <!-- Particules decoratives -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="relative z-10 flex items-center justify-center h-full px-4 text-center">
        <div class="max-w-3xl">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-5 py-2 mb-6" data-aos="fade-down" data-aos-duration="700">
                <i class="fas fa-stethoscope text-primary text-sm"></i>
                <span class="text-sm font-medium text-white">Excellence & Innovation</span>
            </div>
            
            <!-- Titre -->
            <h1 class="mb-4 text-4xl md:text-5xl font-bold text-white" data-aos="fade-up" data-aos-duration="800">
                Nos <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-400">Services</span>
            </h1>
            
            <!-- Description -->
            <p class="max-w-xl mx-auto text-sm md:text-base lg:text-lg text-white/80 font-light leading-relaxed" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                L'excellence medicale et administrative au service de votre sante. Des soins de qualite grâce a nos equipements modernes et notre personnel qualifie.
            </p>
        </div>
    </div>
</section>

    <!-- Breadcrumb moderne -->
    <div class="py-4 bg-white border-b border-gray-100">
        <div class="container">
            <nav class="flex items-center gap-2 text-sm" aria-label="Breadcrumb">
                <a href="/" class="group flex items-center gap-2 font-medium text-gray-500 hover:text-primary transition-colors">
                    <i class="far fa-home text-xs group-hover:text-primary transition-colors"></i>
                    <span>Accueil</span>
                </a>
                <span class="text-gray-300">/</span>
                <span class="font-medium text-primary" aria-current="page">Services</span>
            </nav>
        </div>
    </div>

    <!-- Section avec onglets modernes -->
    <section class="container py-16">
        <!-- Titre de section -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">Decouvrez nos services</h2>
            <div class="flex items-center justify-center gap-2">
                <div class="w-12 h-1 bg-gradient-to-r from-primary to-blue-500 rounded-full"></div>
            </div>
        </div>
        
        <!-- Onglets pill design ameliore -->
        <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="inline-flex bg-gray-100 rounded-2xl p-1.5 shadow-inner">
                <button wire:click="switchTab('technical')"
                    class="group relative px-6 py-3 font-semibold text-sm transition-all duration-300 rounded-xl overflow-hidden
                    {{ $activeTab === 'technical'
                        ? 'bg-white text-primary shadow-md'
                        : 'text-gray-600 hover:text-dark hover:bg-gray-200/50' }}">
                    <span class="relative z-10 flex items-center gap-2.5">
                        <i class="fas fa-stethoscope {{ $activeTab === 'technical' ? 'text-primary' : 'text-gray-400 group-hover:text-dark' }}"></i>
                        <span>Services Techniques</span>
                    </span>
                    @if($activeTab === 'technical')
                    <span class="absolute inset-0 bg-primary/5 rounded-xl"></span>
                    @endif
                </button>
                <button wire:click="switchTab('administrative')"
                    class="group relative px-6 py-3 font-semibold text-sm transition-all duration-300 rounded-xl overflow-hidden
                    {{ $activeTab === 'administrative'
                        ? 'bg-white text-primary shadow-md'
                        : 'text-gray-600 hover:text-dark hover:bg-gray-200/50' }}">
                    <span class="relative z-10 flex items-center gap-2.5">
                        <i class="fas fa-briefcase {{ $activeTab === 'administrative' ? 'text-primary' : 'text-gray-400 group-hover:text-dark' }}"></i>
                        <span>Services Administratifs</span>
                    </span>
                    @if($activeTab === 'administrative')
                    <span class="absolute inset-0 bg-primary/5 rounded-xl"></span>
                    @endif
                </button>
            </div>
        </div>

        <!-- Contenu avec animation -->
        <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
            @include('livewire.pages.services.technique')
            @include('livewire.pages.services.administratif')
        </div>
    </section>
</div>
