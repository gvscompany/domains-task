<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Valdemar',
            'email' => 'valdemar-valdemar@gmail.com',
            'password' => bcrypt('A123456'),
        ]);
    }
}
