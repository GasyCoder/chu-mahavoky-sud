<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Portail CHU</h2>
        <p class="text-slate-500 mt-2 font-medium">Content de vous revoir !</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-2xl text-sm font-medium" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email')" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-200 group-focus-within:text-primary text-slate-400">
                    <i class="fas fa-envelope text-xs"></i>
                </div>
                <x-text-input 
                    id="email" 
                    class="block w-full pl-11 pr-4 py-3 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none text-sm font-bold text-slate-700 placeholder:text-slate-400 placeholder:font-medium" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                    placeholder="votre@email.com"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500 ml-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5" x-data="{ show: false }">
            <div class="flex items-center justify-between ml-1">
                <x-input-label for="password" :value="__('Mot de passe')" class="text-[11px] font-black text-slate-400 uppercase tracking-widest" />
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black text-primary uppercase tracking-widest hover:text-primary/70 transition-colors" href="{{ route('password.request') }}">
                        Oublié ?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors duration-200 group-focus-within:text-primary text-slate-400">
                    <i class="fas fa-lock text-xs"></i>
                </div>
                <x-text-input 
                    id="password" 
                    class="block w-full pl-11 pr-12 py-3 bg-slate-50 border-slate-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none text-sm font-bold text-slate-700 placeholder:text-slate-400 placeholder:font-medium" 
                    type="password"
                    x-bind:type="show ? 'text' : 'password'" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                    placeholder="••••••••"
                />
                <button 
                    type="button" 
                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-primary transition-colors focus:outline-none" 
                    @click="show = !show"
                >
                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500 ml-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center ml-1">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <div class="relative">
                    <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-slate-300 text-primary shadow-sm focus:ring-primary/20 focus:ring-offset-0 transition-all cursor-pointer" name="remember">
                </div>
                <span class="ms-3 text-[11px] font-black text-slate-500 uppercase tracking-widest group-hover:text-slate-900 transition-colors">{{ __('Rester connecté') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="pt-2">
            <button type="submit" class="w-full py-4 bg-primary hover:bg-primary-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg shadow-primary/20 transition-all duration-300 transform active:scale-[0.98] focus:ring-4 focus:ring-primary/10">
                {{ __('Se connecter') }}
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-xs font-medium text-slate-400 italic">
                Réservé au personnel autorisé
            </p>
        </div>
    </form>
</x-guest-layout>
