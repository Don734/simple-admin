<div>
    @section('breadcrumb')
        @include('admin.partials.breadcrumb', [
            'title' => 'Settings',
            'list' => [
                [
                    'name' => 'Settings',
                    'current' => true
                ]
            ]
        ])
    @endsection
</div>