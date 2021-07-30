<?php

use Illuminate\Database\Seeder;
use App\Order;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ( $i = 0; $i < 200; $i++) {
            $new_order = new Order();

            $new_order->customer_name = $faker->firstName();
            $new_order->customer_lastname = $faker->lastName();
            $new_order->phone_number = rand(1,8);
            $new_order->customer_address = $faker->address();
            $new_order->created_at = $faker->dateTimeBetween('-1 year');
            $new_order->restaurant_id = $faker->numberBetween(1,8);
            $new_order->tot_paid = $faker->randomFloat(1, 10, 200);


            $new_order->save();

        }
    }
}
