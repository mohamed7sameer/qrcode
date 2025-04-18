<?php

namespace App\Nova;

use App\Nova\Filters\QcategoryType;
use App\Nova\Lenses\MostValuableUsers;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Qrcode extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Qrcode>
     */
    public static $model = \App\Models\Qrcode::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'uuid';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'uuid',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            // ID::make()->sortable(),

            
        Text::make('ID', 'id')
            ->readonly()
            ->sortable(),
        Text::make('Code', 'uuid')
            ->readonly()
            ->sortable(),

        BelongsTo::make('Q Category', 'qCategory')
            ->sortable()
            ->searchable()
            ->rules('required'),

        Boolean::make('Status')
            ->trueValue(1)
            ->falseValue(0)
            ->default(1)
            ->sortable(),


            
        ];
    }

    /**
     * Get the cards available for the resource.
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
        return [
            QcategoryType::make()
            ->searchable(),

        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [
            // MostValuableUsers::make()
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
