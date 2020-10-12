<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()
            ->latest('updated_at')
            ->withCount(['monitors'])
            ->paginate(5);

        return view('dashboard.home.index', [
            'projects' => $projects,
        ]);
    }
}
