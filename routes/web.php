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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Route::redirect('settings', 'settings/profile');
    Route::redirect('dashboard', '/')->name('dashboard');
    Volt::route('/','qrcode.profile')->name('home');
    
    Volt::route('/top-users','qrcode.top-ten')->name('top.users');
    // Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    // Volt::route('settings/password', 'settings.password')->name('settings.password');
    // Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});




// Route::middleware([
        //    'nova'
//         Authenticate::class,
//         Authorize::class,
// ])->group(function () {
//     Volt::route('qrcode/print-category/{qCategory}','qrcode.print-category')->name('qrcode.print-category');
// });

Route::middleware(config('nova.api_middleware'))->group(function () {
    // Volt::route('qrcode/print-category/{qCategory}','qrcode.print-category')->name('qrcode.print-category');
    Volt::route('qrcode/autoloadproducts/{qCategory}','qrcode.autoloadproducts')->name('qrcode.print-autoloadproducts');
    Route::get('qrcode/print-category/{qCategory}', [QCategoryController::class, 'iindex'])->name('qrcode.print-category');

});

Volt::route('qrcode/scan/{uuid}','qrcode.scan')->name('qrcode.scan-qrcode');


Volt::route('login','qrcode.login')->name('login');
Volt::route('register','qrcode.login')->name('register');

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');






    

Volt::route('middleware/middleware/{paginate}/{m}','middleware.middleware')->name('middleware/middleware');




// Nova::routes()
//     ->withAuthenticationRoutes()
//     ->withPasswordResetRoutes()
//     ->register()
//     ->middleware(['web', 'auth', 'check.nova.access'])    
//     ;



// Volt::route('register', 'auth.register')
//         ->name('register');

// Route::get('test',function(){
//     Qrcode::create([
//         'q_category_id' => '1'
//     ]);
// });




// require __DIR__.'/auth.php';
