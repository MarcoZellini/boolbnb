<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            /* 👇admin👇 */
            [
                'name' => 'Admin',
                'lastname' => 'Admin',
                'email' => 'admin@boolbnb.com',
                'password' => md5('password'),
                'date_of_birth' => '2023-12-06',
            ],
            [
                'name' => 'Gianluca',
                'lastname' => 'Vallese',
                'email' => 'gianluca.vallese@boolbnb.com',
                'password' => md5('password'),
                'date_of_birth' => '1996-10-03',
            ],
            [
                'name' => 'Francesco',
                'lastname' => 'Mascellino',
                'email' => 'francesco.mascellino@boolbnb.com',
                'password' => md5('password'),
                'date_of_birth' => '1982-06-02',
            ],
            [
                'name' => 'Marco',
                'lastname' => 'Zellini',
                'email' => 'marco.zellini@boolbnb.com',
                'password' => md5('password'),
                'date_of_birth' => '2000-04-07',
            ],
            [
                'name' => 'Antonino',
                'lastname' => 'Cucuzza',
                'email' => 'antonino.cucuzza@boolbnb.com',
                'password' => md5('password'),
                'date_of_birth' => '2002-08-15',
            ],
        ];
        foreach ($users as $user) {
            $NewUser = new User();
            $NewUser->name = $user['name'];
            $NewUser->lastname = $user['lastname'];
            $NewUser->email = $user['email'];
            $NewUser->password = $user['password'];
            $NewUser->date_of_birth = $user['date_of_birth'];
            $NewUser->save();
        }
    }
}
