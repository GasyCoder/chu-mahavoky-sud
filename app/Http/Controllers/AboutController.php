<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function __invoke()
    {
        $settings = Setting::allSettings();

        return Inertia::render('About', [
            'settings' => $settings,
        ]);
    }
}
