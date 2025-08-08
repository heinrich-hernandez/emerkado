<?php

namespace App\Livewire;
use Carbon\Carbon;
use App\Models\Admin_Data\CoopModel;
use Illuminate\Support\Collection;
use Livewire\Component;

class UnapprovedCoopUserTracker extends Component
{
    public $unapprovedCoopCount = 0;

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->unapprovedCoopCount = CoopModel::whereIn('review_status', ['In Progress', 'For Review'])->count();
    }

    public function render()
    {
        return view('livewire.unapproved-coop-user-tracker');
    }
}
