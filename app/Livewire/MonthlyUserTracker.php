<?php

namespace App\Livewire;
use App\Models\Admin_Data\{CoopModel, BuyerModel};
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class MonthlyUserTracker extends Component
{
    public $monthlyUserCount = 0;

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $coop = CoopModel::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        $buyer = BuyerModel::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        $users = collect()
            ->merge($coop)
            ->merge($buyer);

        $this->monthlyUserCount = $users->count();
    }

    public function render()
    {
        return view('livewire.monthly-user-tracker');
    }
}
