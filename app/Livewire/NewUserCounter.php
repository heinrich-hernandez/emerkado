<?php

namespace App\Livewire;
use App\Models\Admin_Data\{CoopModel, BuyerModel};
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class NewUserCounter extends Component
{
    public $newUserCount;

    public function mount()
    {
        $coop = CoopModel::where('created_at', '>=', Carbon::now()->subDays(30))->count(); // Get the count of CoopModel records created in the last 30 days
        $buyer = BuyerModel::where('created_at', '>=', Carbon::now()->subDays(30))->count(); // Get the count of BuyerModel records created in the last 30 days
        // Sum the counts to get the total user count for the last 30 days
        $this->newUserCount = $coop + $buyer; // Sum the counts to get the total user count
    }

    public function render()
    {
        return view('livewire.new-user-counter');
    }
}
