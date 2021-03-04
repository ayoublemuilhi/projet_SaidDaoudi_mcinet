<?php

use Illuminate\Database\Seeder;

class SecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Secteur::class, 1000)->create()->each(function ($secteurs) {
            $secteurs->save(factory(App\Models\Secteur::class)->make());
        });
    }
}
