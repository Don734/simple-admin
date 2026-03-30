<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin')]
#[Title('Edit User')]
class Edit extends Component
{
    public User $item;

    public function mount(User $user): void
    {
        $this->item = $user;
    }

    public function render()
    {
        return view('admin.pages.users.edit', [
            'user_role' => $this->item->getRoleNames()->first(),
            'roles' => Role::query()->pluck('name'),
        ]);
    }
}
