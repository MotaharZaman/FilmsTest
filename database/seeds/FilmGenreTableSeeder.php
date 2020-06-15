<?php

use Illuminate\Database\Seeder;

class FilmGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\DataModel\Model\Film::class, 30)->create();
    }
}
