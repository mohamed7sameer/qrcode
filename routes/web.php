<?php

use App\Http\Controllers\QCategoryController;
use App\Models\QCategory;
use App\Models\Qrcode;
use Illuminate\Support\Facades\Route;

use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Http\Middleware\Authorize;
use Laravel\Nova\Http\Middleware\HandleInertiaRequests;


use Laravel\Nova\Nova;
use Livewire\Volt\Volt;


Route::middleware(['auth'])->group(function () {
    Route::redirect('dashboard', '/')->name('dashboard');
    Volt::route('/','qrcode.home')->name('home');
    
    Volt::route('/setting','qrcode.setting')->name('q.setting');
    
});





Route::middleware(config('nova.api_middleware'))->group(function () {
    
    Volt::route('qrcode/autoloadproducts/{qCategory}','qrcode.autoloadproducts')->name('qrcode.print-autoloadproducts');
    Route::get('qrcode/print-category/{qCategory}', [QCategoryController::class, 'iindex'])->name('qrcode.print-category');

});


Volt::route('qrcode/scan/{uuid}','qrcode.scan.login')->name('qrcode.scan-qrcode');
Volt::route('qrcode/scan/register/{uuid}','qrcode.scan.register')->name('qrcode.scan-qrcode.register');



Volt::route('login','qrcode.auth.login')->name('login');
Volt::route('register','qrcode.auth.register')->name('register');



Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');






    

Volt::route('middleware/middleware/{paginate}/{m}','middleware.middleware')->name('middleware/middleware');


