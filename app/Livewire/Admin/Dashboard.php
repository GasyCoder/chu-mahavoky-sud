<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalServices;
    public $recentUsers;

    public function mount()
    {
        // Fetch some basic stats
        $this->totalUsers = User::count();
        $this->totalServices = Service::count();
        $this->recentUsers = User::latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
