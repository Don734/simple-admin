@extends('layouts.admin')

@section('title', 'Media')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Media',
        'list' => [
            [
                'name' => 'Media',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        @if ($media->count())
        <div class="row row-cols-1 row-cols-md-5">
            @foreach ($media as $item)
                <div class="col">
                    <div class="card card-media position-relative">
                        <div class="card-image">
                            <img src="{{ $item->getUrl() }}" class="object-fit-contain" alt="media">
                            <div class="btn-group position-absolute top-0 end-0 p-2" role="group">
                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        @can('manage_media')
                                        <form action="{{ dashboard_route(config("admin.route_name_prefix").'media.destroy', ['media'=>$item->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item btn-remove">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                        @endcan
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text small">
                                {{ $item->name }}
                                <span class="text-muted ms-1">({{ strtoupper($item->extension) }})</span>
                            </p>
                            <small class="text-muted d-block mt-1">
                                {{ $item->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $media->links() }}
        @else
            <div class="alert alert-info">No media files</div>
        @endif
    </div>
</div>
@endsection
