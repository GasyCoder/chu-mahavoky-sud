<div class="container">
  <div class="py-8 md:py-8"></div> <!-- Espace vertical important -->
</div>
<!-- Section du directeur - Complètement séparée avec un style distinct -->
<section class="bg-gray-50 py-16">
  <div class="container">
      <div class="flex flex-col lg:flex-row items-center gap-12 max-w-6xl mx-auto">
          <!-- Image du directeur -->
          <div class="lg:w-5/12 w-full">
              <div class="rounded-lg overflow-hidden shadow-lg mx-auto lg:mx-0 bg-white p-4">
                  <img 
                      src="{{ asset('assets/about/directeur.png') }}" 
                      alt="Dr. HABIB NOURALY - Directeur du CHU Mahavoky Atsimo" 
                      class="w-full h-auto object-cover aspect-[4/5]"
                  />
              </div>
          </div>
          
          <!-- Contenu textuel -->
          <div class="lg:w-7/12 w-full px-4 lg:px-8">
              <div class="text-purple uppercase text-sm font-medium tracking-wider mb-3">
                  LE MOT DU DIRECTEUR DE L'ÉTABLISSEMENT
              </div>
              
              <h2 class="text-3xl font-bold text-gray-900 mb-2">
                  Dr. HABIB NOURALY
              </h2>
              
              <div class="text-gray-600 text-lg mb-4">
                  Médecin radiologue au CHU MAHAVOKY Mahajanga
              </div>
              
              <div class="text-gray-700 leading-relaxed mb-6">
                  <p>
                      En tant que directeur du CHU Mahavoky Atsimo, je suis fier de diriger une équipe dévouée de professionnels de santé qui s'engagent à fournir des soins exceptionnels adaptés aux besoins de chaque patient. Notre mission est d'offrir une médecine d'excellence accessible à tous, combinant expertise médicale, technologies de pointe et approche humaine.
                  </p>
              </div>
              
              <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-purple hover:text-turquoise transition font-medium">
                  <span>Découvrir nos services</span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
              </a>
          </div>
      </div>
  </div>
</section>