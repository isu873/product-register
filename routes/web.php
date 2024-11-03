<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/import/csv', [\App\Http\Controllers\ProductController::class, 'importCsv'])->name('import.csv');

Route::get('feed.xml', function () {
    $xml = view('xml-feed', ['products' => \App\Models\Product::with('categories')->get()])->render();

    return response($xml)->withHeaders([
        'content-type' => 'text/xml'
    ]);
})->name("xml-feed");
