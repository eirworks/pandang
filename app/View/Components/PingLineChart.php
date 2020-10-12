<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class PingLineChart extends Component
{
    /**
     * @var array
     */
    public $pings;
    public $name;
    /**
     * @var string
     */
    public $id;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param array $pings
     */
    public function __construct($name, $pings = [])
    {
        //
        $this->pings = $pings;
        $this->name = $name;
        $this->id = "chart-".Str::random(8);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.ping-line-chart');
    }
}
