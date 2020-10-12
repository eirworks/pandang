<?php

namespace Database\Seeders;

use App\Models\Monitor;
use App\Models\Project;
use Illuminate\Database\Seeder;

class MonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Monitor::truncate();

        Project::all()->each(function($project) {
            $project->monitors()->saveMany(Monitor::factory()->count(3)->make()->all());
        });
    }
}
