<?php

namespace Database\Factories;

use App\Models\QCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of \App\Models\QCategory
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class QCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = QCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
