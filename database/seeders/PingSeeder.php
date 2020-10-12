<?php

namespace Database\Seeders;

use App\Models\Monitor;
use App\Models\Ping;
use Illuminate\Database\Seeder;

class PingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ping::truncate();

        $monitor = Monitor::first();

        for($i=0; $i<=60; $i++) {
            $monitor->pings()
                ->save(Ping::factory()->make(['created_at' => now()->subMinutes($i)]));
        }

        Monitor::where('id', '>', 1)->get()->each(function($monitor) {

            dump("Monitor", $monitor->id);
            $monitor->pings()->saveMany(Ping::factory()->count(15)->create());

            $monitor->pings()->save(Ping::factory()->create([
                'time' => $monitor->id % 2 == 0 ? 0 : rand(100, 1000) / 1000.0,
            ]));

        });
    }
}
