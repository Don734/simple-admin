<?php

namespace App\Livewire\Admin\Media;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[Layout('layouts.admin')]
#[Title('Media')]
class Index extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public string $collection = '';

    public function updatingCollection(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $media = Media::query()
            ->when($this->collection !== '', fn ($q) => $q->where('collection_name', $this->collection))
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        $collections = Media::query()
            ->select('collection_name')
            ->distinct()
            ->orderBy('collection_name')
            ->pluck('collection_name');

        return view('admin.pages.media.index', [
            'media' => $media,
            'collections' => $collections,
        ]);
    }
}
