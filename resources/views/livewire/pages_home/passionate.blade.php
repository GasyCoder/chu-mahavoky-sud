<!-- Section Soins de Santé Compatissants - Redesign optimisé -->
<section class="relative bg-cover bg-center bg-no-repeat py-16" style="background-image: url({{ asset('assets/compassionate-healthcare-bg.jpeg') }})">
  <!-- Overlay plus léger pour que l'image d'arrière-plan soit plus visible -->
  <div class="absolute inset-0 bg-gradient-to-r from-purple/75 to-turquoise/65"></div>
  
  <div class="container relative z-10">
      <div class="flex flex-col lg:flex-row items-stretch gap-8">
          <!-- Colonne de gauche - Contenu textuel -->
          <div class="w-full lg:w-1/2 text-white">
              <div class="lg:pr-8">
                  <p class="font-medium mb-2">
                      CHU MAHAVOKY ATSIMO
                  </p>
                  
                  <h2 class="text-2xl font-bold mb-5 leading-tight">
                      Un environnement de soins de santé compatissants
                  </h2>
                  
                  <p class="text-white leading-relaxed">
                      De la médecine préventive aux traitements spécialisés, nous priorisons votre parcours de santé. Grâce à des technologies de pointe et des professionnels compatissants, nous nous efforçons d'assurer chaque étape de vos soins de santé avec excellence et humanité.
                  </p>
              </div>
          </div>
          
          <!-- Colonne de droite - Cartes d'avantages -->
          <div class="w-full lg:w-1/2">
              <div class="bg-white/95 backdrop-blur-sm rounded-lg shadow-lg h-full">
                  <!-- Carte 1 -->
                  <div class="p-6 border-b border-gray-100 flex items-center gap-5">
                      <!-- Icône plus grande et bien visible -->
                      <div class="flex-shrink-0 bg-purple rounded-lg p-4 shadow-sm">
                          <img 
                              src="{{ asset('assets/icons/stethoscope_arrow.svg') }}" 
                              alt="Expérience centrée sur le patient" 
                              class="w-10 h-10 object-contain"
                          />
                      </div>
                      
                      <div>
                          <h4 class="text-gray-900 font-semibold text-lg mb-1">
                              Expérience centrée sur le patient
                          </h4>
                          <p class="text-gray-600">
                              Soins personnalisés assurant le bien-être holistique du patient
                          </p>
                      </div>
                  </div>
                  
                  <!-- Carte 2 -->
                  <div class="p-6 flex items-center gap-5">
                      <!-- Icône plus grande et bien visible -->
                      <div class="flex-shrink-0 bg-turquoise rounded-lg p-4 shadow-sm">
                          <img 
                              src="{{ asset('assets/icons/skeleton.svg') }}" 
                              alt="Soins de santé intégrés" 
                              class="w-10 h-10 object-contain"
                          />
                      </div>
                      
                      <div>
                          <h4 class="text-gray-900 font-semibold text-lg mb-1">
                              Expérience de soins de santé intégrés
                          </h4>
                          <p class="text-gray-600">
                              Soins coordonnés et fluides à travers de multiples services de santé
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>