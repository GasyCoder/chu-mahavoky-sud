<?php

namespace App\Livewire\Pages;

use App\Models\Service;
use Livewire\Component;

class ServiceDetail extends Component
{
    public Service $service;

    // Propriétés pour l'affichage optimisé
    public $formattedTeamMembers = [];
    public $relatedServices = [];

    public function mount(Service $service)
    {
        $this->service = $service;

        // Traiter les membres de l'équipe avec gestion des images
        $this->processTeamMembers();

        // Récupérer des services associés de la même catégorie
        $this->loadRelatedServices();
    }

    /**
     * Traiter les membres de l'équipe pour ajouter des données supplémentaires
     */
    protected function processTeamMembers()
    {
        if (!$this->service->team_members || !is_array($this->service->team_members)) {
            $this->formattedTeamMembers = [];
            return;
        }

        $this->formattedTeamMembers = collect($this->service->team_members)
            ->map(function($member, $index) {
                // Format 1: Simple chaîne de caractères (nom seulement)
                if (is_string($member)) {
                    return [
                        'name' => $member,
                        'role' => $index === 0 ? 'Responsable du service' : 'Membre de l\'équipe',
                        'avatar' => null,
                        'isLead' => $index === 0,
                    ];
                }

                // Format 2: Tableau avec plus d'informations (nom, rôle, avatar)
                if (is_array($member) && isset($member['name'])) {
                    return [
                        'name' => $member['name'],
                        'role' => $member['role'] ?? ($index === 0 ? 'Responsable du service' : 'Membre de l\'équipe'),
                        'avatar' => $member['avatar'] ?? null,
                        'isLead' => $member['isLead'] ?? ($index === 0),
                    ];
                }

                // Format 3: Objet (pour compatibilité future)
                if (is_object($member) && isset($member->name)) {
                    return [
                        'name' => $member->name,
                        'role' => $member->role ?? ($index === 0 ? 'Responsable du service' : 'Membre de l\'équipe'),
                        'avatar' => $member->avatar ?? null,
                        'isLead' => $member->isLead ?? ($index === 0),
                    ];
                }

                // Format par défaut si aucun des formats ci-dessus ne correspond
                return [
                    'name' => is_string($member) ? $member : 'Personnel médical',
                    'role' => 'Membre de l\'équipe',
                    'avatar' => null,
                    'isLead' => false,
                ];
            })
            ->toArray();
    }

    /**
     * Charger les services associés (même catégorie)
     */
    protected function loadRelatedServices()
    {
        // Récupérer quelques services de la même catégorie (limité à 3)
        $this->relatedServices = Service::where('category_id', $this->service->category_id)
            ->where('id', '!=', $this->service->id) // Exclure le service actuel
            ->where('active', true)
            ->orderBy('order')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.service-detail', [
            'service' => $this->service,
            'formattedTeamMembers' => $this->formattedTeamMembers,
            'relatedServices' => $this->relatedServices
        ])->layout('layouts.front');
    }
}
