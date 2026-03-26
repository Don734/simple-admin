@extends('layouts.admin')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Users',
        'list' => [
            [
                'name' => 'Users',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<livewire:admin.users-table />
@endsection