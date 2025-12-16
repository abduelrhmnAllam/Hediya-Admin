<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Storage;

Route::get('/test-upload', function () {
    Storage::disk('public')->put('test.txt', 'hello');
    return 'done';
});

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

Route::get('/media/{path}', function ($path) {
    $fullPath = 'E:/hediya/storage/app/public/' . $path;

    if (! File::exists($fullPath)) {
        abort(404);
    }

    return Response::file($fullPath);
})->where('path', '.*');
