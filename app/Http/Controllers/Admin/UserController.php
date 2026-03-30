<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function data(Request $request)
    {
        $draw = (int) $request->input('draw', 1);
        $start = max((int) $request->input('start', 0), 0);
        $length = (int) $request->input('length', 10);
        $length = $length > 0 ? min($length, 100) : 10;

        $searchValue = trim((string) $request->input('search.value', ''));
        $orderColumnIndex = (int) $request->input('order.0.column', 0);
        $orderDirection = strtolower((string) $request->input('order.0.dir', 'desc')) === 'asc' ? 'asc' : 'desc';
        $orderColumns = [
            0 => 'id',
            1 => 'first_name',
            2 => 'last_name',
            3 => 'email',
            4 => 'created_at',
            5 => 'is_active',
        ];
        $orderColumn = $orderColumns[$orderColumnIndex] ?? 'id';

        $query = User::query();
        $recordsTotal = User::count();

        if ($searchValue !== '') {
            $query->where(function ($builder) use ($searchValue) {
                $builder
                    ->where('first_name', 'like', "%{$searchValue}%")
                    ->orWhere('last_name', 'like', "%{$searchValue}%")
                    ->orWhere('email', 'like', "%{$searchValue}%")
                    ->orWhere('id', 'like', "%{$searchValue}%");
            });
        }

        $recordsFiltered = (clone $query)->count();

        $users = $query
            ->orderBy($orderColumn, $orderDirection)
            ->skip($start)
            ->take($length)
            ->get();

        $data = $users->map(function (User $user) {
            $statusClass = $user->is_active ? 'success' : 'danger';
            $statusLabel = $user->is_active ? 'Active' : 'Inactive';

            return [
                'id' => '#'.$user->id,
                'name' => $user->fullName,
                'email' => e($user->email),
                'registered' => getDefaultFormat($user->created_at),
                'status' => '<span class="badge bg-'.$statusClass.'">'.$statusLabel.'</span>',
                'actions' => view('admin.partials.table.actions', [
                    'item' => $user,
                    'edit_route' => dashboard_route('admin.users.edit', ['user' => $user->id]),
                    'destroy_route' => dashboard_route('admin.users.destroy', ['user' => $user->id]),
                    'edit_permission' => 'update_users',
                    'delete_permission' => 'delete_users',
                ])->render(),
            ];
        });

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = User::create($this->getMassUpdateFields($request));
        if ($request->has('role')) {
            $user->assignRole($request->input('role'));
        }
        if ($request->hasFile('image')) {
            dd($request->file('image'));
        }
        $this->alert("success", "User has been added");
        return redirect(dashboard_route('admin.users.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        if (!$user) {
            $this->alert("warning", 'User not found');
        }
        $user->update($this->getMassUpdateFields($request));
        if ($request->has('role')) {
            $user->syncRoles([$request->input('role')]);
        }
        if ($request->hasFile('image')) {
            dd($request->file('image'));
        }
        $this->alert("success", "User has been edited");
        return redirect(dashboard_route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user) {
            alert("warning", 'User not found');
        }
        $user->delete();
        $this->alert("success", "User has been deleted");
        return redirect(dashboard_route('admin.users.index'));
    }

    private function getMassUpdateFields($request)
    {
        return array_merge(
            $request->only(['first_name', 'last_name', 'phone', 'email', 'about', 'is_active']),
            [
                'password' => Hash::make($request->input('password')),
                'is_active' => $request->filled('is_active') == 'on',
            ]
        );
    }
}
