<?php

namespace App\Http\Livewire\Frontend\Dashboard;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UserDashboardCompoennt extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('livewire.frontend.dashboard.user-dashboard-compoennt', ['page_title' => 'Dashboard', 'orders' => $orders])->layout('frontend.layouts.app', ['page_title' => 'Dashboard']);
    }
}
