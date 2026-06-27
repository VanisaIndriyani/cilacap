<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AccommodationController as AdminAccommodationController;
use App\Http\Controllers\Admin\CulinaryController as AdminCulinaryController;
use App\Http\Controllers\Admin\CultureController as AdminCultureController;
use App\Http\Controllers\Admin\DestinationCategoryController as AdminDestinationCategoryController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\TripItineraryItemController as AdminTripItineraryItemController;
use App\Http\Controllers\Admin\TripPackageController as AdminTripPackageController;
use App\Http\Controllers\Admin\VisitorLogController as AdminVisitorLogController;
use App\Http\Controllers\Admin\WebsiteSettingController as AdminWebsiteSettingController;
use App\Http\Controllers\CulinaryController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TripPlannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/jelajah-cilacap', [TripPlannerController::class, 'recommend'])
    ->name('trip-planner.recommend');

Route::get('/destinasi-wisata', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinasi-wisata/{destination}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/kuliner-khas-cilacap', [CulinaryController::class, 'index'])->name('culinaries.index');
Route::get('/kuliner-caffe-cilacap', [CulinaryController::class, 'cafes'])->name('culinary-cafes.index');
Route::get('/kuliner-khas-cilacap/{culinary}', [CulinaryController::class, 'show'])->name('culinaries.show');

Route::get('/tempat-penginapan', [AccommodationController::class, 'index'])->name('accommodations.index');
Route::get('/tempat-penginapan/{accommodation}', [AccommodationController::class, 'show'])->name('accommodations.show');

Route::get('/budaya-cilacap', [CultureController::class, 'index'])->name('cultures.index');
Route::get('/budaya-cilacap/{culture}', [CultureController::class, 'show'])->name('cultures.show');

Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonials.store');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('destination-categories', AdminDestinationCategoryController::class)
            ->names('admin.destination-categories')
            ->except(['show']);

        Route::resource('destinations', AdminDestinationController::class)
            ->names('admin.destinations')
            ->except(['show']);

        Route::resource('culinaries', AdminCulinaryController::class)
            ->names('admin.culinaries')
            ->except(['show']);

        Route::resource('accommodations', AdminAccommodationController::class)
            ->names('admin.accommodations')
            ->except(['show']);

        Route::resource('cultures', AdminCultureController::class)
            ->names('admin.cultures')
            ->except(['show']);

        Route::resource('testimonials', AdminTestimonialController::class)
            ->names('admin.testimonials')
            ->except(['show']);

        Route::resource('trip-packages', AdminTripPackageController::class)
            ->names('admin.trip-packages')
            ->except(['show']);

        Route::get('trip-packages/{tripPackage}/itinerary-items/create', [AdminTripItineraryItemController::class, 'create'])
            ->name('admin.trip-itinerary-items.create');
        Route::post('trip-packages/{tripPackage}/itinerary-items', [AdminTripItineraryItemController::class, 'store'])
            ->name('admin.trip-itinerary-items.store');
        Route::get('trip-packages/{tripPackage}/itinerary-items/{tripItineraryItem}/edit', [AdminTripItineraryItemController::class, 'edit'])
            ->name('admin.trip-itinerary-items.edit');
        Route::put('trip-packages/{tripPackage}/itinerary-items/{tripItineraryItem}', [AdminTripItineraryItemController::class, 'update'])
            ->name('admin.trip-itinerary-items.update');
        Route::delete('trip-packages/{tripPackage}/itinerary-items/{tripItineraryItem}', [AdminTripItineraryItemController::class, 'destroy'])
            ->name('admin.trip-itinerary-items.destroy');

        Route::get('settings', [AdminWebsiteSettingController::class, 'edit'])->name('admin.settings.edit');
        Route::put('settings', [AdminWebsiteSettingController::class, 'update'])->name('admin.settings.update');

        Route::get('visitor-logs', [AdminVisitorLogController::class, 'index'])->name('admin.visitor-logs.index');
    });
});
