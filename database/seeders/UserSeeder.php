<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\ErrorSolutions\Solutions\Laravel\MakeViewVariableOptionalSolution;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->admin()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@gmail.com'
        // ]);


        User::factory()->count(5)->create();
    }
}
