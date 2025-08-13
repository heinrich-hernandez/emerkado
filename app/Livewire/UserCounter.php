<?php

namespace App\Livewire;
use App\Models\Admin_Data\{CoopModel, BuyerModel};
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserCounter extends Component
{
    public $userCount;

    public function mount()
    {
        $coop = CoopModel::count(); // Get the count of CoopModel records
        $buyer = BuyerModel::count(); // Get the count of BuyerModel records
        $this->userCount = $coop + $buyer; // Sum the counts to get the total user count
    }

    public function render()
    {
        return view('livewire.user-counter');
    }
}
