<?php

namespace App\Livewire\Admin\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin')]
#[Title('Profile')]
class Index extends Component
{
    public function render()
    {
        $user = User::query()->with('roles')->find(Auth::id());
        $role = (string) data_get($user, 'roles.0.name', '');

        return view('admin.pages.profile', [
            'name' => $user?->name,
            'email' => $user?->email,
            'phone' => $user?->phone,
            'about' => $user?->about,
            'role' => $role,
        ]);
    }
}
