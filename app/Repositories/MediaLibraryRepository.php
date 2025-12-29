<?php

namespace App\Repositories;

use App\Models\MediaLibrary;
use App\Traits\ImageTrait;
use Carbon\Carbon;

class MediaLibraryRepository
{
    use ImageTrait;

    public function all($data = [])
    {
        return MediaLibrary::with('user')->when(arrayCheck('type', $data), function ($query) use ($data) {
            $query->where('type', $data['type']);
        })->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('name', 'LIKE', '%'.$data['q'].'%');
        })->when(arrayCheck('user_id', $data), function ($query) use ($data) {
            $query->where('user_id', $data['user_id']);
        })->when(arrayCheck('start_date', $data) && arrayCheck('end_date', $data), function ($query) use ($data) {
            $query->whereBetween('created_at', [Carbon::parse($data['start_date'])->format('Y-m-d H:i:s'), Carbon::parse($data['end_date'])->format('Y-m-d').' 23:59:59']);
        })->latest()->paginate($data['paginate']);
    }

    public function find($id)
    {
        return MediaLibrary::find($id);
    }

    public function delete($id): bool
    {
        $medias = MediaLibrary::whereIn('id', $id)->get();
        foreach ($medias as $media) {
            if ($media->type == 'image') {
                $this->deleteImage($media->image_variants, $media->storage);
            }

            $this->deleteFile($media->original_file, $media->storage);
            $media->delete();
        }

        return true;
    }
}
