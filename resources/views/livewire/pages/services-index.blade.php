<div>
<!-- Bannière stylisée fine -->
<section class="relative h-48 bg-fixed bg-center bg-cover sm:h-56 md:h-64" style="background-image: url('{{ asset('assets/services-banner.jpg') }}')">
    <div class="absolute inset-0 bg-gradient-to-r from-purple/80 to-turquoise/70 backdrop-blur-sm"></div>
    <div class="relative z-10 flex items-center justify-center h-full px-4 text-center">
        <div>
            <h1 class="mb-2 text-xl font-bold text-white sm:text-2xl md:text-3xl font-rubik" data-aos="fade-up">
                Nos Services
            </h1>
            <div class="w-16 h-0.5 bg-white mx-auto mb-2" data-aos="fade-up" data-aos-delay="150"></div>
            <p class="max-w-xl mx-auto text-sm font-light text-white sm:text-base md:text-lg" data-aos="fade-up" data-aos-delay="300">
                L'excellence médicale et administrative au service de votre santé.
            </p>
        </div>
    </div>
</section>


    <!-- Fil d'Ariane -->
    <div class="py-3 bg-gray-light">
        <div class="container flex items-center gap-2 text-sm text-gray-dark">
            <a href="/" class="font-medium transition-colors text-purple hover:text-purple-dark">Accueil</a>
            <span>/</span>
            <span class="text-gray-dark">Services</span>
        </div>
    </div>

    <!-- Section avec onglets -->
    <section class="container py-12">
        <!-- Onglets -->
        <div class="flex flex-col justify-center gap-4 mb-10 border-b sm:flex-row sm:gap-8 border-gray" data-aos="fade-up" data-aos-delay="50">
            <button wire:click="switchTab('technical')"
                class="pb-2 font-medium text-lg transition-all duration-200 font-poppins
                {{ $activeTab === 'technical'
                    ? 'text-purple border-b-2 border-purple'
                    : 'text-gray-dark hover:text-purple-dark' }}">
                 <i class="mr-3 fas fa-stethoscope"></i>Services Techniques
            </button>
            <button wire:click="switchTab('administrative')"
                class="pb-2 font-medium text-lg transition-all duration-200 font-poppins
                {{ $activeTab === 'administrative'
                    ? 'text-turquoise border-b-2 border-turquoise'
                    : 'text-gray-dark hover:text-turquoise-dark' }}">
                <i class="mr-2 fas fa-briefcase"></i>Services Administratifs
            </button>
        </div>

        <!-- Contenu -->
        <div data-aos="fade-up" data-aos-delay="50">
            @include('livewire.pages.services.technique')
            @include('livewire.pages.services.administratif')
        </div>
    </section>
</div>
