<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_restaurants = new Restaurant();

        $new_restaurants->name = 'User 1 Restaurant';
        $new_restaurants->address = 'Via Roma';
        $new_restaurants->vat_number = '12345678900';
        $new_restaurants->user_id = 1;

        $new_restaurants->save();
    }
}
