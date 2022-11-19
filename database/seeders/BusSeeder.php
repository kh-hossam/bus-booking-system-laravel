<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seats = [];
        for ($i = 1; $i <= 12; $i++) {
            $seats[] = ['number' => $i];
        }

        Bus::factory(10)
            ->create()->each(function(Bus $bus) use ($seats) {
                $bus->seats()->createMany($seats);
            });
    }
}
