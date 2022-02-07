<?php

namespace App\Http\Livewire\Backend\Dashboard;

use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        return view('livewire.backend.dashboard.dashboard-component', ['page_title' => 'Dashboard'])->layout('backend.layouts.app', ['page_title' => 'Dashboard']);
    }
}
