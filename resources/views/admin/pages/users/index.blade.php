<div>
    @section('breadcrumb')
        @include('admin.partials.breadcrumb', [
            'title' => 'Users',
            'list' => [['name' => 'Users', 'current' => true]]
        ])
    @endsection

    @php
        $dtColumns = json_encode([
            ['data' => 'id',         'name' => 'id',         'orderable' => true,  'searchable' => false],
            ['data' => 'name',       'name' => 'name',       'orderable' => true,  'searchable' => true],
            ['data' => 'email',      'name' => 'email',      'orderable' => true,  'searchable' => true],
            ['data' => 'registered', 'name' => 'created_at', 'orderable' => true,  'searchable' => false],
            ['data' => 'status',     'name' => 'is_active',  'orderable' => true,  'searchable' => false],
            ['data' => 'actions',    'name' => 'actions',    'orderable' => false, 'searchable' => false],
        ]);
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="table-wrap">
                <div class="table-header">
                    @include('admin.partials.table.header', [
                      'per_page' => true,
                      'search' => true,
                      'create' => [
                        'link' => route('admin.users.create'),
                        'target' => '_self',
                        'collapse' => false
                      ]
                    ])
                </div>
                <div class="table-responsive">
                    <table
                        class="table table-borderless data-table"
                        data-datatable="true"
                        data-ajax-url="{{ route('admin.users.data') }}"
                        data-search-input=".search-form #search"
                        data-length-select=".showing-form #showing"
                        data-order='@json([[0, "desc"]])'
                        data-columns="{{ $dtColumns }}"
                    >
                        @include('admin.partials.table.head',[
                            'fields'=>[
                                'id'=>['sortable'=>false,"name"=>"#ID",'class'=>'table-col-id'],
                                'name'=>['sortable'=>false,"name"=>"Name"],
                                'email'=>['sortable'=>false,"name"=>"Email"],
                                'registered'=>['sortable'=>false,"name"=>"Registered"],
                                'status'=>['sortable'=>false,"name"=>"Status"],
                                'actions'=>['sortable'=>false,"name"=>"",'class'=>'no-sort table-col-actions'],
                            ]
                        ])
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>