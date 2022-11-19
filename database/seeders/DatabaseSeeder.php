<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        DB::table('stations')->truncate();
        DB::table('buses')->truncate();
        DB::table('reservations')->truncate();
        DB::table('stops')->truncate();
        DB::table('trips')->truncate();


        Schema::enableForeignKeyConstraints();

        $this->call([
            UserSeeder::class,
            StationSeeder::class,
            BusSeeder::class,
            TripSeeder::class,
        ]);
    }
}
