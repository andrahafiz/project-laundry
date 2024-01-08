<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name'              => 'admin',
            'username'          => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'no_hp'             => '0877231244312',
            'address'           => 'Rumbai, Pekanbaru',
            'photo'             => 'avatar.jpg',
            'roles'             => 'ADMIN'
        ]);
        \App\Models\User::factory()->create(['username' => 'user', 'roles' => 'CUSTOMER']);
        \App\Models\User::factory()->create(['username' => 'user1', 'roles' => 'CUSTOMER']);
        \App\Models\Product::factory(count: 1)->create([
            'unit' => 'Pcs'
        ]);
    }
}
