<?php

namespace App\Livewire;
use App\Models\Admin_Data\{CoopModel, BuyerModel};
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ForReviewCounter extends Component
{

    public $forReviewCounter;

    public function mount()
    {
        $coop = CoopModel::where('review_status', 'For Review')->count();
        $buyer = BuyerModel::where('review_status', 'For Review')->count();
        $this->forReviewCounter = $coop + $buyer; // Sum the counts to get the total user count
    }

    public function render()
    {
        return view('livewire.for-review-counter');
    }
}
