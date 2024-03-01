<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('customers')->insert([
                'customer_name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $faker->unique()->password,
                'birthday' => $faker->date,
                'address' => $faker->address,
                'phone' => $faker->unique()->phoneNumber,
                'status' => $faker->boolean,
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('carts')->insert([
                'customer_id' => $i + 1
            ]);
        }

        DB::table('users')->insert([
            'fullname' => 'admin',
            'email' => 'admin@softui.com',
            'password' => Hash::make('12345'),
            'role' => 'admin',
        ]);
    }
}
