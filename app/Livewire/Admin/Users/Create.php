<?php

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin')]
#[Title('Create User')]
class Create extends Component
{
    public function render()
    {
        return view('admin.pages.users.create', [
            'roles' => Role::query()->pluck('name'),
        ]);
    }
}
