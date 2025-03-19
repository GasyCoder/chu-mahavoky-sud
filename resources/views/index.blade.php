<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="./assets/logo.webp" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VitalCare - Experience Excellence in Medicine</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />

    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <body>
    <div class="bg-primary py-3 text-white">
      <div class="container">
        <div class="flex items-center justify-center lg:justify-between">
          <div class="flex items-center gap-2 lg:gap-6">
            <div class="flex items-center gap-2">
              <i class="fa fa-envelope-open"></i>
              <a href="mailto:support@raddito.com" class="font-poppins text-sm"
                >support@raddito.com</a
              >
            </div>

            <div class="flex items-center gap-2">
              <i class="fa fa-phone rotate-90"></i>
              <a href="callto:+833-900-8338" class="font-poppins text-sm">
                +833-900-8338</a
              >
            </div>
          </div>

          <ul
            class="hidden items-center divide-x divide-white text-base lg:flex"
          >
            <li class="px-3">Follow Us</li>
            <li class="flex items-center px-3">
              <a href="#">
                <i
                  class="fab fa-facebook hover:text-secondary text-base transition"
                ></i>
              </a>
            </li>
            <li class="flex items-center px-3">
              <a href="#">
                <i
                  class="fab fa-twitter hover:text-secondary text-base transition"
                ></i>
              </a>
            </li>
            <li class="flex items-center px-3">
              <a href="#">
                <i
                  class="fab fa-instagram hover:text-secondary text-base transition"
                ></i>
              </a>
            </li>
            <li class="flex items-center px-3">
              <a href="#">
                <i
                  class="fab fa-linkedin hover:text-secondary text-base transition"
                ></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <nav
      class="sticky z-[9999999999] bg-white text-primary shadow-[0_0_80px_0_#2B245D21]"
      id="navbar-container"
    >
      <div class="relative">
        <div class="container flex items-center justify-between py-6">
          <a href="#" class="flex items-center gap-2">
            <img
              src="./assets/logo.webp"
              alt="logo"
              class="aspect-square w-7"
            />
            <h4 class="font-extrabold text-primary">VitalCare</h4>
          </a>

          <label for="nav-check" class="lg:hidden">
            <i class="fa fa-bars"></i>
          </label>
          <input type="checkbox" class="hidden" id="nav-check" />
          <ul
            class="absolute left-0 top-16 flex w-full flex-col gap-4 bg-white px-4 py-3 font-poppins font-medium lg:static lg:w-fit lg:flex-row lg:gap-12 lg:bg-transparent lg:px-0 lg:py-0"
            id="navbar"
          >
            <li class="group">
              <a href="#">Home</a>
              <div
                class="ml-auto h-[1.3px] w-0 bg-primary transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
              ></div>
            </li>
            <li class="group">
              <a href="#">About</a>
              <div
                class="ml-auto h-[1.3px] w-0 bg-primary transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
              ></div>
            </li>
            <li class="group">
              <a href="#">Services</a>
              <div
                class="ml-auto h-[1.3px] w-0 bg-primary transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
              ></div>
            </li>
            <li class="group">
              <a href="#">Blog</a>
              <div
                class="ml-auto h-[1.3px] w-0 bg-primary transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
              ></div>
            </li>
            <li class="group">
              <a href="#">Testimonials</a>
              <div
                class="ml-auto h-[1.3px] w-0 bg-primary transition-[width] duration-150 group-hover:ml-0 group-hover:w-full"
              ></div>
            </li>
          </ul>

          <button
            class="group relative hidden h-14 w-36 overflow-hidden rounded border-2 border-primary bg-transparent px-7 py-3 transition duration-300 hover:text-white lg:block"
          >
            <span
              class="absolute bottom-0 left-0 right-0 top-0 z-10 m-auto inline-flex items-center justify-center"
              >Book Online</span
            >
            <div
              class="trnasition absolute left-0 top-0 z-0 h-full w-0 rounded-r-full bg-primary transition-[width] duration-300 group-hover:w-44"
            ></div>
          </button>
        </div>
      </div>
    </nav>

    <div class="w-screen overflow-x-hidden">



    </div>

    <script
      src="https://kit.fontawesome.com/b50fc748ca.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://unpkg.com/lenis@1.1.5/dist/lenis.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script type="module" src="assets/js/main.js"></script>
  </body>
</html>
