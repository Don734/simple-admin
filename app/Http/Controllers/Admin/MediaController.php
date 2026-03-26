<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('collection')) {
            $query->where('collection_name', $request->collection);
        }

        $media = $query->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.pages.media.list', compact('media'));
    }

    public function destroy(Media $media)
    {
        abort_unless(auth()->user()?->can('manage_media'), 403);
        if (!$media) {
            $this->alert("warning", "Media not found");
        }
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media deleted.');
    }
}
