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
            'first_name' => 'ammar',
            'last_name' => 'alazii',
            'email' => 'alaziiammar@gmail.com',
            'password' => bcrypt('12341234')
        ]);
        $user->attachRole('super_admin');
    }
}
