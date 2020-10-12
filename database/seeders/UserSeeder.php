<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::factory()->create([
            'name' => "Tester",
            'email' => 'dev@cc.cc',
            'password' => Hash::make('dev'),
        ]);
        User::factory()->count(5)->create();
    }
}
