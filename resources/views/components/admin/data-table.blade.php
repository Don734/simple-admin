@props([
    'ajaxUrl',
    'columns',          // JSON string — массив DT column definitions
    'fields',           // array — определения колонок для <thead>
    'order'  => [[0, 'desc']],
    'searchWrap'  => '.search-form',
    'searchInput' => '#search',
    'lengthWrap'  => '.showing-form',
    'lengthSelect' => '#showing',
])

{{--
    wire:ignore — Livewire не будет трогать внутренний DOM при морфинге.
    Это обязательно, когда DataTables управляет <tbody> самостоятельно.
--}}
<div wire:ignore>
    <table
        class="table table-borderless data-table"
        data-datatable="true"
        data-ajax-url="{{ $ajaxUrl }}"
        data-search-input="{{ $searchWrap }} {{ $searchInput }}"
        data-length-select="{{ $lengthWrap }} {{ $lengthSelect }}"
        data-order="{{ json_encode($order) }}"
        data-columns="{{ $columns }}"
    >
        @include('admin.partials.table.head', ['fields' => $fields])
        <tbody></tbody>
    </table>
</div>
