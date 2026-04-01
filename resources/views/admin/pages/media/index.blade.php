<div>
    @section('breadcrumb')
        @include('admin.partials.breadcrumb', [
            'title' => 'Media',
            'list' => [
                ['name' => 'Media', 'current' => true]
            ]
        ])
    @endsection

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <div style="min-width: 260px;">
                    <label for="collection" class="form-label mb-1">Collection</label>
                    <select id="collection" class="form-select" wire:model.live="collection">
                        <option value="">All collections</option>
                        @foreach ($collections as $collectionName)
                            <option value="{{ $collectionName }}">{{ $collectionName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($media->count())
                <div class="row row-cols-1 row-cols-md-5 g-3">
                    @foreach ($media as $item)
                        <div class="col">
                            <div class="card card-media position-relative">
                                <div class="card-image">
                                    <img src="{{ $item->getUrl() }}" class="object-fit-contain" alt="media">
                                    <div class="btn-group position-absolute top-0 end-0 p-2" role="group" x-data="{ open: false }">
                                        <button type="button" class="btn btn-sm btn-secondary" @click="open = !open">
                                            <i class="bi bi-chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" x-show="open" @click.outside="open = false" style="display:none;">
                                            <li>
                                                @can('manage_media')
                                                    <form action="{{ route('admin.media.destroy', ['media' => $item->id]) }}" method="POST" style="display:inline;">
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
                                    <p class="card-text small mb-1">
                                        {{ $item->name }}
                                        <span class="text-muted ms-1">({{ strtoupper($item->extension) }})</span>
                                    </p>
                                    <small class="text-muted d-block">{{ $item->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $media->links() }}
                </div>
            @else
                <div class="alert alert-info">No media files</div>
            @endif
        </div>
    </div>
</div>
