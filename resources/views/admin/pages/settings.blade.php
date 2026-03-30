<div>
    @push('breadcrumb')
        @include('admin.partials.breadcrumb', [
            'title' => 'Settings',
            'list' => [
                [
                    'name' => 'Settings',
                    'current' => true
                ]
            ]
        ])
    @endpush
</div>