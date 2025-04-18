<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class UuidServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {        
        // Model::creating(function ($model) {
        //     if (
        //         in_array('uiid', $model->getFillable()) &&
        //         empty($model->uiid)
        //     ) {
        //         $model->uiid = (string) Str::uuid();
        //     }
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
