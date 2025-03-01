<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => Hash::make('test'),
        ]);

        DB::table('tenants')->insert([
            'id' => 'tenancy',
            'data' => '{"tenancy_db_name": "test_tenancy"}',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('domains')->insert([
            'id' => 1,
            'domain' => 'tenancy',
            'tenant_id' => 'tenancy',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
