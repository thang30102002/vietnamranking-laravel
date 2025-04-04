<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Top5Player extends Component
{
    /**
     * Create a new component instance.
     */
    public $players_top_5;
    public function __construct($players)
    {
        $this->players_top_5 = $players;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.top5-player', ['players_top_5' => $this->players_top_5]);
    }
}
