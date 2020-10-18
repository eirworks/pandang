<?php

namespace App\View\Components;

use App\Models\Ping;
use Illuminate\View\Component;

class PingStatus extends Component
{
    /**
     * @var Ping
     */
    public $ping;

    /**
     * Create a new component instance.
     *
     * @param Ping $ping
     */
    public function __construct(?Ping $ping)
    {
        //
        $this->ping = $ping;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.ping-status');
    }
}
