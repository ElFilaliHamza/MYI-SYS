<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PropertyDetails extends Component
{
    public $beds_count = 1;
    public $baths_count = 1;

    public function incrementBeds()
    {
        $this->beds_count++;
    }

    public function decrementBeds()
    {
        if ($this->beds_count > 0) {
            $this->beds_count--;
        }
    }

    public function incrementBaths()
    {
        $this->baths_count++;
    }

    public function decrementBaths()
    {
        if ($this->baths_count > 0) {
            $this->baths_count--;
        }
    }
    public function render()
    {
        return view('livewire.components.property-details');
    }
}
