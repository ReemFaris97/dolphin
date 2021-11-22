<?php

namespace Database\Factories;

use App\Models\AccountingCompany;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountingCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountingCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $faker= FakerFactory::create('ar');
        return [

        ];
    }
}
