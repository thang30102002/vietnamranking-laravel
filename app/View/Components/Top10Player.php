<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Top10Player extends Component
{
    public $players_top_6_from_15;
    /**
     * Create a new component instance.
     */
    public function __construct($players)
    {
        $this->players_top_6_from_15 = $players;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.top10-player', ['players_top_6_from_15' => $this->players_top_6_from_15]);
    }
}
