<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name'  => config('blogger.admin.name'),
            'email' => config('blogger.admin.email'),
        ], [
            'password'          => Hash::make(config('blogger.admin.password')),
            'email_verified_at' => now(),
        ]);
    }
}
