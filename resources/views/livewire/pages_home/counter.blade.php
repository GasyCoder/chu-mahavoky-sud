<!-- Section statistiques - Design moderne avec animations -->
<div class="relative z-10 flex items-center h-full pb-10 text-white">
    <div class="container px-4 -mt-10 sm:px-4 sm:-mt-16 md:-mt-20">
        <div class="w-full">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                <!-- Stat 1 - Medecins avec design ameliore -->
                <div class="group bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-6 md:p-7 flex items-center gap-5 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-md group-hover:blur-lg transition-all duration-300"></div>
                            <div class="relative flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                <i class="fa fa-user-md text-2xl md:text-3xl text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-baseline gap-1">
                            <span id="value1" class="text-3xl md:text-4xl font-extrabold text-dark counter" data-count="47" data-suffix="">0</span>
                            <span class="text-2xl md:text-3xl font-bold text-primary">+</span>
                        </div>
                        <h5 class="text-sm font-semibold text-dark mt-1">Medecins specialistes</h5>
                        <p class="text-gray-500 text-xs mt-0.5">Une equipe medicale qualifiee</p>
                    </div>
                </div>

                <!-- Stat 2 - Patients avec design ameliore -->
                <div class="group bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-6 md:p-7 flex items-center gap-5 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="absolute inset-0 bg-green-500/20 rounded-2xl blur-md group-hover:blur-lg transition-all duration-300"></div>
                            <div class="relative flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                <i class="fa fa-procedures text-2xl md:text-3xl text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-baseline gap-1">
                            <span id="value2" class="text-3xl md:text-4xl font-extrabold text-dark counter" data-count="15" data-suffix="k">0</span>
                            <span class="text-2xl md:text-3xl font-bold text-green-500">k+</span>
                        </div>
                        <h5 class="text-sm font-semibold text-dark mt-1">Patients satisfaits</h5>
                        <p class="text-gray-500 text-xs mt-0.5">Des soins de qualite pour tous</p>
                    </div>
                </div>

                <!-- Stat 3 - Services avec design ameliore -->
                <div class="group bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-6 md:p-7 flex items-center gap-5 hover:shadow-2xl hover:shadow-primary/20 hover:-translate-y-1 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="absolute inset-0 bg-purple-500/20 rounded-2xl blur-md group-hover:blur-lg transition-all duration-300"></div>
                            <div class="relative flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                <i class="fa fa-stethoscope text-2xl md:text-3xl text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl md:text-4xl font-extrabold text-dark counter" data-count="{{ \App\Models\Service::count() }}" data-suffix="">{{ \App\Models\Service::count() }}</span>
                        </div>
                        <h5 class="text-sm font-semibold text-dark mt-1">Services</h5>
                        <p class="text-gray-500 text-xs mt-0.5">Departements et services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
