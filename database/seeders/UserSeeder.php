<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = config('users');
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
