<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Secteur;
use Faker\Generator as Faker;

$factory->define(Secteur::class, function (Faker $faker) {
    return [
        'T_secteur_fr' => $faker->unique()->sentence,
        'T_secteur_ar' => $faker->unique()->sentence,
    ];
});
