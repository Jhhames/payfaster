<?php

use Illuminate\Database\Seeder;
use App\Bvn;
use App\Receipt;
use App\Account;

// use Nexmo\Message\Callback\Receipt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(Account::class,10)->create();
        // factory(Receipt::class,10)->create();
    }
}
