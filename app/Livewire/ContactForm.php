<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContactFormNotification;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;
    public $privacy = false;

    public $successMessage = '';

    // Règles de validation
    protected $rules = [
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'phone' => 'nullable|string|max:20',
        'subject' => 'required|string|max:100',
        'message' => 'required|string|max:2000',
        'privacy' => 'accepted',
    ];

    protected $messages = [
        'name.required' => 'Le nom est obligatoire',
        'email.required' => 'L\'email est obligatoire',
        'email.email' => 'Veuillez saisir une adresse email valide',
        'subject.required' => 'Le sujet est obligatoire',
        'message.required' => 'Le message est obligatoire',
        'privacy.accepted' => 'Vous devez accepter la politique de confidentialité',
    ];

    public function submitForm()
    {
        $this->validate();

        // Récupérer l'email de contact depuis les paramètres
        $contactEmail = Setting::get('contact_email', 'contact@chu-mahavokyatsimo.mg');

        // Préparation des données pour la notification
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ];

        // Envoyer la notification
        Notification::route('mail', $contactEmail)
            ->notify(new ContactFormNotification($data));

        // Message de succès
        $this->successMessage = 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.';

        // Réinitialisation du formulaire
        $this->reset([]);
    }

    public function render()
    {
        return view('livewire.contact-form')->layout('layouts.front');
    }
}
