<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function destroy(Media $media)
    {
        abort_unless(Gate::allows('manage_media'), 403);
        if (!$media) {
            $this->alert("warning", "Media not found");
        }
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media deleted.');
    }
}
