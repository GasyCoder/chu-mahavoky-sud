<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\BlogAdmin;
use App\Livewire\Admin\ServicesAdmin;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ServicesTechnique;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsDetailController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ServiceDetailController;

Route::get('/', HomeController::class)->name('home');
Route::get('/nos-medecins', HomeController::class)->name('doctors');

Route::get('/a-propos', AboutController::class)->name('about');
Route::get('/contact', [ContactController::class, '__invoke'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/nos-services', [ServicesController::class, 'index'])->name('services');
Route::get('/nos-services/{service}', [ServiceDetailController::class, 'show'])->name('services.show');

Route::get('/nos-actualites', [NewsController::class, 'index'])->name('news');
Route::get('/nos-actualites/{news}', [NewsDetailController::class, 'show'])->name('news.show');

use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\PartnerAdminController;

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', DashboardController::class)->name('admin.dashboard');

    // Services médicaux et administratifs via le même contrôleur
    Route::get('/admin/services/medical', function (\Illuminate\Http\Request $request) {
        return app(ServiceAdminController::class)->index($request, 'technical');
    })->name('admin.services.medical');

    Route::get('/admin/services/administration', function (\Illuminate\Http\Request $request) {
        return app(ServiceAdminController::class)->index($request, 'administrative');
    })->name('admin.services.administration');
    
    Route::post('/admin/services/store', [ServiceAdminController::class, 'store'])->name('admin.services.store');
    Route::delete('/admin/services/{service}', [ServiceAdminController::class, 'destroy'])->name('admin.services.destroy');

    Route::get('/admin/actualites', [NewsAdminController::class, 'index'])->name('admin.news');
    Route::post('/admin/actualites', [NewsAdminController::class, 'store'])->name('admin.news.store');
    Route::delete('/admin/actualites/{news}', [NewsAdminController::class, 'destroy'])->name('admin.news.destroy');

    Route::get('/admin/parametre', [SettingAdminController::class, 'index'])->name('admin.setting');
    Route::post('/admin/parametre/general', [SettingAdminController::class, 'updateGeneral'])->name('admin.settings.general');
    Route::post('/admin/parametre/contact', [SettingAdminController::class, 'updateContact'])->name('admin.settings.contact');
    Route::post('/admin/parametre/director', [SettingAdminController::class, 'updateDirector'])->name('admin.settings.director');
    Route::post('/admin/parametre/display', [SettingAdminController::class, 'updateDisplay'])->name('admin.settings.display');

    Route::get('/admin/parametre/display', [SettingAdminController::class, 'index'])->name('admin.settings.display'); // Added to fix redirect issue if any
    
    Route::get('/admin/partenaires', [PartnerAdminController::class, 'index'])->name('admin.partners');
    Route::post('/admin/partenaires', [PartnerAdminController::class, 'store'])->name('admin.partners.store');
    Route::post('/admin/partenaires/{partner}', [PartnerAdminController::class, 'update'])->name('admin.partners.update');
    Route::delete('/admin/partenaires/{partner}', [PartnerAdminController::class, 'destroy'])->name('admin.partners.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::redirect('/register', '/login');

require __DIR__ . '/auth.php';
