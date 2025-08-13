<?php

namespace App\Livewire;
use App\Models\Admin_Data\{CoopModel, BuyerModel};
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InProgressCounter extends Component
{

    public $inProgressCounter;

    public function mount()
    {
        $coop = CoopModel::where('review_status', 'In Progress')->count();
        $buyer = BuyerModel::where('review_status', 'In Progress')->count();
        $this->inProgressCounter = $coop + $buyer; // Sum the counts to get the total user count
    }

    public function render()
    {
        return view('livewire.in-progress-counter');
    }
}
