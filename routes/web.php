<?php

use App\Http\Controllers\ContentPageController;
use App\Http\Controllers\BookingEnquiryController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\LegacyRedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/booking-enquiries/', [BookingEnquiryController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('booking-enquiries.store');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

Route::get('/about/', [ContentPageController::class, 'show'])
    ->defaults('pageKey', 'about')
    ->name('about');

Route::get('/our-standards/', [ContentPageController::class, 'show'])
    ->defaults('pageKey', 'our-standards')
    ->name('our-standards');

Route::get('/bus-hire/', [ContentPageController::class, 'show'])
    ->defaults('pageKey', 'bus-hire')
    ->name('bus-hire');

Route::get('/urbania/', [ContentPageController::class, 'show'])
    ->defaults('pageKey', 'urbania')
    ->name('urbania');

Route::get('/tempo-traveller-hire/', [ContentPageController::class, 'show'])
    ->defaults('pageKey', 'tempo-traveller-hire')
    ->name('tempo-traveller-hire');

Route::get('/faqs/', [ContentPageController::class, 'faqs'])
    ->name('faqs');

Route::get('/contact/', [ContentPageController::class, 'contact'])
    ->name('contact');

Route::get('/hello-world/', [ContentPageController::class, 'article'])
    ->name('article.mumbai-sightseeing');

Route::fallback(LegacyRedirectController::class)->name('legacy.redirect');
