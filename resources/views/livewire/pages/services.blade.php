<div>
    <!-- Bannière de la page Services avec parallax -->
    <section class="relative h-80 bg-cover bg-center bg-fixed" style="background-image: url({{ asset('assets/services-banner.jpg') }})">
        <div class="absolute inset-0 bg-gradient-to-r from-purple/90 to-turquoise/80"></div>
        <div class="container relative flex h-full items-center justify-center">
            <div class="text-center">
                <h1 class="text-4xl md:text-2xl font-bold text-white mb-4"
                data-aos="fade-up" data-aos-duration="1000">Nos Services
                </h1>
                <div class="h-1 w-20 bg-white mx-auto" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"></div>
                <p class="mt-4 text-white max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                    L'excellence médicale et administrative au service de votre santé.
                </p>
            </div>
        </div>
    </section>

    <!-- Fil d'Ariane -->
    <div class="bg-gray-light py-3">
        <div class="container">
            <div class="flex items-center text-sm">
                <a href="/" class="text-purple hover:text-turquoise transition-colors">Accueil</a>
                <span class="mx-2 text-gray-dark">/</span>
                <span class="text-gray-dark">Services</span>
            </div>
        </div>
    </div>

    <!-- Section principale avec navigation par onglets -->
    <section class="container py-8">
        <!-- Navigation par onglets -->
        <div class="mb-6 border-b border-gray" data-aos="fade-up" data-aos-duration="1000">
            <div class="flex flex-wrap -mb-px">
                <button wire:click="switchTab('medical')" class="text-center py-4 px-6 text-lg font-medium border-b-2 {{ $activeTab === 'medical' ? 'border-purple text-purple' : 'border-transparent text-gray-dark hover:text-purple' }}">
                    <i class="fas fa-stethoscope mr-2"></i>Services Médicaux
                </button>
                <button wire:click="switchTab('admin')" class="text-center py-4 px-6 text-lg font-medium border-b-2 {{ $activeTab === 'admin' ? 'border-purple text-purple' : 'border-transparent text-gray-dark hover:text-purple' }}">
                    <i class="fas fa-briefcase mr-2"></i>Services Administratifs
                </button>
            </div>
        </div>
        @include('livewire.pages.services.medicale')
        @include('livewire.pages.services.administratif')
    </section>

 </div>
