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

        $trip = $bus->trips()->create([
            'start_station_id' => $stations->first()->id,
            'end_station_id' => $stations->last()->id,
        ]);

        // $stops = $stations->slice(1, 3);

        foreach ($stations as $key => $stop) {
            $trip->stops()->create(['station_id' => $stop->id, 'order' => $key + 1]);
        }
    }
}
