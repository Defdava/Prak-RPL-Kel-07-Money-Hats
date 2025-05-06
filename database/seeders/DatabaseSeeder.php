<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Squire\Models\Currency;
use Squire\Models\Country;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create one user
        $user = User::factory()->create([
            'name' => 'Defdava',
            'email' => 'admin@gmail.com',
        ]);

        // Create 10 categories for that user
        $categories = Category::factory(10)->create([
            'user_id' => $user->id,
        ]);

        // Create 100 incomes with random category from the user
        Income::factory(100)->create([
            'user_id' => $user->id,
            'category_id' => $categories->random()->id,
        ]);

        // Create 100 expenses with random category from the user
        Expense::factory(100)->create([
            'user_id' => $user->id,
            'category_id' => $categories->random()->id,
        ]);

        // Insert Indonesian Rupiah into currencies table (if not exists)
        Currency::updateOrCreate([
            'id' => 'idr',
        ], [
            'name' => 'Indonesian Rupiah',
            'code' => 'IDR',
            'symbol' => 'Rp',
        ]);

        // Insert Indonesia into countries table (if not exists)
        Country::updateOrCreate([
            'id' => 'id',
        ], [
            'name' => 'Indonesia',
            'official_name' => 'Republic of Indonesia',
        ]);
    }
}
