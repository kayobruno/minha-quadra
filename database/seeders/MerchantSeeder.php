<?php

namespace Database\Seeders;

use App\Enums\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('merchants')->count() == 0) {
            DB::table('merchants')->insert([    
                'trade_name' => 'Merchant Admin',
                'document' => '11.111.111/0001-11',
                'business_hours' => '{}',
                'status' => Status::Active->value,
            ]);
        }
    }
}
