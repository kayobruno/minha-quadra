<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

class UploadService
{
    public function upload(Request $request, string $path, string $fileField): string
    {
        if (!$request->file('image')) {
            return '';
        }

        return $request->file($fileField)->store($path);
    }
}
