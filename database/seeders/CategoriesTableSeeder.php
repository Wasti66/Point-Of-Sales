<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        if ($users->count() == 0) {
            $this->command->info('No users found. Create users before seeding categories.');
            return;
        }
        $categories = [
            'Technology',
            'Agriculture'
        ];
        foreach ($users as $user) {
            foreach ($categories as $categoryName) {
                Category::create([
                    'name' => $categoryName,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
