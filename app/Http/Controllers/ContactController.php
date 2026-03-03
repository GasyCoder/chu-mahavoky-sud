<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactFormNotification;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function __invoke()
    {
        $settings = Setting::allSettings();

        return Inertia::render('Contact', [
            'settings' => $settings,
        ]);
    }

    public function submit(ContactFormRequest $request)
    {
        try {
            $contactEmail = Setting::get('contact_email', 'contact@chu-mahavokyatsimo.mg');

            $data = $request->validated();

            Notification::route('mail', $contactEmail)
                ->notify(new ContactFormNotification($data));

            return back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi du formulaire de contact: ' . $e->getMessage());

            return back()->with('error', 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer plus tard.');
        }
    }
}
