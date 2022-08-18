<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') == 'local' && !User::count()) {
            $this->call(LocalAdminSeeder::class);
        }
        $this->call(WatcherSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
