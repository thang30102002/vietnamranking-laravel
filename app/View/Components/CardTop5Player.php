<?php

namespace App\View\Components;

use App\Models\Player;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardTop5Player extends Component
{
    /**
     * Create a new component instance.
     */
    public $player;
    public $top;
    public function __construct($player, $top)
    {
        $this->player = $player;
        $this->top = Player::get_top_player($player->id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-top5-player', ['player' => $this->player, 'top' => $this->top]);
    }
}
