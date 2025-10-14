<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ide;
use App\Models\UserIdea;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $users = User::factory(5)->create(['role' => 'user']);
        $categories = Kategori::factory(5)->create();
        $ideas = Ide::factory(10)->create();

        foreach ($ideas as $idea) {
            $idea->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        foreach ($users as $user) {
            $randomideas = $ideas->random(rand(1, 5));

            foreach ($randomideas as $idea) {
                UserIdea::create([
                    'user_id' => $user->id,
                    'idea_id' => $idea->id,
                ]);
            }
        }
    }
}
