<?php

namespace Database\Seeders;

use App\Enums\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('users')->count() == 0) {
            DB::table('users')->insert([
                'merchant_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@local.com',
                'password' => Hash::make('admin123'),
                'status' => Status::Active->value,
            ]);
        }
    }
}
