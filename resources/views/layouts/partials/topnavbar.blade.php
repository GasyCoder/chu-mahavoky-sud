<div class="bg-gradient-to-r from-[#2a0a3c] to-[#0d3039] text-white py-3">
    <div class="container">
      <div class="flex items-center justify-center lg:justify-between">
        <div class="flex items-center gap-2 lg:gap-6">
          <div class="flex items-center gap-2">
            <i class="fa fa-envelope-open"></i>
            <a href="mailto:{{ $settings['contact']['email'] }}" class="font-poppins text-sm">
              {{ $settings['contact']['email'] }}
            </a>
          </div>

          <div class="flex items-center gap-2">
            <i class="fa fa-phone rotate-90"></i>
            <a href="tel:{{ $settings['contact']['phone'] }}" class="font-poppins text-sm">
              {{ $settings['contact']['phone'] }}
            </a>
          </div>
        </div>

        <ul class="hidden items-center divide-x divide-white text-base lg:flex">
          <li class="px-3">Suivre</li>
          @if($settings['social']['facebook'])
          <li class="flex items-center px-3">
            <a href="{{ $settings['social']['facebook'] }}" target="_blank">
              <i class="fab fa-facebook hover:text-secondary text-base transition"></i>
            </a>
          </li>
          @endif
          @if($settings['social']['linkedin'])
          <li class="flex items-center px-3">
            <a href="{{ $settings['social']['linkedin'] }}" target="_blank">
              <i class="fab fa-linkedin hover:text-secondary text-base transition"></i>
            </a>
          </li>
          @endif
          @if($settings['social']['twitter'])
          <li class="flex items-center px-3">
            <a href="{{ $settings['social']['twitter'] }}" target="_blank">
              <i class="fab fa-twitter hover:text-secondary text-base transition"></i>
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
