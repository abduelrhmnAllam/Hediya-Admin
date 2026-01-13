<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-upload', function () {
    Storage::disk('public')->put('test.txt', 'hello');
    return 'done';
});

Route::get('/media/{path}', function ($path) {
    $fullPath = 'E:/hediya/storage/app/public/' . $path;

    if (! File::exists($fullPath)) {
        abort(404);
    }

    return Response::file($fullPath);
})->where('path', '.*');



Route::get('/test-admitad-me', function () {
    return app(\App\Services\AdmitadService::class)->me();
});

Route::get('/test-admitad-balance', function () {
    return app(\App\Services\AdmitadService::class)->balanceExtended();
});


Route::get('/test-admitad-daily', function () {
    return app(\App\Services\AdmitadService::class)->daily([
        'date_start' => now()->subDays(700)->format('d.m.Y'),
        'date_end'   => now()->format('d.m.Y'),
        'limit'      => 10,
    ]);
});

Route::get('/test-admitad-campaigns', function () {
    return app(\App\Services\AdmitadService::class)->campaigns([
        'date_start' => now()->subDays(300)->format('d.m.Y'),
        'limit' => 5,
        'order_by' => '-payment_sum',
    ]);
});


Route::get('/test-admitad-actions', function () {
    return app(\App\Services\AdmitadService::class)->actions([
        'date_start' => now()->subDays(2000)->format('d.m.Y'),
        'limit' => 5,
    ]);
});

Route::get('/debug-admitad', function () {
    return [
        'env_client_id' => env('ADMITAD_CLIENT_ID'),
        'config_client_id' => config('services.admitad.client_id'),
        'env_base64' => env('ADMITAD_BASE64_HEADER'),
    ];
});
