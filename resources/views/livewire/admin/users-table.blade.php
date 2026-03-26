<div class="card mt-4">
    <div class="card-body">
        <div class="table-wrap">
            <div class="table-header">
                @include('admin.partials.table.header', [
                  'per_page' => true,
                  'search'   => true,
                  'create'   => [
                    'link'     => dashboard_route(config('admin.route_name_prefix').'users.create'),
                    'target'   => '_self',
                    'collapse' => false,
                  ]
                ])
            </div>
            <div class="table-responsive">
                <x-admin.data-table
                    :ajax-url="$ajaxUrl"
                    :columns="$dtColumns"
                    :fields="$dtFields"
                />
            </div>
        </div>
    </div>
</div>
