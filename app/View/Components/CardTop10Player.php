<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardTop10Player extends Component
{
    public $player;
    public $top;
    /**
     * Create a new component instance.
     */
    public function __construct($player, $top)
    {
        $this->player = $player;
        $this->top = $top;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-top10-player', ['player' => $this->player, 'top' => $this->top]);
    }
}
