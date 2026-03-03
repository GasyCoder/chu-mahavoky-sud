<!-- Top Navbar - Design moderne avec animations -->
<div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white py-2.5 border-b border-white/5">
    <div class="container">
      <div class="flex items-center justify-between">
        <!-- Informations de contact -->
        <div class="flex items-center gap-4 md:gap-6">
          <a href="mailto:{{ $settings['contact']['email'] }}" class="group flex items-center gap-2 transition-colors hover:text-primary">
            <div class="w-7 h-7 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
              <i class="far fa-envelope text-xs"></i>
            </div>
            <span class="font-poppins text-xs md:text-sm text-white/80 group-hover:text-white transition-colors hidden sm:inline">
              {{ $settings['contact']['email'] }}
            </span>
          </a>

          <a href="tel:{{ $settings['contact']['phone'] }}" class="group flex items-center gap-2 transition-colors hover:text-primary">
            <div class="w-7 h-7 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
              <i class="far fa-phone text-xs"></i>
            </div>
            <span class="font-poppins text-xs md:text-sm text-white/80 group-hover:text-white transition-colors hidden sm:inline">
              {{ $settings['contact']['phone'] }}
            </span>
          </a>
        </div>

        <!-- Reseaux sociaux et separator -->
        <div class="flex items-center gap-1">
          <span class="text-white/40 text-xs mr-2 hidden lg:inline">Suivez-nous</span>
          
          @if($settings['social']['facebook'])
          <a href="{{ $settings['social']['facebook'] }}" target="_blank" class="group flex items-center justify-center w-8 h-8 rounded-lg text-white/60 hover:text-white hover:bg-white/10 transition-all duration-300 hover:scale-110">
            <i class="fab fa-facebook-f text-xs"></i>
          </a>
          @endif
          
          @if($settings['social']['linkedin'])
          <a href="{{ $settings['social']['linkedin'] }}" target="_blank" class="group flex items-center justify-center w-8 h-8 rounded-lg text-white/60 hover:text-white hover:bg-white/10 transition-all duration-300 hover:scale-110">
            <i class="fab fa-linkedin-in text-xs"></i>
          </a>
          @endif
          
          @if($settings['social']['twitter'])
          <a href="{{ $settings['social']['twitter'] }}" target="_blank" class="group flex items-center justify-center w-8 h-8 rounded-lg text-white/60 hover:text-white hover:bg-white/10 transition-all duration-300 hover:scale-110">
            <i class="fab fa-twitter text-xs"></i>
          </a>
          @endif
          
          @if($settings['social']['youtube'])
          <a href="{{ $settings['social']['youtube'] }}" target="_blank" class="group flex items-center justify-center w-8 h-8 rounded-lg text-white/60 hover:text-white hover:bg-white/10 transition-all duration-300 hover:scale-110">
            <i class="fab fa-youtube text-xs"></i>
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
