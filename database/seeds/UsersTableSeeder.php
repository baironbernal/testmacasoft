<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
          'name' => 'bfbernalgo',
          'email' => 'baironbernal263@gmail.com',
          'password' => bcrypt('PASSWORD'),
        ]);
        
        $user->assignRole('admin');
    }
}
