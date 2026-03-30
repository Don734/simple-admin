<div class="d-flex">
    <div class="col-12 col-md-9 d-flex align-items-center">
        @if (isset($per_page) && $per_page)
        <div class="showing-form">
            <label for="showing">Showing</label>
            <select class="form-control mx-2" id="showing">
                <option>5</option>
                <option selected>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <span>entries</span>
        </div>
        @endif
        @if (isset($search) && $search)
        <div class="search-form">
            <input class="form-control" type="text" placeholder="Search here..." id="search">
            <span class="icon"><i class="bi bi-search"></i></span>
        </div>
        @endif
    </div>
    <div class="col-12 col-md-3">
        @if (isset($create) && $create)
        <a href="{{ $create['link'] }}" class="btn btn-lg btn-add ms-auto" wire:navigate>
            <span class="icon"><i class="bi bi-plus-lg"></i></span> Add
        </a>
        @endif
    </div>
</div>