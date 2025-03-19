<header
  class="relative h-[70vh] bg-cover bg-no-repeat bg-center"
  style="background-image: url({{ asset('assets/herobg.jpg') }})">
  <div
    class="flex h-full items-center bg-gradient-to-r from-purple/80 to-turquoise/60 text-white"
  >
  <div class="container">
    <div class="lg:w-8/12">
      <h4
        class="font-bold"
        data-aos="fade-right"
        data-aos-duration="1000"
      >
      CENTRE HOSPITALIER UNIVERSITAIRE MAHAVOKY ATSIMO
      </h4>

      <p
        class="mb-12 mt-4"
        data-aos="fade-right"
        data-aos-duration="1000"
        data-aos-delay="100"
      >
      Offrir des soins de qualité et une prise en charge optimale pour instaurer une confiance durable entre patients et soignants.
      </p>

      <div class="flex items-center gap-12 mb-32">
        <a href="#" class="group relative h-14 w-36 overflow-hidden rounded border-2 border-white bg-transparent px-7 py-3 text-white transition duration-300 hover:bg-white hover:text-purple">
          <span class="absolute bottom-0 left-0 right-0 top-0 z-10 m-auto inline-flex items-center justify-center">
            En savoir plus
        </span>
          <div class="absolute left-0 top-0 z-0 h-full w-0 rounded-r-full bg-white transition-[width] duration-300 group-hover:w-44"></div>
        </a>

        <label
        class="flex cursor-pointer items-center gap-4 font-semibold animate-bounce"
        data-aos="fade-right"
        data-aos-duration="1000"
        data-aos-delay="300"
        for="video-check"
      >
        <div
          class="flex h-8 w-8 items-center justify-center rounded-full bg-white text-purple relative animate-pulse"
        >
          <span class="absolute w-10 h-10 rounded-full bg-white/50 animate-ping"></span>
          <i class="fa fa-play text-xs relative z-10"></i>
        </div>
        Voir la vidéo
      </label>
      </div>
    </div>
  </div>
</div>
</header>

<div class="container relative pb-18">
    <div
        class="static -top-20 grid grid-cols-1 gap-4 bg-white p-7 shadow-[0_3px_32px_0_rgba(142,46,155,0.2)] md:grid-cols-2 lg:absolute lg:grid-cols-3 lg:p-14 z-10">
      <aside
        class="flex flex-col items-center justify-center gap-4 text-center text-dark lg:flex-row lg:text-left"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="100"
      >
        <div class="flex flex-col items-center justify-center w-20 lg:w-28">
          <i class="fa fa-user-md text-3xl text-purple mb-2"></i>
          <div class="text-xl font-bold text-purple"><span id="value1" class="counter">0</span>+</div>
        </div>
        <aside>
          <h5 class="font-medium text-dark">Médecins spécialistes</h5>
          <p class="text-gray-dark">
            Une équipe médicale hautement qualifiée
          </p>
        </aside>
      </aside>

      <aside
        class="flex flex-col items-center justify-center gap-4 text-center text-dark lg:flex-row lg:text-left"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="200"
      >
        <div class="flex flex-col items-center justify-center w-20 lg:w-28">
          <i class="fa fa-procedures text-3xl text-turquoise mb-2"></i>
          <div class="text-xl font-bold text-turquoise"><span id="value2" class="counter">0</span>k+</div>
        </div>
        <aside>
          <h5 class="font-medium text-dark">Patients satisfaits</h5>
          <p class="text-gray-dark">
            Des soins de santé de qualité pour tous
          </p>
        </aside>
      </aside>

      <aside
        class="flex flex-col items-center justify-center gap-4 text-center text-dark lg:flex-row lg:text-left"
        data-aos="fade-up"
        data-aos-duration="1000"
        data-aos-delay="300"
      >
        <div class="flex flex-col items-center justify-center w-20 lg:w-28">
          <i class="fa fa-stethoscope text-3xl text-purple mb-2"></i>
          <div class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple to-turquoise"><span id="value3" class="counter">0</span></div>
        </div>
        <aside>
          <h5 class="font-medium text-dark">Services</h5>
          <p class="text-gray-dark">
            Départements médicaux spécialisés
          </p>
        </aside>
      </aside>
    </div>
</div>

<input class="hidden" type="checkbox" id="video-check" />
<label
for="video-check"
class="pointer-events-none fixed left-0 top-0 z-[99999999999] flex h-screen w-screen items-center justify-center bg-black bg-opacity-50 opacity-0 transition delay-200 duration-1000"
id="video"
>
<div
  class="relative aspect-[16/9] w-11/12 rounded-md shadow-[0_0_3rem_#333] lg:w-1/2">
<label
    for="video-check"
    class="absolute -top-14 right-0 cursor-pointer text-3xl text-white lg:-right-10 lg:-top-12">
    <i class="fa fa-times"></i>
</label>
<iframe
    class="h-full w-full rounded-md scale-0 transition-transform duration-500 video-check:scale-100"
    title="YouTube video player"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    referrerpolicy="strict-origin-when-cross-origin"
    allowfullscreen>
</iframe>
</div>
</label>
