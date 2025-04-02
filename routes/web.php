<?php

use App\Livewire\HomePage;
use App\Livewire\Pages\News;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Contact;
use App\Livewire\Admin\Settings;
use App\Livewire\Pages\Services;
use App\Livewire\Admin\BlogAdmin;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Pages\NewsDetail;
use App\Livewire\Admin\ServicesAdmin;
use App\Livewire\Admin\MedicalServicesAdmin;
use App\Livewire\Admin\AdministrationServicesAdmin;
use App\Livewire\Pages\ServiceDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', HomePage::class)->name('home');

Route::get('/a-propos', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');

Route::get('/nos-services', Services::class)->name('services');
Route::get('/nos-services/{service}', ServiceDetail::class)->name('services.show');

Route::get('/nos-actualites', News::class)->name('news');
Route::get('/nos-actualites/{news}', NewsDetail::class)->name('news.show');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');

    // Services généraux (redirection vers la page d'aperçu des services)
    Route::get('/admin/services', ServicesAdmin::class)->name('admin.services');
    
    // Services médicaux
    Route::get('/admin/services/medical', MedicalServicesAdmin::class)->name('admin.services.medical');
    
    // Services administratifs
    Route::get('/admin/services/administration', AdministrationServicesAdmin::class)->name('admin.services.administration');

    Route::get('/admin/actualites', BlogAdmin::class)->name('admin.news');

    Route::get('/admin/parametre', Settings::class)->name('admin.setting');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::redirect('/register', '/login');

require __DIR__.'/auth.php';