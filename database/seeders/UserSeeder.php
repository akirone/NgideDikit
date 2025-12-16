<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ide;
use App\Models\UserIdea;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Giero',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12'),
            'role' => 'admin',
        ]);

        $categories = Kategori::factory(10)->create();
        $ideas = Ide::factory(10)->create();

        foreach ($ideas as $idea) {
            $idea->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
