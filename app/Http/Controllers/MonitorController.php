<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use App\Models\Project;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class MonitorController extends Controller
{
    public function show(Project $project, Monitor $monitor)
    {
        $pings = $monitor->pings()
            ->limit(60)
            ->latest('id')
            ->get();

        return view('monitors.index', [
            'project' => $project,
            'monitor' => $monitor,
            'pings' => $pings,
        ]);
    }

    public function publicShow($id)
    {
        $monitor_id = Hashids::connection('monitor')->decode($id)[0] ?? 0;

        $monitor = Monitor::findOrFail($monitor_id);

        if (!$monitor->settings->get(Monitor::SETTING_PUBLIC, false))
        {
            abort(404, "Page not found");
        }

        $pings = $monitor->pings()
            ->limit(60)
            ->latest('id')
            ->get();

        return view('public_monitor', [
            'monitor' => $monitor,
            'pings' => $pings,
        ]);
    }

    public function create(Project $project)
    {
        return view('monitors.form', [
            'project' => $project,
            'monitor' => new Monitor(),
        ]);
    }
    public function edit(Project $project, Monitor $monitor)
    {
        return view('monitors.form', [
            'project' => $project,
            'monitor' => $monitor,
        ]);
    }

    public function store(Request $request, Project $project)
    {
        $monitor = new Monitor($request->only(['name', 'url']));
        $monitor->project_id = $project->id;
        $monitor->data = [];
        $monitor->settings = [];
        $monitor->save();

        return redirect()->route('projects::monitors::show', [$project, $monitor])
            ->with('success', __('messages.content_saved', ['name' => __('monitors.monitor')]));
    }

    public function update(Request $request, Project $project, Monitor $monitor)
    {
        $settings = $request->input('settings', []);
        $monitor->fill($request->only(['name', 'url']));
        $monitor->activated = $request->input('activated');
        $monitor->settings = $settings;
        $monitor->save();

        return redirect()->route('projects::monitors::show', [$project, $monitor])
            ->with('success', __('messages.content_saved', ['name' => __('monitors.monitor')]));
    }

    public function destroy(Request $request, Project $project, Monitor $monitor)
    {
        $monitor->pings()->delete();
        $monitor->delete();

        return redirect()->route('projects::show', [$project])
            ->with('success', __('messages.content_deleted', ['name' => __('monitors.monitor')]));

    }
}
