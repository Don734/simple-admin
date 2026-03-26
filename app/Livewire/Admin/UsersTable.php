<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class UsersTable extends Component
{
    public string $ajaxUrl;
    public string $dtColumns;
    public array $dtFields;

    public function mount(): void
    {
        $this->ajaxUrl = dashboard_route('admin.users.data');

        // dtFields — определение заголовков <thead>
        $this->dtFields = [
            'id'         => ['sortable' => false, 'name' => '#ID',   'class' => 'table-col-id'],
            'name'       => ['sortable' => false, 'name' => 'Name'],
            'email'      => ['sortable' => false, 'name' => 'Email'],
            'registered' => ['sortable' => false, 'name' => 'Registered'],
            'status'     => ['sortable' => false, 'name' => 'Status'],
            'actions'    => ['sortable' => false, 'name' => '',      'class' => 'no-sort table-col-actions'],
        ];

        // dtColumns — определение колонок DataTables (JSON для JS)
        // render: "html" — сентинел: JS прочитает это и вставит через innerHTML
        $this->dtColumns = json_encode([
            ['data' => 'id',         'name' => 'id'],
            ['data' => 'name',       'name' => 'name'],
            ['data' => 'email',      'name' => 'email'],
            ['data' => 'registered', 'name' => 'registered'],
            ['data' => 'status',     'name' => 'status',  'orderable' => false, 'searchable' => false, 'render' => 'html'],
            ['data' => 'actions',    'name' => 'actions', 'orderable' => false, 'searchable' => false, 'render' => 'html'],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.users-table');
    }
}
