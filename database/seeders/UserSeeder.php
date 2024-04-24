<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->sequence(fn (Sequence $sequence) =>
            ['name' => 'Test User'.$sequence->index, 'email' => 'test'.$sequence->index.'@example.com',])
            ->create();
    }
}
