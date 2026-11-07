<?php

use App\Http\Controllers\GenshinImpactController;
use Illuminate\Support\Facades\Route;


Route::get('/whoami', function () {
    return 'John Cedric P. Taopo | 2023-70351 | Block 4C | ITRACKB4 Laravel 12';
});

Route::get('/characters/filter/{element?}', function (?string $element = null) {
    if ($element === null || $element === '') {
        return redirect()->route('characters.index');
    }

    return redirect()->route('characters.index', [
        'element' => $element,
    ]);
})->name('characters.filter');

Route::get('/characters/featured', [GenshinImpactController::class, 'featured'])
    ->name('characters.featured');

Route::resource('characters', GenshinImpactController::class)
    ->whereNumber('character');