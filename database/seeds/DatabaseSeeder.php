<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'giangphan92@gmail.com',
            'password' => bcrypt('123456'),
            'active' => 1,
            'role' => 'Admin'
        ]);

        DB::table('status')->insert([
            'name' => 'New',
            'position' => 1,
            ]);
        DB::table('status')->insert([
            'name' => 'Processing',
            'position' => 2,
        ]);
        DB::table('status')->insert([
            'name' => 'Package',
            'position' => 3,
        ]);
        DB::table('status')->insert([
            'name' => 'Complete',
            'position' => 4,
        ]);
        DB::table('status')->insert([
            'name' => 'Refund',
            'position' => 5,
        ]);
        DB::table('status')->insert([
            'name' => 'Cancel',
            'position' => 6,
        ]);

        DB::table('products')->insert([
            'name' => 'Giọt nước lớn',
            'quantity' => 10,
            'price' => 12.5,
            ]);
        DB::table('products')->insert([
            'name' => 'Kim tự tháp lớn',
            'quantity' => 5,
            'price' => 13.5,
            ]);
        DB::table('products')->insert([
            'name' => 'Chiếc giầy',
            'quantity' => 15,
            'price' => 11.5,
            ]);
        DB::table('products')->insert([
            'name' => 'Lounger',
            'quantity' => 7,
            'price' => 20.5,
            ]);
        DB::table('products')->insert([
            'name' => 'Giọt nước vừa',
            'quantity' => 19,
            'price' => 10.2,
            ]);


    }
}
