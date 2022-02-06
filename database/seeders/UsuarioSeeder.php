<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Gregory',
            'email' => 'gpalacios@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://github.com/gpalacios26?tab=repositories',
        ]);

        User::create([
            'name' => 'Ernesto',
            'email' => 'emedina@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://github.com/gpalacios26?tab=repositories',
        ]);
    }
}
