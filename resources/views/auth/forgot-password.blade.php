<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Récupération</h2>
        <p class="text-slate-500 mt-2 font-medium">Réinitialisez votre mot de passe</p>
    </div>

    <div class="mb-8 text-sm text-slate-500 leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-100">
        {{ __('Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous votre adresse e-mail et nous vous enverrons un lien de réinitialisation.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-2xl text-sm font-medium" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                    placeholder="votre@email.com"
                />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500 ml-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-4 bg-primary hover:bg-primary-600 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg shadow-primary/20 transition-all duration-300 transform active:scale-[0.98] focus:ring-4 focus:ring-primary/10">
                {{ __('Envoyer le lien') }}
            </button>
        </div>

        <div class="text-center mt-6">
            <a class="text-xs font-black text-primary uppercase tracking-widest hover:text-primary/70 transition-colors" href="{{ route('login') }}">
                Retour à la connexion
            </a>
        </div>
    </form>
</x-guest-layout>
