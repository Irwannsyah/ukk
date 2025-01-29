<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\ErrorSolutions\Contracts\HasSolutionsForThrowable;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::Create([
            'name' => 'irwansyah',
            'email' => 'irwansyah@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);
    }
}
