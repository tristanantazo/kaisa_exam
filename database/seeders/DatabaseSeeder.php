<?php

namespace Database\Seeders;

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
        \App\Models\Tag::factory(3)->create();
        \App\Models\Account::factory(5)
        ->has(\App\Models\User::factory()->count(1))
        ->has(\App\Models\Photo::factory()->count(3))
        ->create();
    }
}
