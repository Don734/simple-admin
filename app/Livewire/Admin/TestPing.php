<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class TestPing extends Component
{
    public int $count = 0;
    public string $lastAction = 'Not clicked yet';

    public function increment(): void
    {
        $this->count++;
        $this->lastAction = 'Clicked at ' . getDefaultFormat(now());
    }
    
    public function render()
    {
        return view('livewire.admin.test-ping');
    }
}
