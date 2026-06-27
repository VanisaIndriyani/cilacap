<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Uploads
{
    public static function storeOne(?UploadedFile $file, string $directory): ?string
    {
        if (! $file) {
            return null;
        }

        return $file->store($directory, 'public');
    }

    public static function storeMany(array $files, string $directory): array
    {
        return collect($files)
            ->filter()
            ->map(function (UploadedFile $file) use ($directory) {
                return $file->store($directory, 'public');
            })
            ->values()
            ->all();
    }

    public static function deleteMany(array $paths): void
    {
        $paths = collect($paths)
            ->filter(fn ($p) => is_string($p) && $p !== '')
            ->values()
            ->all();

        if ($paths === []) {
            return;
        }

        Storage::disk('public')->delete($paths);
    }

    public static function normalizeStringList(?string $value): array
    {
        return collect(preg_split('/[\r\n,]+/', (string) $value))
            ->map(fn ($v) => trim((string) $v))
            ->filter()
            ->values()
            ->all();
    }
}

