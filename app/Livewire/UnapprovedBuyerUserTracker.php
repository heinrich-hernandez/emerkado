<?php

namespace App\Livewire;
use Carbon\Carbon;
use App\Models\Admin_Data\BuyerModel;
use Illuminate\Support\Collection;
use Livewire\Component;

class UnapprovedBuyerUserTracker extends Component
{
    public $unapprovedBuyerCount = 0;

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->unapprovedBuyerCount = BuyerModel::whereIn('review_status', ['In Progress', 'For Review'])->count();
    }

    public function render()
    {
        return view('livewire.unapproved-buyer-user-tracker');
    }
}
