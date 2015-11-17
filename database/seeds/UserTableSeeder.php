<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'nama_user'=>'gareng',
            'email'=>'gareng@garengstudio.com',
            'password'=>bcrypt('gareng123'),
        ));
    }
}
