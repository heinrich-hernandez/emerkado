<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $count = 0; // This property holds the notification count.

    protected $listeners = ['incrementCount']; // This sets up a listener for the 'incrementCount' event.

    public function incrementCount()
    {
        $this->count++; // This method increments the notification count.
    }

    public function mount()
    {
        // Start the timer to increment the count
        $this->dispatch('start-notification-timer'); // This dispatches a browser event to start the timer.
    }

    public function render()
    {
        return view('livewire.notification'); // This renders the view for the component.
    }
}
