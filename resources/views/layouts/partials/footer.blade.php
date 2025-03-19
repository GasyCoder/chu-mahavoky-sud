<!-- Footer Section -->
<footer class="bg-gradient-to-r from-purple-dark to-turquoise-dark text-white">
    <div class="container justify-between py-14">
      <div class="flex flex-col items-center gap-6 lg:flex-row lg:gap-0">
        <aside class="text-center lg:text-left">
          <h3
            class="font-bold"
            data-aos="fade-right"
            data-aos-duration="1000"
          >
            Restez informé
          </h3>
          <p data-aos="fade-right" data-aos-duration="1000">
            Inscrivez-vous à notre newsletter
          </p>
        </aside>

        <aside class="relative flex w-full lg:ml-auto lg:w-2/4">
          <input
            type="text"
            class="w-full rounded bg-white p-4 text-dark placeholder:text-gray-dark focus:outline-none lg:px-4 lg:py-6"
            placeholder="Entrez votre email ici"
            data-aos="fade-left"
            data-aos-duration="1000"
          />
          <div
            class="absolute bottom-0 right-1 top-0 my-auto flex h-full items-center lg:right-4"
          >
            <button
              class="group relative h-12 w-28 overflow-hidden rounded border-2 border-purple bg-purple text-white transition duration-300 hover:text-purple lg:h-14 lg:w-36"
              data-aos="fade-left"
              data-aos-duration="1000"
              data-aos-delay="300"
            >
              <span
                class="absolute bottom-0 left-0 right-0 top-0 z-10 m-auto inline-flex items-center justify-center"
                >S'abonner</span
              >
              <div
                class="absolute left-0 top-0 z-0 h-full w-0 rounded-r-full bg-white transition-[width] duration-300 group-hover:w-44"
              ></div>
            </button>
          </div>
        </aside>
      </div>
    </div>

    <hr class="bg-gray-dark" />

    <div class="container flex flex-col gap-10 py-14 lg:flex-row">
      <div class="lg:w-4/12">
        <div class="flex items-center gap-2">
          <img src="{{ asset('assets/logo.png') }}" alt="Logo CHU" class="w-10 h-10 bg-white rounded-full p-1" />
          <h5 class="text-white font-bold">CHU Mahavoky Atsimo</h5>
        </div>
        <p class="mt-4">
          Nous sommes dédiés à offrir des soins compatissants et personnalisés pour répondre à vos besoins uniques.
        </p>
      </div>

      <div>
        <h6 class="font-bold">Liens rapides</h6>
        <ul class="mt-4 flex flex-col gap-3">
          <li><a href="/" class="hover:opacity-75 transition-opacity"> Accueil </a></li>
          <li><a href="!#" class="hover:opacity-75 transition-opacity"> À propos </a></li>
          <li><a href="!#" class="hover:opacity-75 transition-opacity"> Services </a></li>
          <li><a href="!#" class="hover:opacity-75 transition-opacity"> Actualités </a></li>
        </ul>
      </div>

      <div>
        <h6 class="font-bold">Contact</h6>
        <ul class="mt-4 flex flex-col gap-3">
          <li class="flex items-center gap-3">
            <div class="flex aspect-square w-4 items-center justify-center">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <a href="!#" class="transition hover:opacity-75">
              Mahavoky Atsimo, Mahajanga, Madagascar
            </a>
          </li>
          <li class="flex items-center gap-3">
            <div class="flex aspect-square w-4 items-center justify-center">
              <i class="fas fa-phone rotate-90"></i>
            </div>
            <a href="tel:+261340000000" class="transition hover:opacity-75">+261 34 00 000 00</a>
          </li>
          <li class="flex items-center gap-3">
            <div class="flex aspect-square w-4 items-center justify-center">
              <i class="fas fa-envelope"></i>
            </div>
            <a href="mailto:contact@chumahavaky.mg" class="transition hover:opacity-75">
              contact@chu-mahavokyatsimo.mg
            </a>
          </li>
        </ul>
      </div>

      <div>
        <h6 class="font-bold">Réseaux sociaux</h6>
        <ul class="mt-4 flex flex-col gap-3">
          <li>
            <a href="!#" class="flex items-center gap-2 transition hover:opacity-60">
              <div class="flex aspect-square w-5 items-end justify-center rounded bg-white text-purple">
                <i class="fa fa-facebook"></i>
              </div>
              <span class="font-semibold">Facebook</span>
            </a>
          </li>
          <li>
            <a href="!#" class="flex items-center gap-2 transition hover:opacity-60">
              <div class="flex aspect-square w-5 items-center justify-center rounded bg-white text-purple">
                <i class="fa fa-linkedin text-xs"></i>
              </div>
              <span class="font-semibold">LinkedIn</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </footer>

  <div class="bg-[#1A1A2E] py-6 text-center text-white">
    <div class="container mx-auto">
      <div class="flex flex-col items-center justify-center space-y-2 md:flex-row md:space-y-0 md:space-x-4">
        <div>
          Copyright ©<span id="year"></span> CHU Mahavoky Atsimo - Tous droits réservés
        </div>
        <div class="flex items-center space-x-4">
          <a href="!#" class="text-turquoise/80 hover:text-turquoise transition-colors duration-300">
            Mentions légales
          </a>
          <span class="hidden md:inline">|</span>
          <a href="https://gasycoder.com" target="_blank" class="text-turquoise/80 hover:text-turquoise transition-colors duration-300 flex items-center">
            <span>Développé par</span>
            <span class="ml-1 font-semibold">GasyCoder</span>
          </a>
        </div>
      </div>
    </div>
  </div>

