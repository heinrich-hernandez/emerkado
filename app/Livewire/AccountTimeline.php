<?php

namespace App\Livewire;

use App\Models\Admin_Data\{CoopModel, BuyerModel};
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class AccountTimeline extends Component
{
    public $users;
    public $currentPage = 1;
    public $perPage = 10;

    public function mount()
    {
        $coop = CoopModel::select('user_id', 'authorized_representative as name', 'created_at', 'review_status', 'reviewed_by')
            ->get();

        $buyer = BuyerModel::select('user_id', 'name', 'created_at', 'review_status', 'reviewed_by')
            ->get();
            
        $this->users = $coop->concat($buyer)
            ->sortByDesc('created_at')
            ->map(function ($user) {
                return (object) [
                    'user_id' => $user->user_id,
                    'name' => $user->name,
                    'created_at' => $user->created_at,
                    'review_status' => $user->review_status,
                    'reviewed_by' => $user->reviewed_by,
                    'profile_picture' => $user->profile_picture ?? null,
                    'valid_id_picture' => $user->valid_id_picture ?? null,
                ];
            });
    }

    public function render()
    {
        // Paginate manually
        return view('livewire.account-timeline', [
            'users' => $this->users,
            'user_ids' => $this->users->pluck('user_id')->unique(),
            'created_at' => $this->users->pluck('created_at'),
            'review_status' => $this->users->pluck('review_status'),
            'reviewed_by' => $this->users->pluck('reviewed_by'),
            'profile_pictures' => $this->users->pluck('profile_picture'),
            'valid_id_pictures' => $this->users->pluck('valid_id_picture'),
        ]);
    }
}