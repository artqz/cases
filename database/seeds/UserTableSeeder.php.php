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
    User::create(
        [
            'name' => 'etc',
            'email' => 'djoctuk@yandex.ru',
            'email_hash' => md5('djoctuk@yandex.ru'),
            'password' => bcrypt('110789'),
        ]);
}
}
