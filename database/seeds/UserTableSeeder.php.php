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
            'name' => 'Admin',
            'email' => 'holyshit@steamclicks.ru',
            'email_hash' => md5('holyshit@steamclicks.ru'),
            'password' => bcrypt('SlojniyPar0l'),
        ]);

    User::create(
        [
            'id' => '1001',
            'name' => 'Anton',
            'email' => 'Anthony_1991@mail.ru',
            'email_hash' => 'c03e42d0a4fd951903e942d1242221f5',
            'password' => '$2y$10$CtxvgdnQDT.Ayd9jwL54DeuKz4KzP879UncKBosv/eX3/C.Yhgfke',
        ]);
    User::create(
        [
            'name' => 'Opasniy',
            'email' => 'djoctuk@yandex.ru',
            'email_hash' => md5('djoctuk@yandex.ru'),
            'password' => bcrypt('110789'),
        ]);
}
}
