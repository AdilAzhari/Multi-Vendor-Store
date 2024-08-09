<?php

namespace App\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class ImageService
{
    /**
     * Create a new class instance.
     */
    public function store(UploadedFile $file, string $path): string
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs("public/$path", $filename);
        return $filename;
    }

    public function update(UploadedFile $file, string $path, ?string $oldFilename = null): string
    {
        if ($oldFilename) {
            $this->delete($oldFilename, $path);
        }
        return $this->store($file, $path);
    }

    public function delete(?string $filename, string $path): bool
    {
        if (!$filename) {
            return false;
        }
        return Storage::delete("public/$path/$filename");
    }

    public function getUrl(string $path, string $filename): string
    {
        return Storage::url("$path/$filename");
    }
}
