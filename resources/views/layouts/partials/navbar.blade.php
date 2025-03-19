<nav
class="sticky z-[9999999999] bg-white shadow-[0_0_80px_0_#2B245D21]"
id="navbar-container"
>
<div class="relative">
  <div class="container flex items-center justify-between py-6">
    <a href="/" class="flex items-center gap-2">
      <img
        src="{{ asset('assets/logo.png') }}"
        alt="logo"
        class="aspect-square w-7"
      />
      <h6 class="font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple to-turquoise">CHU Mahavoky Atsimo</h6>
    </a>

    <label for="nav-check" class="lg:hidden">
      <i class="fa fa-bars text-purple"></i>
    </label>
    <input type="checkbox" class="hidden" id="nav-check" />
    <ul
      class="absolute left-0 top-16 flex w-full flex-col gap-4 bg-white px-4 py-3 font-poppins font-medium lg:static lg:w-fit lg:flex-row lg:gap-12 lg:bg-transparent lg:px-0 lg:py-0"
      id="navbar"
    >
      <li class="group">
        <a href="/" class="text-dark hover:text-purple">Accueil</a>
        <div
          class="ml-auto h-[1.3px] w-0 bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
        ></div>
      </li>
      <li class="group">
        <a href="{{ route('about') }}" class="text-dark hover:text-purple">À propos</a>
        <div
          class="ml-auto h-[1.3px] w-0 bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
        ></div>
      </li>
      <li class="group">
        <a href="{{ route('services') }}" class="text-dark hover:text-purple">Services</a>
        <div
          class="ml-auto h-[1.3px] w-0 bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
        ></div>
      </li>
      <li class="group">
        <a href="!#" class="text-dark hover:text-purple">Actualités</a>
        <div
          class="ml-auto h-[1.3px] w-0 bg-purple transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
        ></div>
      </li>
    </ul>

    <a href="{{ route('contact') }}"
    class="group relative hidden h-14 w-36 overflow-hidden rounded border-2 border-purple bg-transparent px-7 py-3 text-purple transition duration-300 hover:text-white lg:block"
  >
    <span
      class="absolute bottom-0 left-0 right-0 top-0 z-10 m-auto inline-flex items-center justify-center gap-2"
      >
      <i class="fa fa-ambulance"></i>
      Urgence
    </span>
    <div
      class="absolute left-0 top-0 z-0 h-full w-0 rounded-r-full bg-purple transition-[width] duration-300 group-hover:w-44"
    ></div>
  </a>
  </div>
</div>
</nav>
