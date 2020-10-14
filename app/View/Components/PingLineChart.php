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
     * @var int
     */
    public $height;
    /**
     * @var false
     */
    public $displayStat;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param array $pings
     * @param int $height
     */
    public function __construct($name, $pings = [], $height = 300, $displayStat = false)
    {
        //
        $this->pings = $pings;
        $this->name = $name;
        $this->id = "chart-".Str::random(8);
        $this->height = $height;
        $this->displayStat = $displayStat;
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
