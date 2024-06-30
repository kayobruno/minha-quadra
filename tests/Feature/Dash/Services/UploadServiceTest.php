<?php

declare(strict_types=1);

use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

describe('uploads', function () {
    it('may upload images', function () {
        $file = UploadedFile::fake()->image('product.jpg');
        $request = Request::create(uri: '/upload', files: ['image' => $file]);

        $uploadService = new UploadService();
        $uploadedFilePath = $uploadService->upload($request, 'uploads', 'image');

        expect(Storage::disk('local')->exists($uploadedFilePath))->toBeTrue();
    });

    it('may return empty when does not have files', function () {
        $request = Request::create(uri: '/upload');

        $uploadService = new UploadService();
        $uploadedFilePath = $uploadService->upload($request, 'uploads', 'image');

        expect($uploadedFilePath)->toBeEmpty();
    });
});
