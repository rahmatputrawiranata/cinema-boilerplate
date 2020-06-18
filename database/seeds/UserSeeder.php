<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        $user = array(
            [
                'username' => 'admin1',
                'password' => Hash::make('admin1'),
                'role' => 'admin'
                ],
                [
                    'username' => 'admin2',
                    'password' => Hash::make('admin2'),
                    'role' => 'admin'
                ],
                [
                    'username' => 'user1',
                    'password' => Hash::make('user1'),
                    'role' => 'user'
                ]
                );

        foreach($user as $u)
        {
            User::create($u);
        }
    }
}
