<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listings;
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
        $user = User::factory()->create([
            'name'      => 'John Doe',
            'email'     => 'john@gmail.com'
        ]);

        \App\Models\Listings::factory(6)->create([
            'user_id' => $user->id
        ]);
    }
}
