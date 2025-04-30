<?php

namespace App\Nova;

use App\Nova\Lenses\PointsUserLens;
use Illuminate\Http\Request;
use Laravel\Nova\Auth\PasswordValidationRules;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    use PasswordValidationRules;

    
    public static $perPageViaRelationship = 10;
    
    /**
     * The pagination per-page options configured for this resource.
     *
     * @return array
     */
    public static function perPageOptions()
    {
        return [10, 50, 100]; // 1 will be the default
    }




    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field|\Laravel\Nova\Panel|\Laravel\Nova\ResourceTool|\Illuminate\Http\Resources\MergeValue>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            // Gravatar::make()->maxWidth(50),

            Image::make('Avatar')
            ->creationRules('nullable', 'image', 'max:2048')
            ->updateRules('nullable', 'image', 'max:2048')
            ->deletable(false)
            ->disk('public')
            ->path('users/avatar')
            ->sortable(), 

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254'),
            Text::make('Phone')
                ->sortable()
                ->rules('required', 'max:254')
                ->creationRules('unique:users,phone')
                ->updateRules('unique:users,phone,{{resourceId}}'),


            

            BelongsToMany::make('qrcodes')
            ->searchable()

            // HasMany::make('qrcodes')
            

        

            // ->rules(function ($attribute, $value, $fail) use ($request) {
            //     dd('000') ;
            // })
            ,

        
        
            
            // ->detachable()
            // ->hideWhenDeleting(),
        


            


            Text::make('Points')
            ->sortable()

            // Text::make('Points', function () {
            //     return $this->qrcodes->sum('qCategory.points');
            // })
            // ->sortable()
            


            
            

            
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [
            // PointsUserLens::make()
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
