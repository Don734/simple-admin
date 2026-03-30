<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Sign In')]
class Login extends Component
{
    public function render()
    {
        return view('admin.pages.auth.login');
    }
}
