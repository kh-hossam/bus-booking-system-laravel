<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Station;
use App\Models\Stop;
use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bus = Bus::first();

        $stations = Station::take(5)->get();

        $trip = $bus->trips()->create();

        foreach ($stations as $key => $stop) {
            $trip->stops()->create([
                // 'start_station_id' => $stations[$key - 1]->id,
                // 'end_station_id' => $stop->id,
                'station_id' => $stop->id,
                'order' => $key
            ]);
        }
    }
}
