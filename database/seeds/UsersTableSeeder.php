<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nícollas Silva',
            'email' => 'teste@supera.com',
            'password' => Hash::make('teste'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
